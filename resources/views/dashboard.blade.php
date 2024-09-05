{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                <h1>mental</h1>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@extends('components.navbar-each')

{{-- <div class="container-login">
    <div class="row justify-content-center m-5">
        <div class="col">
            <div class="card p-5 shadow-lg"> --}}
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                {{-- logo --}}
                {{-- <div class="text-center">
                    <img src="{{ asset('images/main/default_logo.png') }}" alt="logo" class="image-logo mb-3">
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">

                            {{-- email --}}
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3"> --}} 

                            {{-- password --}}
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}


                        {{-- Action Button --}}
                        {{-- <div class="row mb-4">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn-submit">
                                    {{ __('Login') }}
                                </button> --}}

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            {{-- </div>
                        </div> --}}


                        {{-- <div class="row mb-0 justify-content-center">
                            <p class="text-sm text-center mb-0">Don't you have an account? &nbsp; &nbsp;<a href="{{ route('register') }}" class="link text-decoration-none">Sign up now</a></p>
                        </div>
                    </form> --}}
                {{-- </div>
            </div>
        </div>
    </div>
</div> --}}




@endsection
