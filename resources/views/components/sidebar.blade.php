<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

<div class="container">
    <nav class="sidebar">
        
        <!-- Head -->
        <div class="title">
            ENCOURAGE YOURSELF, <br>HEAL YOURSELF
        </div>

        <!-- Main Menu -->
        <div class="menu">
            <ul>
                <li class="active">
                    <a href="{{ route('home') }}">
                    <img src="{{ asset('images/navigation/home_side_icon.png') }}" alt="home"><span class="menu">Home</span>
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('mood.index') }}">
                    <img src="{{ asset('images/navigation/mood_side_icon.png') }}" alt="MoodTracking"><span class="menu">Mood Tracking</span>
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('journal.journals') }}">
                    <img src="{{ asset('images/navigation/journaling_side_icon.png') }}" alt="Journaling"><span class="menu">Journal</span>
                </a>
                </li>
                <li class="active">
                    <a href="{{ route('quote.index') }}">
                    <img src="{{ asset('images/navigation/quote_side_icon.png') }}" alt="Quote"><span class="menu">Quote</span>
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('chatroom.index') }}">
                    <img src="{{ asset('images/navigation/chat_side_icon.png') }}" alt="Chat"><span class="menu">Chat</span>
                    </a>
                </li>
            </ul>
        </div>

        
        <div class="footer">
            <!-- Avatar -->
            <div class="avatar_container"> 
                <div class="avatar">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if (Auth::check() && Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"></a>
                        @else
                            <i class="fa-solid fa-circle-user"></i>
                        @endif
                </div>
                <div class="username">{{ Auth::user()->name }}</div>
            </div>
          

            <!-- Logout -->
            <div class="menu">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <p class="menu align-items-center"><img src="{{ asset('images/navigation/logout_side_icon.png') }}" alt="Logout">Logout</p></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

                <!-- Contact Us --> 
                <div class="modal-body">
                    <a class="text-decoration-none text-muted fs-6 fw-normal" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</a>
                </div>
        </div>
    </nav>
</div>
</div>

@include('contactus.modals.inquiry')
@include('contactus.modals.submitcomplete')
