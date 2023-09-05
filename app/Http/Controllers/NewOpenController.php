<?php

namespace App\Http\Controllers;

class NewOpenController extends Controller
{
    public function index(){
        return view('newframework.index');
    }
    public function childdata(){
        return view('newframework.childdata');
    }
    public function information(){
        return view('newframework.QRUnifyPage');
    }
    public function result(){
        return view('newframework.Result');
    }
    public function detailresult(){
        return view('newframework.DetailResult');
    }
    public function questionnaire(){
        return view('newframework.Questionnaire');
    }
}
