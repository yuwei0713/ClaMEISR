<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class QuestionnaireParameterValid
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
        if ($request->QuestionCode < 0 || $request->QuestionCode > 100) {
            $flag = 1;
        }
        if ($request->FillTime < 0 || $request->FillTime > 999) {
            $flag = 1;
        }
        if (strlen($request->StudentID) != 11) {
            if (preg_match('/[^a-zA-Z0-9]/', $request->StudentID)) {
                $flag = 1;
            }
        }
        if ($request->CountOfTopic < 0 || $request->CountOfTopic > 99) {
            $flag = 1;
        } else {
            $TopicQuantity = $request->CountOfTopic;
            for ($i = 1; $i <= $TopicQuantity; $i++) {
                $SmallTopic = "Topic" . $i;
                $Quantity = $request->$SmallTopic;
                if($Quantity < 0 || $Quantity > 99){
                    $flag = 1;
                    dd("Quantity");
                }else{
                    for( $j = 1; $j <= $Quantity ; $j++){
                        $combine = "q" . $i . "-" . $j;
                        if (strlen($request->$combine) > 3) {
                            $flag = 1;
                        }
                    }
                }
            }
        }
        if($request->FillStatus != 0 && $request->FillStatus != 1){
            $flag = 1;
        }
        if($request->ChildAge < 0 || $request->ChildAge > 99){
            $flag = 1;
        }
        if($request->NextOrFinal != 0 && $request->NextOrFinal != 1){
            $flag = 1;
        }

        if($flag == 1){
            return redirect('front');
        }
        return $next($request);
    }
}
