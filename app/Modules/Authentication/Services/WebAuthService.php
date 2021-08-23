<?php


namespace App\Modules\Authentication\Services;


use App\Http\Repositories\CommonRepository;
use App\Http\Services\ResponseService;
use App\Jobs\SendForgetPasswordEmailJob;
use App\Jobs\SendVerificationEmailJob;
use App\Modules\Authentication\Repositories\PasswordResetRepository;
use App\Modules\Authentication\Repositories\ReferralCodeRepository;
use App\Modules\Authentication\Repositories\ReferralUserRepository;
use App\Modules\Authentication\Repositories\UserRepository;
use App\Modules\Authentication\Repositories\UserWalletRepository;
use App\Modules\Authentication\Repositories\WalletSubscriptionRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WebAuthService extends ResponseService
{
    private $userRepository;
    private $passwordResetRepository;
    private $walletSubscriptionRepository;
    private $userWalletRepository;
    private $referralCodeRepository;
    private $referralUserRepository;

    /**
     * WebAuthService constructor.
     * @param UserRepository $userRepository
     * @param PasswordResetRepository $passwordResetRepository
     * @param WalletSubscriptionRepository $walletSubscriptionRepository
     * @param UserWalletRepository $userWalletRepository
     * @param ReferralCodeRepository $referralCodeRepository
     * @param ReferralUserRepository $referralUserRepository
     */
    public function __construct(UserRepository $userRepository, PasswordResetRepository $passwordResetRepository, WalletSubscriptionRepository $walletSubscriptionRepository, UserWalletRepository $userWalletRepository, ReferralCodeRepository $referralCodeRepository, ReferralUserRepository $referralUserRepository)
    {
        $this->userRepository = $userRepository;
        $this->passwordResetRepository = $passwordResetRepository;
        $this->walletSubscriptionRepository = $walletSubscriptionRepository;
        $this->userWalletRepository = $userWalletRepository;
        $this->referralCodeRepository = $referralCodeRepository;
        $this->referralUserRepository = $referralUserRepository;
    }

    /**
     * @param object $request
     * @return array
     */
    public function signUpProcess(object $request): array
    {
        try {
            DB::beginTransaction();
            //Create User
            $insert = [
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'password' => Hash::make($request->get('password')),
                'role' => USER_ROLE,
                'status' => USER_PENDING_STATUS,
            ];
            $user = $this->userRepository->create($insert);
            //Sign in
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
            Auth::attempt($credentials);
            //wallet
            $userWalletData = [
                'user_id' => $user->id,
                'wallet_subscription_id' => 1,
                'amount' => 0,
                'capacity' =>100,
                'expires_at' =>(Carbon::now())->addYear()
            ];
            $wallet = $this->userWalletRepository->create($userWalletData);
            //Referral sign up
            if(isset($request->referral_code)){
                $where = ['code' => $request->referral_code];
                $referralCode = $this->referralCodeRepository->whereLast($where);
                if(!empty($referralCode)){
                    $referralUserData=[
                        'parent_id' => $referralCode->user_id,
                        'child_id' =>$user->id
                    ];
                    $this->referralUserRepository->create($referralUserData);
                    $where = ['id' => $wallet->id];
                    $userWalletData = [
                        'wallet_subscription_id' => 3,
                        'capacity' =>500
                    ];
                    $this->userWalletRepository->update($where, $userWalletData);
                }
            }
            DB::commit();

            return $this->response()->success("Successfully Signed up! \n Please verify your account");
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function signInProcess(object $request): array
    {
        try {
            $credentials = $this->credentials($request->except('_token'));
            $valid = Auth::attempt($credentials);
            if ($valid) {
                $user = Auth::user();
                if ($user->role == SUPER_ADMIN_ROLE || $user->role == ADMIN_ROLE || $user->role == USER_ROLE ) {
                    return $this->response()->success('Congratulations! You have signed in successfully.');
                } else {
                    Auth::logout();

                    return $this->response()->error('You are not authorized');
                }
            } else {
                return $this->response()->error('Email or password is incorrect');
            }
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param $data
     * @return array
     */
    private function credentials($data): array
    {
        if (filter_var($data['email_username'], FILTER_VALIDATE_EMAIL)) {
            return [
                'email' => $data['email_username'],
                'password' => $data['password']
            ];
        } else {
            return [
                'username' => $data['email_username'],
                'password' => $data['password']
            ];
        }
    }

    /**
     * @return array
     */
    public function sendVerificationEmail(): array
    {
        try {
            DB::beginTransaction();
            $randNo = randomNumber(6);
            $user = Auth::user();
            $where = ['id' => $user->id];
            $insert = [
                'email_verification_code' => $randNo,
                'verification_status' => false
            ];
            $this->userRepository->update($where, $insert);
            $defaultEmail = 'astharbazar@gmail.com';
            $defaultName = 'Asthar Bazar';
            dispatch(new SendVerificationEmailJob($randNo, $defaultName, $user, $defaultEmail))->onQueue('email-send');
            DB::commit();

            return $this->response()->success("An Email Has Sent To ".$user->email.". Please verify your account");
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function verifyEmailProcess(object $request): array
    {
        try {
            $user = Auth::user();
            if ($user->role == USER_ROLE) {
                $where = [
                    'id' => $user->id,
                    'email_verification_code' => $request->verification_code,
                    'verification_status' => false
                ];
                $data = [
                    'email_verification_code' => null,
                    'verification_status' => true
                ];
                $done = $this->userRepository->update($where, $data);
                return $done ?
                    $this->response()->success(__("Phone Verification Successful."))
                    : $this->response()->error(__("Invalid verification code."));

            } else {
                return $this->response()->error(__("Invalid Input"));
            }
        }catch(\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function sendForgetPasswordEmail(object $request): array
    {
        if (filter_var($request->email_username, FILTER_VALIDATE_EMAIL)) {
            $where = ['email' => $request->email_username];
        } else {
            $where = ['username' => $request->email_username];
        }
        $user = $this->userRepository->whereFirst($where);
        if (empty($user)) {
            return $this->response()->error('User not found');
        }
        if ($user->role == USER_ROLE) {
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return $this->response()->error('Please enter your username instead of email');
            }
        }

        $randNo = randomNumber(6);
        try {
            $defaultEmail = 'astharbazar@gmail.com';
            $defaultName = 'Asthar Bazar';
            dispatch(new SendForgetPasswordEmailJob($randNo, $defaultName, $user, $defaultEmail));
            $this->passwordResetRepository->create([
                'user_id' => $user->id,
                'verification_code' => $randNo
            ]);

            return $this->response()->success('Code has been sent to ' . $user->email);
        } catch (\Exception $exception) {
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    public function resetPassword(object $request): array
    {
        try {
            DB::beginTransaction();
            $where = ['verification_code' => $request->reset_password_code, 'status' => PENDING_STATUS];
            $passwordResetCode = $this->passwordResetRepository->whereFirst($where);
            if (!empty($passwordResetCode)) {
                $where = ['user_id' => $passwordResetCode->user_id, 'status' => PENDING_STATUS];
                $latestResetCode = $this->passwordResetRepository->whereLast($where);
                if (($latestResetCode->verification_code != $request->reset_password_code)) {
                    return $this->response()->error('Your given reset password code is incorrect');
                }
            } else {
                return $this->response()->error('Your given reset password code is incorrect');
            }

            if (!empty($passwordResetCode)) {
                $totalDuration = Carbon::now()->diffInMinutes($passwordResetCode->created_at);
                if ($totalDuration > EXPIRE_TIME_OF_FORGET_PASSWORD_CODE) {
                    return $this->response()->error('Your code has been expired. Please give your code with in' . EXPIRE_TIME_OF_FORGET_PASSWORD_CODE .  'minutes');
                }
                $where = ['id' => $passwordResetCode->user_id];
                $user = $this->userRepository->whereFirst($where);
                if (empty($user)) {
                    return $this->response()->error('User not found');
                }
                $where = ['id' => $user->id];
                $data = ['password' => Hash::make($request->new_password)];
                $this->userRepository->update($where, $data);
                $where = ['id' => $passwordResetCode->id];
                $data = ['status' => ACTIVE_STATUS];
                $this->passwordResetRepository->update($where, $data);
                DB::commit();

                return $this->response()->success('Password was reset successfully');
            }
            DB::rollback();

            return $this->response()->error('Your given reset password code is incorrect');
        }catch (\Exception $exception) {
            DB::rollback();

            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function signOut(): array
    {
        Auth::logout();
        session()->flush();

        return $this->response()->error('Logged out successfully');
    }
}
