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
        $request->validate([
            // 'TeacherName' => ['required','regex:/^[^!@#$%^&*()_+\{\}:“<>?,.\\/;\[\]\|`~]+$/'],
            'Account' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'SchoolName' => 'required|regex:/^[\x{4e00}-\x{9fa5}]+$/u',
            'separate' => 'required|regex:/^[_a-zA-Z0-9]+$/',
            'kindergarten' => 'required|regex:/^[\x{4e00}-\x{9fa5}~0-9]+$/u',
            'counseling' => 'required|regex:/^[\x{4e00}-\x{9fa5}~0-9]+$/u',
            'routinesbased' => 'required|regex:/^[\x{4e00}-\x{9fa5}~0-9]+$/u',
        ]);
        return $next($request);
    }
}
