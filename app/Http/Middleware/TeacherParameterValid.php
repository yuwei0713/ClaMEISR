<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeacherParameterValid
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
        if (strpbrk($request->TeacherName,'[] !@#$%^&*()-=+\\\/?')) {
            $flag = 1;
        }
        

        if ($flag == 1) {
            return redirect('front');
        }
        return $next($request);
    }
}
