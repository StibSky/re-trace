@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    <!--
   blade for registered page, allows new users to register
  mostly generated by laravel auth but has custom functionality
-->
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>{{ __("CREATE AN ACCOUNT")}}</h3>
        <div class="card d-flex justify-content-center">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4 text-center card-header">
                    <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                    <h3><strong>re-trace.io</strong></h3>
                </div>
                <div class="card-body text-center">
                    <div class="form-group">
                            <label for="first_name" class="sr-only">{{ __('First name') }}</label>
                            <input id="first_name" type="text"
                                   class="form-control text-center @error('first_name') is-invalid @enderror" name="first_name"
                                   value="{{ old('first_name') }}" placeholder="{{ __('First name') }}" required
                                   autocomplete="first_name" autofocus>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    <div class="form-group">
                            <label for="last_name" class="sr-only">{{ __('Last name') }}</label>
                            <input id="last_name" type="text"
                                   class="form-control text-center @error('last_name') is-invalid @enderror"
                                   name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('Last name') }}"
                                   required
                                   autocomplete="last_name" autofocus>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    <div class="form-group">
                            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control text-center @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required
                                   autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    <div class="form-group d-inline-flex">
                        <label for="type" class="sr-only">{{ __('type') }}</label>
                        <div class="col-12">
                            <input id="type" type="radio" name="type" value="Business">
                            <label for="type">Business</label>
                            <button disabled class="text-center" id="custom-tooltip" tabindex="-1" data-toggle="tooltip"
                                    data-placement="bottom" title="{{ __("When you're a developer or recycling plant")}}">
                                ?
                            </button>
                            <input id="type2" type="radio" name="type" value="Private" checked>
                            <label for="type2">Private</label>
                            <button disabled class="text-center" id="custom-tooltip" tabindex="-1" data-toggle="tooltip"
                                    data-placement="bottom" title="{{ __("When you're a single home owner")}}">
                                ?
                            </button>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="password" class="sr-only">{{ __("Password")}}</label>
                            <input id="password" type="password"
                                   class="form-control text-center @error('password') is-invalid @enderror"
                                   placeholder="{{ __("Password")}}" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    <div class="form-group">
                            <label for="password-confirm" class="sr-only">{{ __("Confirm Password")}}</label>
                            <input id="password-confirm" type="password" class="form-control text-center"
                                   name="password_confirmation"
                                   placeholder="{{ __("Confirm Password")}}" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" id="main-button-wide">
                                {{ __('Create an Account') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-footer text-center" id="register-footer">
                <a href="{{route('login')}}"><span><strong>{{ __("Back to Login")}}</strong></span></a>
            </div>
        </div>
    </div>
@endsection

