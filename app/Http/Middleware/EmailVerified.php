<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->verification_status){
            return $next($request);
        }elseif(Auth::user()->verification_status==USER_DELETE_STATUS){
            Auth::logout();

            return redirect()->back()->with(['error' => 'Not Reachable']);
        }

        return redirect(route('verifyEmail'))->with(['error' => 'Email not verified!']);
    }
}
