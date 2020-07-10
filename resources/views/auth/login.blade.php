@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    {{--    <div class="container text-center">
            <form class="form-signin" method="POST" action="{{ route('login') }}">
                <div class="mb-4">
                    <img src="{{ asset('/images/retracelogo.png') }}" class="px-5">
                    <h2 class="h3 mb-3 font-weight-normal">Re-Trace.io</h2>
                </div>
                @csrf

                <div class="form-group row">
                    <div class="col-md-">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>--}}


    <div class="container text-center">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <img class="mb-4" src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
            <h1 class="h3 mb-3 font-weight-normal">Re-trace.io</h1>
            <div class="form-group row d-flex justify-content-center">
                <div class="w-25">
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required
                           autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row d-flex justify-content-center">
                <div class="w-25">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row d-flex justify-content-center">
                <div class="w-25 text-right">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" id="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="form-group row d-flex justify-content-center">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Keep me logged in
                    </label>
                </div>
            </div>
            <div class="form-group row d-flex justify-content-center">
                <div>
                    <button type="submit" class="btn btn-primary" id="login-button">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
            <p class="mt-5 mb-3">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </form>
    </div>
@endsection
