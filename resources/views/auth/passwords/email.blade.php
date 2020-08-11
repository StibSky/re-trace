@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>{{ __('Reset Password') }}</h3>
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h5>Trouble logging in?</h5>
                <br>
                <p>Enter your email and we’ll send you a link to get back
                    into your account.</p>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>

                        <input id="forgotemail" type="email"
                               class="form-control text-center @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required
                               autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="main-button-wide">
                            {{ __('Send Reset Link') }}
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
