<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\LandRSchool;
use App\Models\TeacherData;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        $DBSchool = (new LandRSchool)->PushSchool();
        return view('login')->with('School', $DBSchool);
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
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
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        $request->session()->put('username', $request['username'], 'schoolcode', $request['schoolnumber']);
        session()->put('username', $request['username']);
        session()->put('schoolcode', $request['schoolnumber']);
        $TeacherName = (new TeacherData)->GetTeacherName($request['username'], $request['schoolnumber']);
        if ($TeacherName != null) {
            session()->put('TeacherName', $TeacherName);
        }
        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended('front');
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
