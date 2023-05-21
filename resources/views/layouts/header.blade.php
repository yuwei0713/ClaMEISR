<header id="top">
    <div class="header_container">
        <h1 class="logo header_right"><a href="{{ url('/front') }}">ClaMEISR</a></h1>
        <!--MEISER icon-->
        <div class="header_left">
            <div class="toplink"></div>
            @auth
            <div>
                <span id="countdowntime" class="countdown-framework"></span>
                <script src="../js/ifvisible.js" type="text/javascript"></script>
                <script src="../js/countdownworker.js" type="text/javascript"></script>
            </div>
            {{auth()->user()->name}}
            <div class="UserCss" style="margin-right: 10px;">
                您好~
                @if (session('TeacherName'))
                {{ session('TeacherName') }}
                @elseif (session('username'))
                {{ session('username') }}
                @endif
            </div>
            <div>
                <span id="reciprocal"></span>
            </div>
            <div class="text-end">
                <a href="{{ route('logout.perform') }}" class="btn btn-outline-dark me-2">Logout</a>
            </div>
            @else
            <div class="text-end">
                <a href="{{ route('login.show') }}" class="btn btn-outline-dark me-2">Login</a>
            </div>
            @endauth
        </div>
    </div>
</header>