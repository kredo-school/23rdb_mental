<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <div class="body_sidebar">
        <!-- Main Menu -->
        <nav class="sidebar_inner">

            <p class=" sidebar_title">ENCOURAGE YOURSELF, <br>HEAL YOURSELF</p>
            
            <div class="sidebar">
                <a href="{{ route('home') }}" class="sidebar_icon">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/home_side_icon.png') }}" alt="home">Home</p>
                </a>
                <a href="{{ route('mood.index') }}" class="sidebar_icon">
                    <p class="sidebar_icon @yield('title')_mood"><img src="{{ asset('images/navigation/mood_side_icon.png') }}" alt="MoodTracking">Mood Tracking                    
                    </p>
                </a>
                <a href="{{ route('journal.journals') }}" class="sidebar_icon">
                    <p class="sidebar_icon @yield('title')_journal"><img src="{{ asset('images/navigation/journaling_side_icon.png') }}" alt="Journal">Journal</p>
                </a>
                {{-- <a href="{{ route('quote.index') }}" class="sidebar_icon">
                    <p class="sidebar_icon @yield('title')_quote"><img src="{{ asset('images/navigation/quote_side_icon.png') }}" alt="Quote">Quote</p>
                </a> --}}
                <a href="{{ route('chat.chats', '1') }}" class="sidebar_icon">
                    <p class="sidebar_icon @yield('title')chat"><img src="{{ asset('images/navigation/chat_side_icon.png') }}" alt="Chat">Chat</p>
                </a>
            </div>
        </nav>
        
        <!-- Admin Menu -->
        <nav class="sidebar_inner">
            <div class="ls_sidebar_admin">
                <img src="{{ asset('images/navigation/admin_side_icon.png') }}" alt="home">Admin Menu
                <ul>
                    <li class="ls_sidebar_admin"><a href="{{ route('users.index') }}">All Users</a></li>
                    <li class="ls_sidebar_admin"><a href="{{ route('quote.index') }}">All Quotes</a></li>
                    <li class="ls_sidebar_admin"><a href="{{ route('admin.chats.index') }}">All Chat</a></li>
                    <li class="ls_sidebar_admin"><a href="{{ route('admin.inquiries') }}">All Inquiry</a></li>
                </ui>
            </div>
        </nav>

        <!-- Footer Menu -->
        <nav class="sidebar_inner_footer">
            <div>
                <a href="{{ url('/') }}" class="sidebar_faq"> F A Q </a>
            </div>

            <div class="modal-body">
                <button class="sidebar_contact mt-3" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</button>
            </div>
        </nav>
    </div>

    @include('contactus.modals.inquiry')
    @include('contactus.modals.submitcomplete')







