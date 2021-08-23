<?php

namespace App\Modules\User\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Modules\User\Requests\StoreUserRequest;
use App\Modules\User\Requests\UpdateUserRequest;
use App\Modules\User\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Application|Factory|View
     */
    public function user()
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'user';
        $data['user'] = Auth::user();

        return view('super_admin.user.content', $data);
    }

    /**
     * @return mixed
     */
    public function userList()
    {
        return $this->userService->userListQuery();
    }

    /**
     * @param $encryptedUserId
     * @return Application|Factory|View
     */
    public function details($encryptedUserId)
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'user';
        $data['user'] = Auth::user();
        $data['userDetail'] = $this->userService->details($encryptedUserId);

        return view('super_admin.user.details', $data);
    }

    /**
     * @param StoreUserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $response = $this->userService->store($request);

        return redirect(route('superAdmin.user'))->with($response['webResponse']);
    }

    /**
     * @param UpdateUserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request)
    {
        $response = $this->userService->update($request);

        return redirect(route('superAdmin.user'))->with($response['webResponse']);
    }

    /**
     * @param $encryptedUserId
     * @return Application|RedirectResponse|Redirector
     */
    public function delete($encryptedUserId)
    {
        $response = $this->userService->delete($encryptedUserId);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedUserId
     * @return Application|RedirectResponse|Redirector
     */
    public function restore($encryptedUserId)
    {
        $response = $this->userService->restore($encryptedUserId);

        return redirect()->back()->with($response['webResponse']);
    }
}
