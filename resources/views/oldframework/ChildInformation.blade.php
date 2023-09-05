<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>學生基本資料填寫</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./css/student_information_layout.css" />
    <link rel="stylesheet" type="text/css" href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" />
    <link href="../css/header.css" rel="stylesheet">
    <script src="../js/jquery-3.5.0.min.js"></script>
    <script src="../js/childinfo_check.js"></script>
    <script src="../js/countage.js"></script>
    <script src="../js/gijgo/js/gijgo.min.js" type="text/javascript"></script>
    <link href="../js/gijgo/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    @include('layouts.session-message')
    @include('layouts.header')
    <div class="main-framwork">
        <!--問答-->
        <div class="question-framwork">
            <div class="inner-framwork">
                <div>
                    <h5 class="theme-css">
                        <div class="theme-flex">
                            <div>
                                兒童基本資料填寫
                            </div>
                        </div>
                    </h5>
                    <div class="form_detail"></div>
                </div>
                @include('layouts.childdata.Basic')
            </div>
        </div>
    </div>
</body>

</html>