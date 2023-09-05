<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>學生基本資料填寫</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <!--<link href="../newframework/img/favicon.ico" rel="icon">-->

    <!-- Google Web Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="../newframework/font-awesome/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../newframework/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../newframework/css/woodstyle.css" rel="stylesheet">
    <link href="../newframework/css/exception-nav.css" rel="stylesheet">
    <link href="../newframework/css/startupstyle.css" rel="stylesheet">
    <link href="../newframework/css/caferesponsive.css" rel="stylesheet">
    

    <link rel="stylesheet" type="text/css" href="../newframework/css/childdata/childdata.css" />

    <script src="../js/jquery-3.5.0.min.js"></script>
    <script src="../newframework/lib/wow/wow.min.js"></script>
    <script src="../newframework/js/childdata/countage.js"></script>
    <script src="../js/gijgo/js/gijgo.min.js" type="text/javascript"></script>
    <link href="../js/gijgo/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="../newframework/js/childdata/childinfo_check.js"></script>
    

</head>

<body>
    @include('newframework.layouts.universal.nav')
    <div class="main-framwork">
        <!--選項-->
        <div class="titleoption-framework">
            <div id="Basic-label" class="titleoption-inner-framework" onclick="ChangePage('basic')">
                <div>
                    <span>基本資料</span>
                </div>
            </div>
            <div id="Diagnosis-label" class="titleoption-inner-framework" onclick="ChangePage('diagnosis')">
                <div>
                    <span>診斷資料</span>
                </div>
            </div>
            <div id="Family-label" class="titleoption-inner-framework" onclick="ChangePage('family')">
                <div>
                    <span>家庭資料</span>
                </div>
            </div>
        </div>
        <!--問答-->
        <div class="question-framwork">
            <div class="inner-framwork">
                <form action="{{ route('child.history.information.perform') }}" method="POST" id="CIForm">
                    @csrf
                    <input type="hidden" name="OldStudentID" value="{{ $ChildFullData['StudentID'] }}">
                    <div>
                        @include('newframework.layouts.historychilddata.Basic')
                        @include('newframework.layouts.historychilddata.Diagnosis')
                        @include('newframework.layouts.historychilddata.Family')
                    </div>
                    <div class="send-framwork">
                        <div class="pre-page">
                            <button id="pre_page_button" type="button" class="pre-button" onclick=""><span>回首頁</span></button>
                        </div>
                        <div class="next-page">
                            <button id="next_page_button" type="button" class="next-button" onclick=""><span>下一頁</span></button>
                            <div id="fill_alart" class="fill-alart"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../newframework/lib/lightbox/js/lightbox.min.js"></script>
<script src="../newframework/js/main.js"></script>
<script src="../newframework/js/childdata/changepage.js"></script>

</html>