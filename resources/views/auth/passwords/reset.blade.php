@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>{{ __('Reset Password') }}</h3>
        <div class="card">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h5>Please enter your new password</h5>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="hidden"
                                   class="form-control text-center @error('email') is-invalid @enderror" name="email"
                                   value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="sr-only">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="form-control text-center @error('password') is-invalid @enderror"
                                   name="password" required
                                   autocomplete="new-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm"
                               class="sr-only">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control text-center"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirm password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="main-button-wide">
                            {{ __('Go to Account') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center" id="register-footer">
                <a href="{{route('login')}}"><span><strong>Back to Login</strong></span></a>
            </div>
        </div>
    </div>
@endsection
