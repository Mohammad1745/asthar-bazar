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
    private $webAuthService;

    /**
     * AuthController constructor.
     * @param WebAuthService $webAuthService
     */
    public function __construct(WebAuthService $webAuthService)
    {
        $this->webAuthService = $webAuthService;
    }

    /**
     * @return RedirectResponse
     */
    public function auth()
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function signUp()
    {
        if (Auth::user() && (Auth::user()->role == SUPER_ADMIN_ROLE)) {
            return redirect()->route('superAdmin.dashboard');
        } else if (Auth::user() && (Auth::user()->role == ADMIN_ROLE)) {
            return redirect()->route('admin.dashboard');
        } else if (Auth::user() && (Auth::user()->role == USER_ROLE)) {
            return redirect()->route('home');
        } else {
            $data['menu'] = 'sign-up';

            return view('auth.sign-up', $data);
        }
    }

    /**
     * @param SignUpRequest $request
     * @return RedirectResponse
     */
    public function signUpProcess(SignUpRequest $request)
    {
        $response = $this->webAuthService->signUpProcess($request);
        if ($response['success']) {
            return redirect()->route('verifyEmail')->with(['success' => $response['message']]);
        } else {
            return redirect()->back()->with(['error' => $response['message']]);
        }
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function verifyEmail()
    {
        if (Auth::user() && (Auth::user()->verification_status == true)) {
            return redirect()->route('home');
        } else {
            $response = $this->webAuthService->sendVerificationEmail();

            return $response['success'] ?
                view('auth.verify_email') :
                redirect()->back()->with($response['webResponse']);
        }
    }

    /**
     * @param VerifyEmailRequest $request
     * @return RedirectResponse
     */
    public function verifyEmailProcess(VerifyEmailRequest $request)
    {
        $response = $this->webAuthService->verifyEmailProcess($request);
        if($response['success']){
            return redirect()->route('root')->with(['success' => $response['message']]);
        }else{
            return redirect()->back()->with(['error' => $response['message']]);
        }
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function signIn()
    {
        if (Auth::user() && (Auth::user()->role == SUPER_ADMIN_ROLE)) {
            return redirect()->route('superAdmin.dashboard');
        } else if (Auth::user() && (Auth::user()->role == ADMIN_ROLE)) {
            return redirect()->route('admin.dashboard');
        } else if (Auth::user() && (Auth::user()->role == USER_ROLE)) {
            return redirect()->route('home');
        } else {
            $data['menu'] = 'sign-in';

            return view('auth.sign-in', $data);
        }
    }

    /**
     * @param SignInRequest $request
     * @return RedirectResponse
     */
    public function signInProcess(SignInRequest $request)
    {
        $response = $this->webAuthService->signInProcess($request);
        if($response['success']){
            return redirect()->route('root')->with(['success' => $response['message']]);
        }else{
            return redirect()->back()->with(['error' => $response['message']]);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function signOut()
    {
        Auth::logout();
        session()->flush();

        return redirect()->route('signIn');
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
    public function forgetPasswordEmailSendProcess(SendForgotPasswordEmailRequest $request)
    {
        $response = $this->webAuthService->sendForgetPasswordEmail($request);
        if($response['success']){
            return redirect()->route('forgetPasswordCode')->with(['success' => $response['message']]);
        }else{
            return redirect()->back()->with(['error' => $response['message']]);
        }
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
    public function forgetPasswordCodeProcess(ResetPasswordRequest $request)
    {
        $response = $this->webAuthService->resetPassword($request);
        if($response['success']){
            return redirect()->route('signIn')->with(['success' => $response['message']]);
        }else{
            return redirect()->back()->with(['error' => $response['message']]);
        }
    }
}
