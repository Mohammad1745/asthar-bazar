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
    /**
     * @var UserService
     */
    private $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
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
        return $this->service->userListQuery();
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
        $data['userDetail'] = $this->service->details($encryptedUserId);

        return view('super_admin.user.details', $data);
    }

    /**
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->store($request), 'superAdmin.user');
    }

    /**
     * @param UpdateUserRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->update($request), 'superAdmin.user');
    }

    /**
     * @param string $encryptedUserId
     * @return RedirectResponse
     */
    public function delete(string $encryptedUserId): RedirectResponse
    {
        return $this->webResponse($this->service->delete($encryptedUserId));
    }

    /**
     * @param string $encryptedUserId
     * @return RedirectResponse
     */
    public function restore(string $encryptedUserId): RedirectResponse
    {
        return $this->webResponse($this->service->restore($encryptedUserId));
    }
}
