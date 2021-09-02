<?php

namespace App\Modules\Profile\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Modules\Profile\Requests\UpdatePasswordRequest;
use App\Modules\Profile\Requests\UpdateProfileRequestRequest;
use App\Modules\Profile\Services\ProfileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @var ProfileService
     */
    private $service;

    /**
     * @param ProfileService $service
     */
    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function profile()
    {
        $data['base'] = 'account';
        $data['menu'] = 'profile';
        $data['user'] = Auth::user();

        return view('user.profile.content', $data);
    }

    /**
     * @param UpdateProfileRequestRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateProfileRequestRequest $request)
    {
        $response = $this->service->updateProfile($request);

        return $response['success'] ?
            $response['data']['verified'] ?
                redirect(route('profile'))->with($response['message']):
                redirect(route('verifyEmail'))->with($response['message']):
            redirect()->back()->with($response['message']);
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->updatePassword($request), 'profile');
    }
}
