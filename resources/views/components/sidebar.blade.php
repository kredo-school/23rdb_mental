<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
{{-- @extends('layouts.app') --}}

{{-- @section('title', 'sidebar') --}}

{{-- @section('content') --}}

<body>
    <div class="body_sidebar">
        <nav class="sidebar_inner">
            <p class=" sidebar_h1">ENCOURAGE YOURSELF, <br>HEAL YOURSELF</p>
            <br>
            <div class="sidebar a">
                <a href="{{ route('home') }}">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/home_side_icon.png') }}" alt="home">Home</p>
                </a>
                <a href="{{ route('mood.index') }}">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/mood_side_icon.png') }}" alt="MoodTracking">Mood_Tracking</p>
                </a>
                <a href="{{ route('journal.journals') }}">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/journaling_side_icon.png') }}" alt="Journaling">Journaling</p>
                </a>
                <a href="{{ route('quote.index') }}">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/quote_side_icon.png') }}" alt="Quote">Quote</p>
                </a>
            </div>

        </nav>

        <nav class="sidebar_inner_bottom">
            <div class="sidebar a">
                <a href="{{ route('profile.show', Auth::user()->id) }}">
                    <p class="sidebar_icon"><i class="sidebar_avatar fa-solid fa-circle-user"></i>Profile</p>
                </a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <p class="sidebar_icon"><img src="{{ asset('images/navigation/logout_side_icon.png') }}" alt="Logout">Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <p></p>
            <div class="modal-body">
                <button class="btn-contact" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</button>
            </div>
        </nav>
    </div>

    @include('contactus.modals.inquiry')
    @include('contactus.modals.submitcomplete')

{{-- @endsection --}}

@section('scripts')
    <script src="{{ asset('js/inquiry.js') }}"></script>
@endsection
