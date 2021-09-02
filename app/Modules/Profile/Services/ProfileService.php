<?php


namespace App\Modules\Profile\Services;


use App\Http\Services\ResponseService;
use App\Modules\Profile\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileService extends ResponseService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param object $request
     * @return array
     */
    public function updateProfile(object $request): array
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

            return $this->response($data)->success(isset($data['verified']) ? 'Profile Updated.' : 'Profile Updated. Please Verify Your New Email');
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    private function prepareProfileData(object $request): array
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
     * @param object $request
     * @return array
     */
    public function updatePassword(object $request): array
    {
        try{
            $where = ['id' => Auth::user()->id];
            $password = ['password' => Hash::make($request->password)];
            $this->userRepository->update($where, $password);

            return $this->response()->success('Password Updated');
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }
}
