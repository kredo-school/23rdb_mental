<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
{{-- @extends('layouts.app')

@section('title', 'home')

@section('content') --}}

<nav class="navbar navbar-dark navbar-expand-md">
    <div class="container-fluid">
        <!-- Left Side Of Navbar -->
        <a class="navbar-brand ms-5" href="{{ route('home') }}">
            <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo">
        </a>

        <!-- Toggler button for narrow view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Icons -->
        <div class="d-flex justify-content-center flex-grow-1">
            <div class="nav_inner d-flex justify-content-center">
                <a href="{{ route('home') }}" class="text-decoration-none"><p class="nav_icon"><img src="{{ asset('images/navigation/home_icon.png') }}" alt="home"><br>Home</p></a>
                <a href="{{ route('mood.index') }}" class="text-decoration-none"><p class="nav_icon"><img src="{{ asset('images/navigation/mood_icon.png') }}" alt="MoodTracking"><br>Mood_Tracking</p></a>
                <a href="{{ route('journal.journals') }}" class="text-decoration-none"><p class="nav_icon"><img src="{{ asset('images/navigation/journaling_icon.png') }}" alt="Journaling"><br>Journal</p></a>
                <a href="{{ route('quote.index') }}" class="text-decoration-none"><p class="nav_icon"><img src="{{ asset('images/navigation/quote_icon.png') }}" alt="Quote"><br>Quote</p></a>
                <a href="{{ route('chatroom.index') }}" class="text-decoration-none"><p class="nav_icon"><img src="{{ asset('images/navigation/chat_icon.png') }}" alt="Chat"><br>Chat</p></a>
            </div>
        </div>

        <!-- Right Side Of Navbar -->
        <div class="ms-auto">
            <div class="collapse navbar-collapse">
                <a href="route('profile.show', Auth::user()->id)" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
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
