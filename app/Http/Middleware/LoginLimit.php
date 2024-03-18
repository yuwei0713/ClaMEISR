<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $iflimit = $this->checkTooManyFailedAttempts();
        if(!$iflimit){
            return redirect()->to('login')
                ->withErrors(trans('auth.throttle'));
        }
        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'schoolnumber' => 'required|regex:/^\d{1,2}$/',
            'password' => 'required|regex:/^[a-zA-Z0-9]+$/',
        ]);

        $credentials = $request->only('username', 'password', 'schoolnumber');

        if (!Auth::attempt($credentials)) :
            RateLimiter::hit($this->throttleKey(), $seconds = 360);
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;
        RateLimiter::clear($this->throttleKey());
        return $next($request);
    }
    public function throttleKey()
    {
        return request()->ip();
    }
    public function checkTooManyFailedAttempts()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return true;
        }
        return false;
    }
}
