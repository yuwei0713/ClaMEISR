<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CountResultParameterValid
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
        $flag = 0;
        if(strlen($request->TeacherName) < 0 || strlen($request->TeacherName) > 10){
            if (preg_match('/[\[\]\\\^\'£$%^&*()}{@:#~?><>,;|\/\-=\-_+¬`]/', $request->TeacherName)) {
                $flag = 1;
            }
        }
        if(strlen($request->Account) < 0 || strlen($request->Account) > 50){
            if (preg_match('/[\[\]\\\^\'£$%^&*()}{@:#~?><>,;|\/\-=\-_+¬`]/', $request->Account)) {
                $flag = 1;
            }
        }
        if(strlen($request->SchoolName) < 0 || strlen($request->SchoolName) > 20){
            if (preg_match('/[\[\]\\\^\'£$%^&*()}{@:#~?><>,;|\/\-=\-_+¬`]/', $request->SchoolName)) {
                $flag = 1;
            }
        }
        if(strlen($request->separate) < 0 || strlen($request->separate) > 30){
            if (preg_match('/[\[\]\\\^\'£$%^&*()}{@:#~?><>,;|\/\-=\-_+¬`]/', $request->separate)) {
                $flag = 1;
            }
        }
        if(strlen($request->kindergarten) < 0 || strlen($request->kindergarten) > 10){
            if (preg_match('/[\[\]\\\^\'£$%^&*()}{@:#~?><>,;|\/\-=\-_+¬`]/', $request->kindergarten)) {
                $flag = 1;
            }
        }
        if(strlen($request->counseling) < 0 || strlen($request->counseling) > 10){
            if (preg_match('/[\[\]\\\^\'£$%^&*()}{@:#~?><>,;|\/\-=\-_+¬`]/', $request->counseling)) {
                $flag = 1;
            }
        }
        if(strlen($request->routinesbased) < 0 || strlen($request->routinesbased) > 10){
            if (preg_match('/[\[\]\\\^\'£$%^&*()}{@:#~?><>,;|\/\-=\-_+¬`]/', $request->routinesbased)) {
                $flag = 1;
            }
        }
        

        if ($flag == 1) {
            return redirect('front');
        }
        return $next($request);
    }
}

