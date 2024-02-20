@extends('layouts.auth-master')
@include('layouts.header')
@section('content')
<div class="content-framework">
  <div class="left-framework">
    <span class="font-style">歡迎使用<br>ClaMEISR</span>
  </div>
  <!-- 左側內容end -->
  <!-- 右側內容 -->
  <div class="right-framework frosted-glass"><!-- 毛玻璃特效 -->
    <div class="login-framework">
      <form method="post" action="{{ route('register.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <h1 class="h3 mb-3 fw-normal">註冊</h1>

        <div class="form-group form-floating mb-3">
        <label for="floatingName" class="form-title">帳號</label>
          <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
          @if ($errors->has('username'))
          <span class="text-danger text-left">{{ $errors->first('username') }}</span>
          @endif
        </div>

        <div class="form-group form-floating mb-3">
        <label for="floatingPassword" class="form-title">密碼</label>
          <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required" autocomplete="off">
          @if ($errors->has('password'))
          <span class="text-danger text-left">{{ $errors->first('password') }}</span>
          @endif
        </div>

        <div class="form-group form-floating mb-3">
        <label for="password_confirmation" class="form-title">密碼確認</label>
          <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required" autocomplete="off">
          @if ($errors->has('password_confirmation'))
          <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
          @endif
        </div>

        <div class="form-group form-floating mb-3">
          <label for="schoolname"><b>學校</b></label>
          <div class="select-style">
          <select name="schoolnumber" class="form-option">
            @foreach ( $School as $school)
            <option value="{{ $school->SchoolCode}}">{{ $school->SchoolName }}</option>
            @endforeach
          </select>
          </div>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>

        @include('layouts.partials.copy')
      </form>
    </div>
  </div>
</div>
@endsection