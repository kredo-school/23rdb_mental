<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Navbar</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

{{-- Our Base Font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Oswald:wght@200..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- fontawesome -->
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<style>
    body {
        margin: 40px;
    }
</style>
</head>


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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Right Side Of Navbar -->
            <div class="align-items-center">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <button class="btn-logout ml-md-4">Logout</button>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Right Side Of Navbar -->
            <div class="ms-auto d-flex align-items-center">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <a href="/" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
                    <button class="btn-logout ml-md-4">Logout</button>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu icons -->
            <div class="nav_inner">
                <p class="nav_icon"><img src="{{ asset('images/navigation/home_icon.png') }}" alt="home"><br>Home</p>
                <p class="nav_icon"><img src="{{ asset('images/navigation/mood_icon.png') }}" alt="MoodTracking"><br>Mood_Tracking</p>
                <p class="nav_icon"><img src="{{ asset('images/navigation/journaling_icon.png') }}" alt="Journaling"><br>Journaling</p>
                <p class="nav_icon"><img src="{{ asset('images/navigation/quote_icon.png') }}" alt="Quote"><br>Quote</p>
                <p class="nav_icon"><img src="{{ asset('images/navigation/chat_icon.png') }}" alt="Chat"><br>Chat</p>
            </div>
            
            <!-- Right Side Of Navbar -->
            <div class="ms-auto d-flex align-items-center">
                <div class="collapse navbar-collapse">
                    <a href="/" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
                    <a href="{{ url('/resources/views/auth/login') }}"><button class="btn-logout">Logout</button></a>
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

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu icons -->
            <div class="nav_inner">
                <a href="/index.php"><p class="nav_icon"><img src="{{ asset('images/navigation/home_icon.png') }}" alt="home"><br>Home</p></a>
                <a href="/index.php"><p class="nav_icon"><img src="{{ asset('images/navigation/mood_icon.png') }}" alt="MoodTracking"><br>Mood_Tracking</p></a>
                <a href="/index.php"><p class="nav_icon"><img src="{{ asset('images/navigation/journaling_icon.png') }}" alt="Journaling"><br>Journaling</p></a>
                <a href="/index.php"><p class="nav_icon"><img src="{{ asset('images/navigation/quote_icon.png') }}" alt="Quote"><br>Quote</p></a>
                <a href="/index.php"><p class="nav_icon"><img src="{{ asset('images/navigation/chat_icon.png') }}" alt="Chat"><br>Chat</p></a>
                <a href="/index.php"><p class="nav_icon"><img src="{{ asset('images/navigation/admin_icon.png') }}" alt="Admin"><br>Admin</p></a>
            </div>
            
            <!-- Right Side Of Navbar -->
            <div class="ms-auto d-flex align-items-center">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <a href="/" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
                    <button class="btn-logout ml-md-4">Logout</button>
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
                <p class="nav_pageTitle">Page name ex.Journaling</p>
            </div>

            <!-- Toggler button for narrow view -->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-bs-target="#navbarForm" aria-controls="navbarForm" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Right Side Of Navbar -->
            <div class="ms-auto d-flex align-items-center a:hover">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <a href="/" class="nav_avatar_link"><i class="nav_avatar fa-solid fa-circle-user"></i></a>
                    <button class="btn-logout ml-md-4">Logout</button>
                </div>
            </div>


        </div>
    </nav>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>