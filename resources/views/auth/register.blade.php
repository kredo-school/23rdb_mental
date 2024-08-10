{{-- Style CSS --}}
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container-login">
    <div class="row justify-content-center m-5">
        <div class="col">
            <div class="card p-5 shadow-lg">
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                {{-- logo --}}
                <div class="text-center">
                    <img src="{{ asset('images/main/default_logo.png') }}" alt="logo" class="image-logo mb-3">
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-0 justify-content-center">
                            <p class="text-sm text-center mb-0">Have an account already? &nbsp; &nbsp;<a href="#" class="link text-decoration-none">Log in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
