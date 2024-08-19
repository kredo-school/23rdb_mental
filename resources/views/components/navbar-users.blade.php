<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
@extends('layouts.app')

@section('title', 'Users Navbar')

@section('content')

<nav class="navbar navbar-dark navbar-expand-md">
    <div class="container-fluid">
        <!-- Left Side Of Navbar -->
        <a class="navbar-brand ms-5 justify-content-center" href="#">
            <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo">
        </a>

        <!-- Toggler button for narrow view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right Side Of Navbar -->
        <div class="ml-auto">
            <div class="collapse navbar-collapse">
                <a href="/" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
                <a href="/"><button class="btn-logout">Logout</button></a>
            </div>
        </div>
    </div>
</nav>