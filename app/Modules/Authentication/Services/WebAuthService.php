<?php


namespace App\Modules\Authentication\Services;


use App\Http\Repositories\CommonRepository;
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

class WebAuthService extends CommonRepository
{
    private $errorMessage;
    private $errorResponse;
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
        $this->errorMessage = __('Something went wrong');
        $this->errorResponse = [
            'success' => false,
            'message' => $this->errorMessage,
            'data' => [],
            'webResponse' => [
                'dismiss' => $this->errorMessage,
            ],
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function signUpProcess($request)
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

            return [
                'success' => true,
                'message' => __("Successfully Signed up! \n Please verify your account"),
                'webResponse' => [
                    'success' => __("Successfully Signed up! \n Please verify your account"),
                ],
            ];
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function signInProcess($request)
    {
        $credentials = $this->credentials($request->except('_token'));
        $valid = Auth::attempt($credentials);
        if ($valid) {
            $user = Auth::user();
            if ($user->role == SUPER_ADMIN_ROLE || $user->role == ADMIN_ROLE || $user->role == USER_ROLE ) {
                return [
                    'success' => true,
                    'message' => __('Congratulations! You have signed in successfully.'),
                    'data' => $user
                ];
            } else {
                Auth::logout();

                return [
                    'success' => false,
                    'message' => __('You are not authorized'),
                    'data' => null
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => __('Email or password is incorrect'),
                'data' => null
            ];
        }
    }

    /**
     * @param $data
     * @return array
     */
    private function credentials($data)
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
    public function sendVerificationEmail()
    {
        try {
            DB::beginTransaction();
            $randNo = randomNumber(6);
            $user = Auth::user();
            $where = ['id' => $user->id];
            $insert = ['email_verification_code' => $randNo];
            $this->userRepository->update($where, $insert);
            $defaultEmail = 'astharbazar@gmail.com';
            $defaultName = 'Asthar Bazar';
            dispatch(new SendVerificationEmailJob($randNo, $defaultName, $user, $defaultEmail))->onQueue('email-send');
            DB::commit();
            return [
                'success' => true,
                'message' => __("An Email Has Sent To ".$user->email.". Please verify your account"),
                'webResponse' => [
                    'success' => __("An Email Has Sent To ".$user->email.". Please verify your account"),
                ],
            ];
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function verifyEmailProcess($request)
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

                return [
                    'success' => $done,
                    'message' => $done ? __('Your email is verified.') : __('Invalid verification code.'),
                    'webResponse' => [
                        'success' => $done ? __('Your email is verified.') : __('Invalid verification code.'),
                    ],
                ];
            }
        }catch(\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function sendForgetPasswordEmail($request)
    {
        if (filter_var($request->email_username, FILTER_VALIDATE_EMAIL)) {
            $where = ['email' => $request->email_username];
        } else {
            $where = ['username' => $request->email_username];
        }
        $user = $this->userRepository->whereFirst($where);
        if (empty($user)) {
            return [
                'success' => false,
                'message' =>  __('User not found'),
                'data' => null
            ];
        }
        if ($user->role == USER_ROLE) {
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return [
                    'success' => false,
                    'message' =>  __('Please enter your username instead of email'),
                    'data' => null
                ];
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
        } catch (\Exception $exception) {
            return $this->errorResponse;
        }

        return [
            'success' => true,
            'message' =>  __('Code has been sent to ') . ' ' . $user->email,
            'data' => null
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function resetPassword($request)
    {
        $where = ['verification_code' => $request->reset_password_code, 'status' => PENDING_STATUS];
        $passwordResetCode = $this->passwordResetRepository->whereFirst($where);
        if (!empty($passwordResetCode)) {
            $where = ['user_id' => $passwordResetCode->user_id, 'status' => PENDING_STATUS];
            $latestResetCode = $this->passwordResetRepository->whereLast($where);
            if (($latestResetCode->verification_code != $request->reset_password_code)) {
                return [
                    'success' => false,
                    'message' =>   __('Your given reset password code is incorrect'),
                    'data' => null
                ];
            }
        } else {
            return [
                'success' => false,
                'message' =>   __('Your given reset password code is incorrect'),
                'data' => null
            ];
        }

        if (!empty($passwordResetCode)) {
            $totalDuration = Carbon::now()->diffInMinutes($passwordResetCode->created_at);
            if ($totalDuration > EXPIRE_TIME_OF_FORGET_PASSWORD_CODE) {
                return [
                    'success' => false,
                    'message' =>  __('Your code has been expired. Please give your code with in') . EXPIRE_TIME_OF_FORGET_PASSWORD_CODE . __('minutes'),
                    'data' => null
                ];
            }
            $where = ['id' => $passwordResetCode->user_id];
            $user = $this->userRepository->whereFirst($where);
            if (empty($user)) {
                return [
                    'success' => false,
                    'message' =>  __('User not found'),
                    'data' => null
                ];
            }
            $where = ['id' => $user->id];
            $data = ['password' => Hash::make($request->new_password)];
            $this->userRepository->update($where, $data);
            $where = ['id' => $passwordResetCode->id];
            $data = ['status' => ACTIVE_STATUS];
            $this->passwordResetRepository->update($where, $data);

            return [
                'success' => true,
                'message' =>  __('Password is reset successfully'),
                'data' => null
            ];
        }

        return [
            'success' => false,
            'message' =>   __('Your given reset password code is incorrect'),
            'data' => null
        ];
    }
}
