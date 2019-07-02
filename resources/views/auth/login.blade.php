@extends('layouts.auth')

@section('content')
    <div class="login-box">
        <form class="login-form" method="post" action="{{ route('login') }}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            <div class="form-group">
                <label class="control-label">{{ __('E-Mail Address') }}</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email"
                       placeholder="Email" name="email" autofocus="" value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control @error('password') is-invalid @enderror"
                       type="password" name="password" placeholder="Password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="label-text">Stay Signed in</span>
                        </label>
                    </div>
                    <p class="semibold-text mb-2">
                        <a href="{{ route('password.request') }}" data-toggle="flip">Forgot Password ?</a>
                    </p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
        </form>
    </div>
@endsection
