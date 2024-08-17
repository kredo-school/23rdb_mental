@section('title', 'footer')

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Scripts -->
{{-- @vite(['asset/css/style.css', 'resources/js/app.js']) --}}

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

@section('content')
<body>
    <div class="body_sidebar">
        <nav class="sidebar_inner">
            <p class="fs-5 text-black-50">ENCOURAGE YOURSELF, <br>HEAL YOURSELF</p>
            <br>      
            <div class="sidebar a">
                <a href="#">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/home_side_icon.png') }}" alt="home">Home</p>
                </a>
                <a href="#">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/mood_side_icon.png') }}" alt="MoodTracking">Mood_Tracking</p>
                </a>
                <a href="#">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/journaling_side_icon.png') }}" alt="Journaling">Journaling</p>
                </a>
                <a href="#">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/quote_side_icon.png') }}" alt="Quote">Quote</p>
                </a>
                <a href="#">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/chat_side_icon.png') }}" alt="Chat">Chat</p>
                </a>       
            </div>
        </nav>    
 
        <nav class="sidebar_inner_bottom">
            <div class="sidebar a">
                <a href="#">
                    <p class="sidebar_icon"><i class="sidebar_avatar fa-solid fa-circle-user"></i>Profile</p>
                </a>
                <a href="#">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/logout_side_icon.png') }}" alt="Logout">Logout</p>
                </a>
            </div>

            <hr class="sidebar_hr">

            <div class="sidebar a">
                <a href="#"><span class="border-top text-black-50">Contact Us</span></a>
                <!-- Please insert a modal function--> 
            </div>
        </nav>
    </div>
    
</body>
</html>