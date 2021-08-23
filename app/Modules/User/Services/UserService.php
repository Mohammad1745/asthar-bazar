<?php


namespace App\Modules\User\Services;


use App\Modules\User\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $errorMessage;
    private $errorResponse;
    private $userRepository;

    /**
     * UserRepository constructor.
     * @param UserRepository $userRepository
     */
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
     * @param $encryptedUserId
     * @return mixed
     */
    public function details($encryptedUserId)
    {
        $where = ['users.id' => decrypt($encryptedUserId)];

        return $this->userRepository->details($where);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        try{
            $userData = $this->prepareUserData($request);
            $this->userRepository->create($userData);

            return [
                'success' => true,
                'message' => __('User has been added.'),
                'webResponse' => [
                    'success' => __('User has been added.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function prepareUserData($request)
    {
        return [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone_code' => $request->phone_code,
            'phone' => $request->phone,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->get('password')),
            'role' => ADMIN_ROLE,
            'email_verification_code' => null,
            'verification_status' => USER_ACTIVE_STATUS
        ];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function update($request) {
        try{
            $where = ['id' => $request->id];
            $userData = $this->prepareUpdatedUserData($request);
            $this->userRepository->update($where, $userData);

            return [
                'success' => true,
                'message' => __('User has been updated.'),
                'webResponse' => [
                    'success' => __('User has been updated.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function prepareUpdatedUserData($request)
    {
        $preparedData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone_code' => $request->phone_code,
            'phone' => $request->phone,
            'username' => $request->username,
            'email' => $request->email
        ];
        if(isset($request->password)){
            $preparedData['password'] = Hash::make($request->get('password'));
        }

        return $preparedData;
    }

    /**
     * @param $encryptedUserId
     * @return array
     */
    public function delete($encryptedUserId)
    {
        try{
            $where = ['id' => decrypt($encryptedUserId)];
            $data = ['verification_status' => USER_DELETE_STATUS];
            $this->userRepository->update($where, $data);

            return [
                'success' => true,
                'message' => 'User has been deleted.',
                'data' => [],
                'webResponse' => [
                    'success' => 'User has been deleted.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $encryptedUserId
     * @return array
     */
    public function restore($encryptedUserId)
    {
        try{
            $where = ['id' => decrypt($encryptedUserId)];
            $data = ['verification_status' => USER_ACTIVE_STATUS];
            $this->userRepository->update($where, $data);

            return [
                'success' => true,
                'message' => 'User has been restored.',
                'data' => [],
                'webResponse' => [
                    'success' => 'User has been restored.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function userListQuery() {
        $users = $this->userRepository->detailsQuery();
        try {
            return datatables($users)
                ->editColumn('first_name', function ($item) {
                    return $item->first_name;
                })
                ->editColumn('last_name', function ($item) {
                    return $item->last_name;
                })
                ->editColumn('role', function ($item) {
                    return userRoll($item->role);
                })
                ->addColumn('wallet', function ($item) {
                    return $item->wallet;
                })
                ->addColumn('verification_status', function ($item) {
                    return userStatus($item->verification_status);
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('superAdmin.user.details', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }
}
