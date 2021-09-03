<?php


namespace App\Modules\User\Services;


use App\Http\Services\ResponseService;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService extends ResponseService
{
    private $userRepository;

    /**
     * UserRepository constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $encryptedUserId
     * @return mixed
     */
    public function details(string $encryptedUserId)
    {
        $where = ['users.id' => decrypt($encryptedUserId)];

        return $this->userRepository->details($where);
    }

    /**
     * @param object $request
     * @return array
     */
    public function store(object $request): array
    {
        try{
            $userData = $this->prepareUserData($request);
            $this->userRepository->create($userData);

            return $this->response()->success('User has been added');
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    private function prepareUserData(object $request): array
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
     * @param object $request
     * @return mixed
     */
    public function update(object $request) {
        try{
            $where = ['id' => $request->id];
            $userData = $this->prepareUpdatedUserData($request);
            $this->userRepository->update($where, $userData);

            return $this->response()->success('User has been updated');
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param object $request
     * @return array
     */
    private function prepareUpdatedUserData(object $request): array
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
     * @param string $encryptedUserId
     * @return array
     */
    public function delete(string $encryptedUserId): array
    {
        try{
            $where = ['id' => decrypt($encryptedUserId)];
            $data = ['verification_status' => USER_DELETE_STATUS];
            $this->userRepository->update($where, $data);

            return $this->response()->success('User has been deleted');
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @param string $encryptedUserId
     * @return array
     */
    public function restore(string $encryptedUserId): array
    {
        try{
            $where = ['id' => decrypt($encryptedUserId)];
            $data = ['verification_status' => USER_ACTIVE_STATUS];
            $this->userRepository->update($where, $data);

            return $this->response()->success('User has been restored.');
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
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
