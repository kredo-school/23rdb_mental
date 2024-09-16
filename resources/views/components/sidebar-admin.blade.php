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
                    <p class="sidebar_icon @yield('title')_mood"><img src="{{ asset('images/navigation/mood_side_icon.png') }}" alt="MoodTracking">Mood Tracking</p>
                </a>
                <a href="{{ route('journal.journals') }}" class="sidebar_icon">
                    <p class="sidebar_icon @yield('title')_journal"><img src="{{ asset('images/navigation/journaling_side_icon.png') }}" alt="Journal">Journal</p>
                </a>
                {{-- <a href="{{ route('quote.index') }}" class="sidebar_icon">
                    <p class="sidebar_icon @yield('title')_quote"><img src="{{ asset('images/navigation/quote_side_icon.png') }}" alt="Quote">Quote</p>
                </a> --}}
                <a href="{{ route('chat.chats', '1') }}" class="sidebar_icon">
                    <p class="sidebar_icon @yield('title')_chat"><img src="{{ asset('images/navigation/chat_side_icon.png') }}" alt="Chat">Chat</p>
                </a>
                <p class="fs-6 text-muted mb-1"><img src="{{ asset('images/navigation/admin_side_icon.png') }}" alt="home">Admin Menu</p>
            </div>

        
        <!-- Admin Menu -->
            <div class="ls_sidebar_admin">
                <ul class="ls_sidebar_item">
                    <li>
                        <a href="{{ route('users.index') }}" id="users_active" class="ls_sidebar_item">All Users</a>
                    </li>
                    <li>
                        <a href="{{ route('quote.index') }}" id="quote_active" class="ls_sidebar_item">All Quotes</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.chats.index') }}" id="chat_active" class="ls_sidebar_item">All Chat</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.inquiries') }}" id="inquiry_active" class="ls_sidebar_item">All Inquiry</a>
                    </li>
                    <li>
                        <a href="{{ route('deletion-reasons.index') }}" id="deletion_active" class="ls_sidebar_item">All Deletion reasons</a>
                    </li>
                </ui>
            </div>
        </nav>


        <!-- Footer Menu -->
        <nav class="sidebar_inner_footer">
            <div>
                <a href="{{ url('faq') }}" class="sidebar_faq"> FAQ </a>
            </div>

            <div class="modal-body">
                <a class="sidebar_contact mt-3" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</a>
            </div>
        </nav>
    </div>

    @include('contactus.modals.inquiry')
    @include('contactus.modals.submitcomplete')




    {{-- <li>
                        <a href="{{ route('users.index') }}" id="@yield('title')_users" class="ls_sidebar_item">All Users</a>
                    </li>
                    <li>
                        <a href="{{ route('quote.index') }}" class="ls_sidebar_item">
                            <p class="ls_sidebar_item" id="@yield('title')_users">All Quotes</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.chats.index') }}" class="ls_sidebar_item">
                            <p class="ls_sidebar_item" id="@yield('title')_users">All Chat</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.inquiries') }}" class="ls_sidebar_item">
                            <p class="ls_sidebar_item" id="@yield('title')_users">All Inquiry</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('deletion-reasons.index') }}" class="ls_sidebar_item">
                            <p class="ls_sidebar_item" id="@yield('title')_users">All Deletion Reasons</p>
                        </a>
                    </li> --}}







