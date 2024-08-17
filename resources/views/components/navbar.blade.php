@section('title', 'navbar')

{{-- Our Base Font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Oswald:wght@200..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

{{-- fontawesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

{{-- Bootstrap CSS --}}
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

{{-- jQuery (required for Bootstrap 4) --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
{{-- Popper.js (required for Bootstrap 4) --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
{{-- Bootstrap's JavaScript --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<body>
    <h1>MEntal Navbar</h1>
    <p>There are navbar variations.</p>
    <hr>

    <h2>before Login</h2>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <!-- Left Side Of Navbar -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo" class="nav_logo">
            </a>

            <!-- Toggler button for narrow view -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Dropdown button for narrow view -->
                    <div class="dropdown">
                        <button class="navbar-toggler dropdown-toggle" type="button" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/">Logout</a></li>
                        </ul>
                    </div>

                        
                    <!-- Right Side Of Navbar -->
                    <div class="ml-auto align-items-center">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <button class="btn-logout ml-md-4">Logout</button>
                        </div>
                    </div>
                </div>
        </div>
    </nav>

    <br>

    <h2>User's</h2>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <!-- Left Side Of Navbar -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo" class="nav_logo">
            </a>

            <!-- Toggler button for narrow view -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <div class="ml-auto align-items-center">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <button class="btn-logout ml-md-4">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <br>

    <h2>Home</h2>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <!-- Left Side Of Navbar -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo" class="nav_logo">
            </a>

            <!-- Toggler button for narrow view -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Dropdown button for narrow view -->
                    <div class="dropdown">
                        <button class="navbar-toggler dropdown-toggle" type="button" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/">Home</a></li>
                            <li><a class="dropdown-item" href="/mood_tracking">Mood Tracking</a></li>
                            <li><a class="dropdown-item" href="/journaling">Journaling</a></li>
                            <li><a class="dropdown-item" href="/quote">Quote</a></li>
                            <li><a class="dropdown-item" href="/chat">Chat</a></li>
                            <li><a class="dropdown-item" href="/admin">Admin</a></li>
                        </ul>
                    </div>
                <!-- Menu Icons -->
                <div class="nav_inner div#navbarNav d-flex justify-content-center mx-auto w-50">
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/home_icon.png') }}" alt="home"><br>Home</p>
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/mood_icon.png') }}" alt="MoodTracking text-center"><br>Mood_Tracking</p>
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/journaling_icon.png') }}" alt="Journaling"><br>Journaling</p>
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/quote_icon.png') }}" alt="Quote"><br>Quote</p>
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/chat_icon.png') }}" alt="Chat"><br>Chat</p>
                </div>
            
                <!-- Right Side Of Navbar -->
                <div class="ms-auto d-flex align-items-center">
                    <div class="collapse navbar-collapse">
                        <a href="/" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
                        <a href="{{ url('/resources/views/auth/login') }}"><button class="btn-logout">Logout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <br>

    <h2>Home Admin</h2>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <!-- Left Side Of Navbar -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/main/logo_sm.png') }}" alt="logo" class="nav_logo">
            </a>

            <!-- Toggler button for narrow view -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Menu Icons -->
                <div class="nav_inner div#navbarNav d-flex justify-content-center mx-auto w-50">
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/home_icon.png') }}" alt="home"><br>Home</p>
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/mood_icon.png') }}" alt="MoodTracking text-center"><br>Mood_Tracking</p>
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/journaling_icon.png') }}" alt="Journaling"><br>Journaling</p>
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/quote_icon.png') }}" alt="Quote"><br>Quote</p>
                    <p class="nav_icon text-center"><img src="{{ asset('images/navigation/chat_icon.png') }}" alt="Chat"><br>Chat</p>
                    <a href="/index.php"><p class="nav_icon text-center"><img src="{{ asset('images/navigation/admin_icon.png') }}" alt="Admin"><br>Admin</p></a>
                </div>
            
            <!-- Right Side Of Navbar -->
                <div class="ms-auto d-flex align-items-center">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <a href="/" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
                        <button class="btn-logout ml-md-4">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <br>

    <h2>Each page</h2>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">

            <!-- Left Side Of Navbar -->
            <div class="nav_inner">
                <a class="navbar-brand" href="/"><img src="{{ asset('images/main/logo_sm.png') }}" alt="logo" class="nav_logo"></a>
                <p class="nav_pageTitle">@yield('title')</p>
            </div>

            <!-- Toggler button for narrow view -->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-bs-target="#navbarForm" aria-controls="navbarForm" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
                <div class="ml-auto align-items-center">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <button class="btn-logout ml-md-4">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</body>
</html>