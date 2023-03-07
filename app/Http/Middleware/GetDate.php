<?php

namespace App\Http\Middleware;


class GetDate
{
    public function GetYearSemester()
    {
        $CurrentYear = date('Y') - 1911;
        $taiwan_month = date('m');
        $CurrentSemester = "";
        $Filldate = date('Y-m-d');
        if (($taiwan_month >= 8 && $taiwan_month <= 12) || ($taiwan_month < 2 && $taiwan_month >= 1)) {
            if(($taiwan_month < 2 && $taiwan_month >= 1)){ //過年了 但學年還沒過
               $CurrentYear -= 1;
            }
            $CurrentSemester = "上";
        }
        if ($taiwan_month >= 2 && $taiwan_month < 8) {
            $CurrentYear -= 1;
            $CurrentSemester = "下";
        }
        return [$CurrentYear,$CurrentSemester];
    }
    public function GetToday(){
        $Today = date('Y-m-d');
        return $Today;
    }
}
