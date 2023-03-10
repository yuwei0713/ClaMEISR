@extends('layouts.auth-master')

@section('content')
<!-- 左側內容 -->
<div class="content-framework">
  <div class="left-framework">
    <span class="font-style">歡迎使用<br>ClaMEISR</span>
  </div>
  <!-- 左側內容end -->
  <!-- 右側內容 -->
  <div class="right-framework frosted-glass"><!-- 毛玻璃特效 -->
    <div class="login-framework">
      <form method="post" action="{{ route('login.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
          <label for="floatingName" class="form-title">帳號</label>
          <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="請輸入帳號" required="required">

          @if ($errors->has('username'))
          <span class="text-danger text-left">{{ $errors->first('username') }}</span>
          @endif
        </div>

        <div class="form-group form-floating mb-3">
          <label for="floatingPassword" class="form-title">密碼</label>
          <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="請輸入密碼" required="required">

          @if ($errors->has('password'))
          <span class="text-danger text-left">{{ $errors->first('password') }}</span>
          @endif
        </div>

        <div class="form-group form-floating mb-3">
          <label for="schoolname" class="form-title"><b>學校</b></label>
          <div class="select-style">
            <select name="schoolnumber" class="form-option">
              @foreach ( $School as $school)
              <option class="form-control" value="{{ $school->SchoolCode}}">{{ $school->SchoolName }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

        @include('layouts.partials.copy')
      </form>
    </div>
  </div>
</div>
<!-- 右側內容end -->
@endsection