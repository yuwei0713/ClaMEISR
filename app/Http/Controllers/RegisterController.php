<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\LandRSchool;
use App\Models\TeacherData;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $DBSchool = (new LandRSchool)->PushSchool();
        return view('register')->with('School',$DBSchool);
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) 
    {
        $request->validate([
            'username' => 'required|unique:users',
            'schoolnumber' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $data = $request->all();
        //dd($data);
        User::create([
            'username'  =>  $data['username'],
            'schoolnumber' =>  $data['schoolnumber'],
            'password' => $data['password'],
        ]);
        (new TeacherData)->CreateDefaultData($data['username'],$data['schoolnumber']);
        return redirect('front');
    }
}