@extends('Admin.Pages.Auth.layout')

@section('content')

<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                {{-- <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a> --}}
                <h2 class="m-0" style="color: #06BBCC;"><i class="fa fa-book me-3"></i>eLEARNING</h2>
            </div>
            <h1 class="auth-title">Sign Up</h1>
            <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

            <form action="{{ route('signup.store') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="email" class="form-control form-control-xl" placeholder="Email" value="{{ old('email') }}">
                    <small class="text-danger">@error('email'){{ $message }}@enderror</small>
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="username" class="form-control form-control-xl" placeholder="Username" value="{{ old('username') }}">
                    @if (!$errors->has('email'))
                        <small class="text-danger">@error('username'){{ $message }}@enderror</small>
                    @endif
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="password" class="form-control form-control-xl" placeholder="Password" value="{{ old('password') }}">
                    @if (!$errors->has(['email', 'username']))
                        <small class="text-danger">@error('password'){{ $message }}@enderror</small>
                    @endif
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="password_confirmation" class="form-control form-control-xl" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                    @if (!$errors->has(['email', 'username']))
                        <small class="text-danger">@error('password_confirmation'){{ $message }}@enderror</small>
                    @endif
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}"
                        class="font-bold">Log
                        in</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>
    
@endsection