<?php


namespace App\Modules\Profile\Services;


use App\Modules\Profile\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    private $errorMessage;
    private $errorResponse;
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
    public function updateProfile($request)
    {
        try{
            DB::beginTransaction();
            $data = ['verified' => true];
            $where = ['id' => Auth::user()->id];
            $profileData = $this->prepareProfileData($request);
            if($request->email != Auth::user()->email){
                $profileData['verification_status'] = false;
                $data['verified'] = false;
            }
            $this->userRepository->update($where, $profileData);
            DB::commit();

            return [
                'success' => true,
                'message' => isset($data['verified']) ? 'Profile Updated.' : 'Profile Updated. Please Verify Your New Email',
                'data' => $data,
                'webResponse' => [
                    'success' => isset($data['verified']) ? 'Profile Updated.' : 'Profile Updated. Please Verify Your New Email',
                ],
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function prepareProfileData($request)
    {
        return [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_code' => $request->phone_code,
            'phone' => $request->phone,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'country' => $request->country
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function updatePassword($request)
    {
        try{
            $where = ['id' => Auth::user()->id];
            $password = ['password' => Hash::make($request->password)];
            $this->userRepository->update($where, $password);

            return [
                'success' => true,
                'message' => 'Password Updated.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Password Updated.',
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }
}
