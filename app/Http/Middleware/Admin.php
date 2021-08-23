<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * @param $request
     * @param Closure $next
     * @return Application|RedirectResponse|Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role==ADMIN_ROLE){
            return $next($request);
        }
        Auth::logout();

        return redirect(route('signIn'))->with('error', 'Unauthorized Request!');
    }
}
