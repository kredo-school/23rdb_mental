<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


<nav class="navbar navbar-dark navbar-expand-md shadow sticky-top">

    <div class="container-fluid">
        <!-- Left Side Of Navbar -->
        <a class="navbar-brand ms-5 justify-content-center sticky-top" href="{{ route('home') }}">
            <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo">
        </a>

        <!-- Toggler button for narrow view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menu Icons -->
        <div class="d-flex justify-content-center align-items-center flex-grow-1">
            <div class="nav_inner d-flex justify-content-center">
                <a href="{{ route('home') }}" class="nav_icon text-decoration-none"><img src="{{ asset('images/navigation/home_icon.png') }}" alt="home"><br>Home</a>
                <a href="{{ route('mood.index') }}" class="nav_icon text-decoration-none"><img src="{{ asset('images/navigation/mood_icon.png') }}" alt="MoodTracking"><br>Mood_Tracking</a>
                <a href="{{ route('journal.journals') }}" class="nav_icon text-decoration-none"><img src="{{ asset('images/navigation/journaling_icon.png') }}" alt="Journal"><br>Journaling</a>
                {{-- <a href="{{ route('quote.index') }}" class="nav_icon"><img src="{{ asset('images/navigation/quote_icon.png') }}" alt="Quote"><br>Quote</a> --}}
                <a href="{{ route('chat.chats', '1') }}" class="nav_icon text-decoration-none"><img src="{{ asset('images/navigation/chat_icon.png') }}" alt="Chat"><br>Chat</a>

                    <div class="dropdown">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/navigation/admin_icon.png') }}" alt="Admin"><br>Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.index') }}" class="dropdown-item">All Users</a></li>
                            <li><a href="{{ route('quote.index') }}" class="dropdown-item">All Quotes</a></li>
                            <li><a href="{{ route('admin.chats.index') }}" class="dropdown-item">All Chat</a></li>
                            <li><a href="{{ route('admin.inquiries') }}" class="dropdown-item">All Inquiry</a></li>
                            <li><a href="{{ route('deletion-reasons.index') }}" class="dropdown-item">All Deletion reasons</a></li>
                        </ul>
                    </div>
            </div>
        </div>

        <!-- Right Side Of Navbar -->
        <div class="ms-auto d-flex align-items-center">
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
        </div>
    </div>
    
</nav>