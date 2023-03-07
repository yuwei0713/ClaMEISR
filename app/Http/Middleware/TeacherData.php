<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;

class TeacherData
{
    public function CreateDefaultData($account, $schoolcode)
    {
        DB::table('userdatatable')->insert([
            'Username' => $account,
            'Schoolcode' => $schoolcode
        ]);
    }
    public function GetTeacherName($account, $schoolcode)
    {
        $Fill = DB::table('userdatatable')->select('IfFill')->where('Username', $account)->where('SchoolCode', $schoolcode)->get()->toArray();
        if (reset($Fill)->IfFill == 0) { //尚未填寫
            return null;
        } else {
            $TeacherName = DB::table('userdatatable')->select('TeacherName')->where('Username', $account)->where('SchoolCode', $schoolcode)->get()->toArray();
            $TeacherName = reset($TeacherName)->TeacherName;
            return $TeacherName;
        }
    }
    public function InsertTeacherData($request)
    {
        try {
            $flag = DB::table('userdatatable')->where('Username', $request->Account)->update([
                'TeacherName' => $request->TeacherName,
                'Separate' => $request->separate,
                'Kindergarten' => $request->kindergarten,
                'Counseling' => $request->counseling,
                'RoutinesBased' => $request->routinesbased,
                'IfFill' => "1"
            ]);
            return $flag;
        } catch (\Illuminate\Database\QueryException $e) {
            return 0;
        }
    }
    public function CheckIfInsert($account)
    {
        $flag = DB::table('userdatatable')->select('IfFill')->where('Username', $account)->get()->toArray();
        $flag = reset($flag)->IfFill;
        return $flag;
    }
    public function UpdateTeacherData($request)
    {
        try {
            DB::table('userdatatable')->where('Username', $request->Account)->update([
                'TeacherName' => $request->TeacherName,
                'Separate' => $request->separate,
                'Kindergarten' => $request->kindergarten,
                'Counseling' => $request->counseling,
                'RoutinesBased' => $request->routinesbased,
            ]);
            return 1;
        } catch (\Illuminate\Database\QueryException $e) {
            return 0;
        }
    }
    public function GetAllTeacherData($account, $schoolcode)
    {
        $BasicData = DB::table('userdatatable')->where('Username', $account)->where('SchoolCode', $schoolcode)->get()->toArray();
        $BasicData = reset($BasicData);
        $BasicData = json_decode(json_encode($BasicData), true);
        return $BasicData;
    }
}
