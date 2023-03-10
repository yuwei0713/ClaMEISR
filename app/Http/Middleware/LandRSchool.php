<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;

class LandRSchool
{
    public function PushSchool()
    {
        $DBSchool = DB::table('schooltable')->select('SchoolName','SchoolCode')->distinct()->get()->toArray();
        //取值方法 
        return $DBSchool;
    }
}
