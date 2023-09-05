<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/layout.css" />
    <link href="../css/header.css" rel="stylesheet">
    <script src="../js/option_click.js"></script>
    <link href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-3.5.0.min.js"></script>
</head>

<body>
@include('layouts.header')
    <div class="main-framwork">
        <!--問答-->
        <div class="question-framwork">
            <div class="inner-framwork">
                <div>
                    <h5 class="theme-css">
                        <div class="theme-flex">
                            <div>
                                {{ $BigTopicName }}
                            </div>
                        </div>
                    </h5>
                </div>
                <form action="{{ route('user.Receive') }}" method="POST" id="MeiserForm">
                    @csrf
                    <div>
                        <div>
                            <div>
                                <table id="table" class="option-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="old-css option-css">年齡</th>
                                            <th class="choice-css option-css">尚未</th>
                                            <th class="choice-css option-css">有時</th>
                                            <th class="choice-css option-css">經常</th>
                                            <th class="choice-css option-css">更多</th>
                                            <th class="represent-css option-css">Func</th>
                                            <th class="represent-css option-css">Dev</th>
                                            <th class="represent-css option-css">Out</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="topic-rows" id="q1">
                                            <td>
                                                <div class="topic-css">在家長離開後的20分鐘內可以開始玩耍不哭鬧</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q1" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q1" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q1" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q1" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">E</td>
                                            <td class="represent-css option-css">S</td>
                                            <td class="represent-css option-css">1</td>
                                        </tr>
                                        <tr class="topic-rows" id="q2">
                                            <td>
                                                <div class="topic-css">家長離開時就可以玩耍不哭鬧</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q2" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q2" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q2" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q2" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">E</td>
                                            <td class="represent-css option-css">S</td>
                                            <td class="represent-css option-css">1</td>
                                        </tr>
                                        <tr class="topic-rows" id="q3">
                                            <td>
                                                <div class="topic-css">回應成人的問候</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q3" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q3" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q3" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q3" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">SR</td>
                                            <td class="represent-css option-css">CM</td>
                                            <td class="represent-css option-css">1</td>
                                        </tr>
                                        <tr class="topic-rows" id="q4">
                                            <td>
                                                <div class="topic-css">自己進入教室(包括使用輔具)</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q4" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q4" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q4" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q4" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">I</td>
                                            <td class="represent-css option-css">M</td>
                                            <td class="represent-css option-css">3</td>
                                        </tr>
                                        <tr class="topic-rows" id="q5">
                                            <td>
                                                <div class="topic-css">遵從指令</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q5" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q5" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q5" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q5" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">E</td>
                                            <td class="represent-css option-css">CG</td>
                                            <td class="represent-css option-css">2</td>
                                        </tr>
                                        <tr class="topic-rows" id="q6">
                                            <td>
                                                <div class="topic-css">把東西放在櫃子裡</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q6" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q6" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q6" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q6" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">I</td>
                                            <td class="represent-css option-css">A</td>
                                            <td class="represent-css option-css">3</td>
                                        </tr>
                                        <tr class="topic-rows" id="q7">
                                            <td>
                                                <div class="topic-css">掛外套</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q7" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q7" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q7" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q7" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">I</td>
                                            <td class="represent-css option-css">A</td>
                                            <td class="represent-css option-css">3</td>
                                        </tr>
                                        <tr class="topic-rows" id="q8">
                                            <td>
                                                <div class="topic-css">脫外套</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q8" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q8" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q8" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q8" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">I</td>
                                            <td class="represent-css option-css">A</td>
                                            <td class="represent-css option-css">3</td>
                                        </tr>
                                        <tr class="topic-rows" id="q9">
                                            <td>
                                                <div class="topic-css">選擇要做或要玩的事情</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q9" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q9" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q9" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q9" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">E</td>
                                            <td class="represent-css option-css">CG</td>
                                            <td class="represent-css option-css">3</td>
                                        </tr>
                                        <tr class="topic-rows" id="q10">
                                            <td>
                                                <div class="topic-css">在協助上下車 (但不是用抱的)</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q10" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q10" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q10" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q10" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">I</td>
                                            <td class="represent-css option-css">M</td>
                                            <td class="represent-css option-css">3</td>
                                        </tr>
                                        <tr class="topic-rows" id="q11">
                                            <td>
                                                <div class="topic-css">不需要提示下就可完成所有入園的作息</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q11" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q11" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q11" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q11" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">E</td>
                                            <td class="represent-css option-css">CG</td>
                                            <td class="represent-css option-css">1</td>
                                        </tr>
                                        <tr class="topic-rows" id="q12">
                                            <td>
                                                <div class="topic-css">使用單字跟大人說話</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q12" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q12" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q12" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q12" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">SR</td>
                                            <td class="represent-css option-css">CM</td>
                                            <td class="represent-css option-css">2</td>
                                        </tr>
                                        <tr class="topic-rows" id="q13">
                                            <td>
                                                <div class="topic-css">使用詞彙跟大人說話</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q13" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q13" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q13" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q13" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">SR</td>
                                            <td class="represent-css option-css">CM</td>
                                            <td class="represent-css option-css">2</td>
                                        </tr>
                                        <tr class="topic-rows" id="q14">
                                            <td>
                                                <div class="topic-css">使用完整句跟大人說話</div>
                                            </td>
                                            <td class="old-css option-css">3</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q14" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q14" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q14" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q14" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">SR</td>
                                            <td class="represent-css option-css">CM</td>
                                            <td class="represent-css option-css">2</td>
                                        </tr>
                                        <tr class="topic-rows not-yet" id="q15">
                                            <td>
                                                <div class="topic-css">跟大人說過去(如，昨晚)發生的事情</div>
                                            </td>
                                            <td class="old-css option-css">4</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q15" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q15" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q15" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q15" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">SR</td>
                                            <td class="represent-css option-css">CM</td>
                                            <td class="represent-css option-css">2</td>
                                        </tr>
                                        <tr class="topic-rows not-yet" id="q16">
                                            <td>
                                                <div class="topic-css">跟大人說未來(如，今天晚上)將發生的事情</div>
                                            </td>
                                            <td class="old-css option-css">5</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q16" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q16" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q16" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q16" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">SR</td>
                                            <td class="represent-css option-css">CM</td>
                                            <td class="represent-css option-css">2</td>
                                        </tr>
                                        <tr class="topic-rows not-yet" id="q17">
                                            <td>
                                                <div class="topic-css">可以辨認自己的名字(如，寫在自己的櫃子上的或寫在簽到表上的名字)</div>
                                            </td>
                                            <td class="old-css option-css">5</td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q17" value="1"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q17" value="2"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q17" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="option-css">
                                                <span class="option-size">
                                                    <span class="option-size-adjust">
                                                        <div class="option-size-inner">
                                                            <input type="radio" name="q17" value="3"
                                                                class="option-circle">
                                                        </div>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="represent-css option-css">E</td>
                                            <td class="represent-css option-css">CG</td>
                                            <td class="represent-css option-css">2</td>
                                        </tr>
                                    </tbody>
                                    <div class="replenish-framwork">
                                        <ol>
                                            <li><span>Func(功能性領域)： E=投入，I=獨立性，SR=社會關係</span></li>
                                            <li><span>Dev(發展領域)： A=適應性，CG=認知，CM=溝通，M=動作，S=社交</span></li>
                                            <li><span>Out(成效)： 1=正向社會關係，2=獲得和使用知識和技巧，3=採取行動以滿足需求</span></li>
                                        </ol>
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="send-framwork">
                        <div class="pre-page">
                            <button type="button" class="pre-button" onclick=""><span>回上頁</span></button>
                        </div>
                        <div class="next-page">
                            <button type="button" class="next-button" onclick="checkoutput()"><span>下一頁</span></button>
                            <div id="fill_alart" class="fill-alart"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>