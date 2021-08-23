<?php

namespace App\Modules\Authentication\Controllers\Web;

use App\Modules\Authentication\Requests\ResetPasswordRequest;
use App\Modules\Authentication\Requests\SendForgotPasswordEmailRequest;
use App\Modules\Authentication\Requests\SignInRequest;
use App\Modules\Authentication\Requests\SignUpRequest;
use App\Modules\Authentication\Requests\VerifyEmailRequest;
use App\Modules\Authentication\Services\WebAuthService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    private $service;

    /**
     * AuthController constructor.
     * @param WebAuthService $service
     */
    public function __construct(WebAuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @return RedirectResponse
     */
    public function auth(): RedirectResponse
    {
        $user = Auth::user();
        if (!empty($user) && $user->role == SUPER_ADMIN_ROLE) {
            return redirect()->route('superAdmin.dashboard');
        } else if (!empty($user) && $user->role == ADMIN_ROLE) {
            return redirect()->route('admin.dashboard');
        } else if (!empty($user) && $user->role == USER_ROLE) {
            return redirect()->route('home');
        } else {
            return redirect()->route('signIn');
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function signUp()
    {
        return view('auth.sign-up', ['menu' => 'sign-up']);
    }

    /**
     * @param SignUpRequest $request
     * @return RedirectResponse
     */
    public function signUpProcess(SignUpRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->signUpProcess($request), 'emailVerificationCode');
    }

    /**
     * @return RedirectResponse
     */
    public function emailVerificationCode(): RedirectResponse
    {
        return $this->webResponse( $this->service->sendVerificationEmail(), 'verifyEmail');
    }

    /**
     * @return Application|Factory|View
     */
    public function verifyEmail()
    {
        return view('auth.verify_email');
    }

    /**
     * @param VerifyEmailRequest $request
     * @return RedirectResponse
     */
    public function verifyEmailProcess(VerifyEmailRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->verifyEmailProcess($request), 'root');
    }

    /**
     * @return Application|Factory|View
     */
    public function signIn()
    {
        return view('auth.sign-in', ['menu' => 'sign-in']);
    }

    /**
     * @param SignInRequest $request
     * @return RedirectResponse
     */
    public function signInProcess(SignInRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->signInProcess($request), 'root');
    }

    /**
     * @return RedirectResponse
     */
    public function signOut(): RedirectResponse
    {
        return $this->webResponse($this->service->signOut(), 'root');
    }

    /**
     * @return Application|Factory|View
     */
    public function forgetPassword()
    {
        return view('auth.forget_password_email');
    }

    /**
     * @param SendForgotPasswordEmailRequest $request
     * @return RedirectResponse
     */
    public function forgetPasswordEmailSendProcess(SendForgotPasswordEmailRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->sendForgetPasswordEmail($request), 'forgetPasswordCode');
    }

    /**
     * @return Application|Factory|View
     */
    public function forgetPasswordCode()
    {
        return view('auth.forget_password');
    }

    /**
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     */
    public function forgetPasswordCodeProcess(ResetPasswordRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->resetPassword($request), 'signIn');
    }
}
