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
    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
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
        $response = $this->profileService->updateProfile($request);

        return $response['success'] ?
            $response['data']['verified'] ?
                redirect(route('profile'))->with($response['webResponse']):
                redirect(route('verifyEmail'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $response = $this->profileService->updatePassword($request);

        return redirect(route('profile'))->with($response['webResponse']);

    }
}
