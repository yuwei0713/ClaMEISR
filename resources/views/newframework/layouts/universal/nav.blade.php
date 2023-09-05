    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="{{ url('/front') }}" class="navbar-brand p-0">
            <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>ClaMEISR</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                @auth
                <!-- 倒計時 -->
                <div class="nav-item dropdown">
                    <span class="nav-link" id="countdowntime" class="countdown-framework"></span>
                    <script src="../js/ifvisible.js" type="text/javascript"></script>
                    <script src="../js/countdownworker.js" type="text/javascript"></script>
                </div>
                @endauth
                <a href="{{ url('/front') }}" class="nav-item nav-link">首頁</a>
                @auth
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">功能</a>
                    <div class="dropdown-menu">
                        <a onclick="location.href='{{ route('cla.unify.show') }}'" class="dropdown-item">問卷與結果查詢</a>
                        <!-- <a href="detail.html" class="dropdown-item">Blog Detail</a> -->
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        @if (session('TeacherName'))
                        {{ session('TeacherName') }}
                        @elseif (session('username'))
                        {{ session('username') }}
                        @endif
                    </a>
                    <div class="dropdown-menu">
                        <!-- <a onclick="historyteacher()" class="dropdown-item">個人檔案</a> -->
                        <a href="{{ route('logout.perform') }}" class="dropdown-item">登出</a>
                    </div>
                </div>
                @endauth
            </div>
            <!-- <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton> -->
            @guest
            <a href="{{ route('login.show') }}" class="btn btn-primary py-2 px-4 ms-3">LOGIN</a>
            @endguest
        </div>
    </nav>
    <script src="../newframework/lib/wow/wow.min.js"></script>