<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChildParameterValid
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
            'status' => 'required|regex:/^[a-zA-Z]+$/',
            'student_name' => 'required|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u',
            'student_name' => 'required|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u',
        ]);
        $TopicQuantity = $request->CountOfTopic;
        for ($i = 1; $i <= $TopicQuantity; $i++) {
            $SmallTopic = "Topic" . $i;
            $request->validate([
                $SmallTopic => 'required|regex:/^[1-9]{0,2}$/',
            ]);
            $Quantity = $request->$SmallTopic;
            for( $j = 1; $j <= $Quantity ; $j++){
                $combine = "q" . $i . "-" . $j;
                $request->validate([
                    $combine => 'regex:/^\d{1,2}\-\d{1}$/'
                ]);
            }
        }
        return $next($request);
    }
}
