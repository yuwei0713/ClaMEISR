<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\LandRSchool;
use App\Models\TeacherData;

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
        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'schoolnumber' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password', 'schoolnumber');
        //if (Auth::attempt($credentials)) {
        //    return redirect()->to('index')
        //                ->withSuccess('Signed in');
        //}

        //return redirect("login")->withSuccess('Login details are not valid');

        if (!Auth::attempt($credentials)) :
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;
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
}
