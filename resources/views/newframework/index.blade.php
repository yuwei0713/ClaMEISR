<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8 width=device-width, initial-scale=1">
    <title>ClaMEISR 首頁</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../newframework/img/favicon.ico" rel="icon">

    <!-- Icon Font Stylesheet -->
    <link href="../newframework/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="../newframework/css/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../newframework/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../newframework/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../newframework/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../newframework/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../newframework/css/woodstyle.css" rel="stylesheet">
    <link href="../newframework/css/cafestyle.css" rel="stylesheet">
    <link href="../newframework/css/caferesponsive.css" rel="stylesheet">
    <link href="../newframework/css/startupstyle.css" rel="stylesheet">
    <link href="../newframework/css/digimediastyle.css" rel="stylesheet">
    <link href="../newframework/css/style.css" rel="stylesheet">

    <link href="../newframework/css/first_page_layout.css" rel="stylesheet">
    <script src="../js/jquery-3.5.0.min.js"></script>
</head>

<body>
    @include('layouts.session-message')
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary spinner" role="status" nonce="{{ csp_nonce() }}">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Carousel And Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <!-- Navbar Start -->
        @include('newframework.layouts.universal.nav')
        <!-- Navbar End -->
        <!-- Carousel Start -->
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="../image/shizi.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3 carousel-image">
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">歡迎使用 ClaMEISR</h1>
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Classroom Measure of
                                Engagement, Independence,<p> and Social Relationships Solution</h5>
                            @auth
                            <a name="fillstatus" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">資料新增</a>
                            @if($flag == 0)
                            <a name="DirectEmpty" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @else
                            <a href="#services" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @endif
                            @else
                            <a href="{{ route('login.show') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">資料新增</a>
                            <a href="{{ route('login.show') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="../image/tanxiu.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3 carousel-image">
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">歡迎使用 ClaMEISR</h1>
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Classroom Measure of
                                Engagement, Independence,<p> and Social Relationships Solution</h5>
                            @auth
                            <a name="fillstatus" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">資料新增</a>
                            @if($flag == 0)
                            <a name="DirectEmpty" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @else
                            <a href="#services" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @endif
                            @else
                            <a href="{{ route('login.show') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">資料新增</a>
                            <a href="{{ route('login.show') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="../image/houli.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3 carousel-image">
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">歡迎使用 ClaMEISR</h1>
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Classroom Measure of
                                Engagement, Independence,<p> and Social Relationships Solution</h5>
                            @auth
                            <a name="fillstatus" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">資料新增</a>
                            @if($flag == 0)
                            <a name="DirectEmpty" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @else
                            <a href="#services" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @endif
                            @else
                            <a href="{{ route('login.show') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">資料新增</a>
                            <a href="{{ route('login.show') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">問卷填寫</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
    </div>
    <!-- Carousel End -->


    <!-- Feature Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light process-icon">
                            <i class="fa fa-user-check fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">01</h1>
                    </div>
                    <h5>填寫個人資料</h5>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light process-icon">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">02</h1>
                    </div>
                    <h5>填寫兒童資料</h5>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light process-icon">
                            <i class="fa fa-drafting-compass fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">03</h1>
                    </div>
                    <h5>開始填答問卷</h5>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light process-icon">
                            <i class="fa fa-headphones fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">04</h1>
                    </div>
                    <h5>查詢問卷結果</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->
    @auth
    <!-- About Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0 about-image">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100 about-image-objict" src="../newframework/img/about.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4">關於您</h1>
                        </div>
                        <p class="mb-4 pb-2">您目前使用本網站的基本資訊</p>
                        <div class="row g-4 mb-4 pb-2">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white process-icon">
                                        <i class="fa fa-users fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">{{$ChildCount}}</h2>
                                        <p class="fw-medium mb-0">已填寫兒童資料</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white process-icon">
                                        <i class="fa fa-check fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h2 class="text-primary mb-1" data-toggle="counter-up">{{$FillCount}}</h2>
                                        <p class="fw-medium mb-0">已填答問卷數</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($flag == 0)
                        <a name="DirectEmpty">查看結果</a>
                        @else
                        <a href='{{ route('cla.unify.show') }}'" class="btn btn-primary py-3 px-5">查看結果</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div id="services" class="services section about_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h1 class="display-5 mb-5">現有功能</h1>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="naccs">
                        <div class="grid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="menu">
                                        <div class="first-thumb active">
                                            <div class="thumb">
                                                <span class="icon"><img src="../newframework/img/service-icon-01.png" alt=""></span>
                                                兒童檔案
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img src="../newframework/img/service-icon-02.png" alt=""></span>
                                                兒童問卷
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img src="../newframework/img/service-icon-03.png" alt=""></span>
                                                紀錄與報表
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img src="../newframework/img/service-icon-04.png" alt=""></span>
                                                個人資料
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ul class="nacc">
                                        <li class="active">
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>兒童檔案填寫及查詢</h4>
                                                                <p>填寫或修改兒童基本資料</p>
                                                                <div class="content_text">
                                                                    <div class="services-option-framework">
                                                                        <div class="main-white-button"><a name="fillstatus"><i class="fa fa-eye"></i>兒童資料新增</a>
                                                                        </div>
                                                                        <div class="main-white-button">
                                                                            @if($flag == 0)
                                                                            <a name="DirectEmpty">
                                                                                @else
                                                                                <a name="childhistorycheck">
                                                                                    @endif
                                                                                    <i class="fa fa-eye"></i>
                                                                                    兒童資料查看
                                                                                </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="../newframework/img/new-services-image-01.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>兒童問卷填寫</h4>
                                                                <p>藉由填寫問卷，記錄孩子的行為、社交以及發展</p>
                                                                <div class="content_text">
                                                                    <div class="services-option-framework">
                                                                        @for( $i = 0;$i < count($Questionnaire) ;$i++ ) <div class="main-white-button">
                                                                            @if($flag == 0)
                                                                            <a name="DirectEmpty">
                                                                                @else
                                                                                <a name="fillnumber" data-fillnumber="{{$Questionnaire[$i]->QuestionCode}}">
                                                                                    @endif
                                                                                    <i class="fa fa-eye"></i>
                                                                                    {{ $Questionnaire[$i]->QuestionName }}
                                                                                </a>
                                                                    </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 align-self-center">
                                                        <div class="right-image">
                                                            <img src="../newframework/img/new-services-image-02.jpg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                </li>
                                <li>
                                    <div>
                                        <div class="thumb">
                                            <div class="row">
                                                <div class="col-lg-6 align-self-center">
                                                    <div class="left-text">
                                                        <h4>問卷歷史紀錄及結果查詢</h4>
                                                        <p>查詢問卷以及結果的歷史資訊，也可查看詳細資訊</p>
                                                        <div class="content_text">
                                                            <div class="services-option-framework">
                                                                <div class="main-white-button">
                                                                    @if($flag == 0)
                                                                    <a name="DirectEmpty">
                                                                        @else
                                                                        <a href='{{ route('cla.unify.show') }}'">
                                                                            @endif
                                                                            <i class="fa fa-eye"></i>
                                                                            問卷與結果查詢
                                                                        </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 align-self-center">
                                                    <div class="right-image">
                                                        <img src="../newframework/img/new-services-image-03.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <div class="thumb">
                                            <div class="row">
                                                <div class="col-lg-6 align-self-center">
                                                    <div class="left-text">
                                                        <h4>個人資料</h4>
                                                        <p>修改教師個人資料以及查看操作手冊</p>
                                                        <div class="content_text">
                                                            <div class="services-option-framework">
                                                                <div class="main-white-button"><a id="historyteacher"><i class="fa fa-eye"></i>教師基本資料</a>
                                                                </div>
                                                                <div class="main-white-button"><a href="../file/ClaMEISR-manual.pdf" download="教學手冊.pdf"><i class="fa fa-eye"></i>教學手冊下載(PDF檔)</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 align-self-center">
                                                    <div class="right-image">
                                                        <img src="../newframework/img/new-services-image-04.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Service End -->

    <!-- about section start -->
    <div class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="about_taital">About Us</h1>
                    <div class="bulit_icon"><img src="../newframework/img/bulit-icon.png"></div>
                </div>
            </div>
            <div class="about_section_2 layout_padding">
                <div class="image_iman"><img src="../newframework/img/new-about-img.jpg" class="about_img"></div>
                <div class="about_taital_box">
                    <h1 class="about_taital_1">ClaMEISR</h1>
                    <p class=" about_text">ClaMEISR 網站是由中臺科技大學以及東海大學聯合打造，透過網站提供的問卷，經由填寫過後可得知兒童目前的狀況</p>
                    <!-- <div class="readmore_btn"><a href="#">Read More</a></div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->
    @endauth

    <!-- Team End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="{{ url('/front') }}">ClaMEISR.thu.edu.tw</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom">東海大學HPC 實驗室</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>
    @auth
    @include('newframework.layouts.cardmodel.childempty')
    @include('newframework.layouts.cardmodel.childhistorycard')
    @include('newframework.layouts.cardmodel.childquestionfill')
    @include('newframework.layouts.cardmodel.statuscard')
    @include('newframework.layouts.cardmodel.teachercard')
    @endauth
        <!-- JavaScript Libraries -->
    
    <script src="../newframework/js/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../newframework/lib/easing/easing.min.js"></script>
    <script src="../newframework/lib/waypoints/waypoints.min.js"></script>
    <script src="../newframework/lib/counterup/counterup.min.js"></script>
    <script src="../newframework/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../newframework/lib/isotope/isotope.pkgd.min.js"></script>
    <!-- <script src="../newframework/lib/lightbox/js/lightbox.min.js"></script> -->
    <script src="../newframework/js/first_page.js"></script>
    <!-- Template Javascript -->
    <script src="../newframework/js/main.js"></script>
</body>

</html>