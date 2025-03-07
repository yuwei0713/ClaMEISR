<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class QuestionnaireGetValid
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
            'QuestionCode' => 'required|regex:/^[1-9]{1,2}/',
            'child' => 'required|regex:/^[a-zA-Z0-9\-]+$/',
        ]);
        return $next($request);
    }
}
