<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<nav class="navbar navbar-dark navbar-expand-md shadow sticky-top">

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
        <div class="ms-auto d-flex justify-content-center align-items-center">
            <a href="{{ route('profile.show', Auth::user()->id) }}">
                @if (Auth::check() && Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="nav_avatar fa-solid fa-circle-user">
            </a>
            @else
                <i class="nav_avatar fa-solid fa-circle-user"></i>
            @endif                
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <button class="btn-logout">Logout</button>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </span>

    </div>
</nav>