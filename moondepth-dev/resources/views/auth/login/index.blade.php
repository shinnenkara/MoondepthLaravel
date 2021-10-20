@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                <h3 class="section"></h3>

                <form method="POST" action="">
                    @csrf

                    <div class="form-group row">
                        <div class="input-field">
                            <input id="email_input"
                                   class="white-text form-control @error('email') is-invalid @enderror"
                                   type="text"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   autofocus>
                            <label for="email_input">Email</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input id="password_input"
                                   class="white-text form-control @error('password') is-invalid @enderror"
                                   type="password"
                                   name="password"
                                   value="{{ old('password') }}"
                                   required
                                   autocomplete="password">
                            <label for="password_input">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if (Route::has('password.request'))
                            <div class="inline">
                                <a class="white-text" href="{{ route('password.request') }}">
                                    <span>{{ __('Forgot Your Password?') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button id="message-creation-button" class="waves-effect waves-light grey darken-3 btn-large mb-2">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <div class="inline">
                            <a class="white-text" href="{{ route('password.request') }}">
                                <span>{{ __("Don't have an account? Register now!") }}</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
