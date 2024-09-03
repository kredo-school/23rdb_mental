<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
{{-- @extends('layouts.app')
@section('title', 'users')
@section('content') --}}
<nav class="navbar navbar-dark navbar-expand-md fixed-top">
    <div class="container-fluid">
        <!-- Left Side Of Navbar -->
        <a class="navbar-brand ms-5 justify-content-center" href="{{ route('home') }}">
            <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo">
        </a>
        <!-- Toggler button for narrow view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Right Side Of Navbar -->
        <div class="ms-auto">
            <div class="collapse navbar-collapse">
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
                @if (Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-md">
                 @else
                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                @endif
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <button class="btn-logout">Logout</button>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>