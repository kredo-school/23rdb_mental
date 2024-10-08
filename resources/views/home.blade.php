<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('js/graph.js') }}"></script>
@extends('layouts.app')

@if (Auth::user()->role_id == 1)
    @include('components.navbar-home-admin')
@elseif (Auth::user()->role_id == 2)
    @include('components.navbar-home')
@endif

@section('title', 'home')

@section('content')


    {{-- Today's Quote Section --}}
    <div class="p-3 bg-white">
        <div class="container-quote mx-5">
            <div class="row justify-content-center ps-0">
                {{-- Remi-chan --}}
                <div class="col-1">
                    <p class="fs-6 today-quote-text mb-0">Today's Quote</p>
                    <span class="fuwafuwa pt-0">
                    <img src="{{ asset('images/main/remichan.png') }}" alt="Remichan" class="remichan-home">
                </span>
                </div>
                {{-- 吹き出し --}}
                {{-- <div class="col-auto fukidashi-01-13"> --}}
                    {{-- 吹き出し線 --}}

                    {{-- <span class="ornament"></span>   --}}


                    {{-- <img src="{{ asset('images/main/bubblespeech.png') }}" alt="bubblespeech" class="bubblespeech"> --}}
                {{-- </div> --}}


            {{-- Quote --}}
            @if ($quote && $quote->exists())
                <div class="col-8 d-flex align-items-center fade-in-text mx-0 quote-copy-parent">
                {{-- quote itself --}}



                        <p name="order-quote-copy" id="order-quote-copy" class="quote-copy form-control-plaintext text-center ps-3 mx-0 py-auto copyTarget">

                                 {{ $quote->quote }}
                        </p>
                </div>

                <div class="col-2 align-self-end">
                {{-- Author --}}


                    <p class="text-start mb-0 home-author">By  {{ $quote->author }}</p>


                </div>

                {{-- Action Buttons --}}
                <div class="col-1">
                    <div class="row">
                        {{-- <div class="col-auto px-0 text-end tooltip-002"> --}}
                            {{-- Refresh --}}
                            {{-- <form action="{{ route('home.quote.change') }}" method="post">
                                @csrf
                                <button type="submit" name="change" id ="change" class="btn btn-lg p-1"><i
                                        class="fa-solid fa-arrows-rotate"></i></button>
                            </form>
                            <span>change today's quote</span>

                        </div> --}}

                       {{-- Bookmark --}}
                        <div class="col-auto px-0 text-center quote-switch tooltip-002">

                            {{-- <div class="quote-switch tooltip-002"> --}}
                                @if ($quote->isBookmarked())
                                    <form action="{{ route('bookmark.destroy', $quote->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-lg p-1">
                                            <i class="fa-solid fa-bookmark text-warning quote-bookmark-store"></i></button>
                                    </form>
                                    <span>delete from bookmark list</span>

                                @else
                                    <form action="{{ route('bookmark.store', $quote->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-lg p-1"><i
                                                    class="fa-regular fa-bookmark quote-bookmark-cancel"></i></button>
                                    </form>
                                    <span>see all bookmarked quotes on your profile</span>
                                @endif
                            {{-- </div> --}}
                        </div>

                        {{-- Refresh --}}
                        <div class="col-auto px-0 text-end tooltip-002">

                            <form action="{{ route('home.quote.change', $quote->id) }}" method="post">
                                @csrf
                                <button type="submit" name="change" id ="change" class="btn btn-lg p-1"><i
                                        class="fa-solid fa-arrows-rotate"></i></button>
                            </form>
                            <span>change today's quote</span>

                        </div>

                         {{-- Copy --}}
                        <div class="col-auto px-0 text-start tooltip-002">

                            <button type="submit" class="btn btn-lg p-1 js-copy-btn copyBtn" id="btn-copy-quote" data-copy onclick="copyButton('order-quote-copy')"><i class="fa-regular fa-clone"></i></button>
                            <span>copy today's quote</span>
                        </div>
                    </div>

                </div>


                @else
                <div class="col-8 d-flex justify-content-center align-items-center fade-in-text mx-0 quote-copy-parent">
                   <p class="text-center">Coming soon....</p>
                </div>
                @endif

            {{-- <div class="col-1"></div> --}}


            </div>
        </div>
        <script src="{{ asset('js/quote-copy.js') }}"></script>
    </div>

    {{-- Journaling section --}}
    <div class="container-home mt-5 mb-2">
        <div class="card-home bg-white py-2 px-3 border-0">

            <div class="card-header-home bg-white">
                {{-- Title --}}
                <div class="d-flex align-items-center">
                    <h2>Journaling</h2>
                    <span class="fs-5 ms-4 align-self-center float-startr">Let’s use journaling to balance your mind</span>
                    {{-- Link to Journaling page --}}
                    <span class="fs-5 ms-4 align-self-center float-startr"><a href="{{ route('journal.journals') }}" class="small fw-medium">See All</a></span>
                </div>
            </div>

            <div class="card-body">
                <div class="row ps-3">
                    <div class="col-9 align-self-center p-0">
                        {{-- Journaling create --}}
                        <input type="text" name="journaling" id="journaling"
                            class="form-control-home custom-placeholder shadow" placeholder="What's on your mind?    ... Click here to add journaling"
                            data-bs-toggle="modal" data-bs-target="#add-post">
                    </div>
                    @include('journals.contents.modals.add')

                    <div class="col p-0">
                        {{-- Remi-chan speaking --}}
                        <p class="fs-5 text-start fw-medium remichan-speaking">
                            Write down anything <br>
                            that is on your mind!<br>
                            Journaling helps reduce stress <br>
                            and organize your thoughts.
                        </p>
                    </div>
                    <div class="col-auto me-6">
                        <div class="remichan_circle">
                            {{-- Remi-chan --}}
                            <span class="fuwafuwa2 pt-0">
                                <img src="{{ asset('images/main/circle_remichan.png') }}" alt="Remichan">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Mood Tracker Section --}}
    <div class="container-home mt-4 mb-2">
        <div class="card-home bg-white border-0 py-3 px-3">
            <div class="card-header bg-white">
                {{-- Title --}}
                <div class="d-flex align-items-end ms-3 mt-2 mb-3">
                    <h2>Mood Tracking</h2>
                    <span class="fs-5  ms-4 align-self-center float-startr">Your average mood of the day on the calendar <br>and see your mood swing of the day on the right side.</span>
                </div>
                <hr class="ms-3 me-3">
            </div>

            <div class="card-body mb-3">

                <div class="row">
                    {{-- Left: Calendar --}}
                    <div class="col box-mood">
                        <div class="card border-0">
                            <div class="card-header-home border-0">
                                <h3 class="calender w-100 fs-4">Mood Calender</h3>
                            </div>
                        </div>
                        <div class="px-5">
                            <div class="w-100 text-center">
                                <a href="{{ route('mood.index') }}" id="calendar-container">
                                    <div id="calendar" width="90%"></div>
                                </a>
                            </div>
                        </div>
                        <div class="footer border-0 mt-3">
                            <p class="small bg-light px-5 text-center">
                                It shows the average score of your mood of the day.
                            </p>
                        </div>
                    </div>
                    {{-- Right: Graph --}}
                    <div class="col box-mood">
                        <div class="card border-0">
                            <div class="card-header border-0">
                                <h3 class="graph w-100 fs-4">Mood Graph</h3>
                            </div>
                            <div class="body border-0 bg-white d-flex align-items-center">
                                {{-- <div class="row"> --}}
                                {{-- <div class="col p-0"> --}}
                                <div id="graph_div" style="width: 100%; height: 500px;"></div>

                                {{-- </div> --}}
                                {{-- <div class="col-auto ps-0 pe-4"> --}}
                                <div class="float-end">
                                    <div>
                                        <p class="mb-0">&nbsp;</p>
                                    </div>
                                    <div>
                                        <img class="mood-graph-icon" src="{{ asset('images/moods/great.png') }}" alt="great">
                                    </div>
                                    <div>
                                        <img class="mood-graph-icon" src="{{ asset('images/moods/good.png') }}" alt="great">
                                    </div>
                                    <div>
                                        <img class="mood-graph-icon" src="{{ asset('images/moods/ok.png') }}" alt="great">
                                    </div>
                                    <div>
                                        <img class="mood-graph-icon" src="{{ asset('images/moods/notgood.png') }}"
                                            alt="great">
                                    </div>
                                    <div>
                                        <img class="mood-graph-icon" src="{{ asset('images/moods/bad.png') }}" alt="great">
                                    </div>
                                </div>
                            </div>
                            <div class="footer bg-light border-0 mt-3">
                                <p class="small px-5 text-center">
                                    It records your mood that you input when you login.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="ms-3 me-3">
            <div class="card-footer bg-white text-end me-4">
                <p class="fs-5">
                    <a href="{{ route('mood.index') }}" class="mood ms-2 fw-medium fs-5"><i class="fa-solid fa-link me-1"></i>Go Mood Tracking Page</a>
                </p>
            </div>
        </div>
    </div>

    {{-- Chat Room Section --}}
    <div class="container-home mt-4 mb-5">
        <div class="card-home bg-white pt-2 pb-4 py-2 px-3 border-0">

                {{-- Title --}}
                <div class="d-flex ms-3 mt-2 mb-3">
                    <h2>Chat Room<i class="fa-regular ms-2 fa-comments"></i></h2>
                    <span class="fs-5 ms-4 align-self-center float-startr">You can chat anonymously in 6 different categories. Feel free to chat casually!</span>
                </div>


                <div class="mx-3">
                    <div class="row">
                        {{-- Chat Rooms --}}
                        <div class="col-4 col-md-2 p-1">
                            <a href="{{ url('/chat/1') }}" class="btn btn-relationship w-100">Relationship</a>
                        </div>
                        <div class="col-4 col-md-2 p-1">
                            <a href="{{ url('/chat/2') }}" class="btn btn-career w-100">Career</a>
                        </div>
                        <div class="col-4 col-md-2 p-1">
                            <a href="{{ url('/chat/3') }}" class="btn btn-family w-100">Family</a>
                        </div>
                        <div class="col-4 col-md-2 p-1">
                            <a href="{{ url('/chat/4') }}" class="btn btn-health w-100">Health</a>
                        </div>
                        <div class="col-4 col-md-2 p-1">
                            <a href="{{ url('/chat/5') }}" class="btn btn-finance w-100">Finance</a>
                        </div>
                        <div class="col-4 col-md-2 p-1">
                            <a href="{{ url('/chat/6') }}" class="btn btn-others w-100">Others</a>
                        </div>
                    </div>
                </div>
        </div>
        {{-- Chat Rooms footer --}}
        <div class="card-footer text-end me-4 pb-3">
            <a href="{{ route('chat.chats', '1') }}" class="fs-5 fw-medium text-decoration-none"><i class="fa-solid fa-link me-1"></i>Go Chat Room page</a>
        </div>
    </div>


    {{-- Option --}}
    {{-- <div class="container-option m-5">
    {{-- <div class="container-option m-5">
        <div class="card bg-white py-3 px-5 border-0">
            <p class="text-center">Option</p>
        </div>
    </div> --}}

    <div>
        @include('components.footer')
    </div>

    <script>
        $(document).ready(function() {
            console.log("test");
        })
    </script>

@endsection
