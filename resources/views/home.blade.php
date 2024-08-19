<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@extends('layouts.app')

@section('title', 'home')

@section('content')

{{-- Today's Quote Section--}}
<div class="p-5 bg-white">
    <div class="container-quote">
        <div class="row d-flex justify-content-center">
            {{-- Remi-chan --}}
            <div class="col-auto">
                <img src="{{ asset('images/main/remichan.png') }}" alt="Remichan">
            </div>
            {{-- 吹き出し --}}
            <div class="col-auto">
                <img src="{{ asset('images/main/bubblespeech.png') }}" alt="bubblespeech" class="bubblespeech">
            </div>

            {{-- Quote --}}
            <div class="col align-self-center">
                <p class="text-center">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odit pariatur veritatis ipsam corporis nihil praesentium dolorem repudiandae cupiditate blanditiis error voluptate delectus odio possimus autem a eos inventore totam beatae nam minus, officiis accusantium hic! Sequi, distinctio magni, laudantium ad eaque dicta accusantium ab eius temporibus incidunt, iure reiciendis facilis?
                </p>
                {{-- Author --}}
                <p class="text-end small">By Author</p>
            </div>

            {{-- Action Buttons --}}
            <div class="col-2">
                {{-- Refresh --}}
                <button type="submit" class="btn btn-lg p-1"><i class="fa-solid fa-arrows-rotate"></i></button>
                {{-- Bookmark --}}
                <button type="submit" class="btn btn-lg p-1"><i class="fa-regular fa-bookmark"></i></button>
                {{-- Copy --}}
                <button type="submit" class="btn btn-lg p-1"><i class="fa-regular fa-clone"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Journaling section --}}
<div class="container-journaling m-5">
    <div class="card bg-white py-3 px-5">
        <div class="card-header bg-white">
            {{-- Title --}}
            <h1 class="m-0 align-self-center float-start">Journaling</h1>
            <div class="align-self-center float-end">
                {{-- Link to Journaling page --}}
                <a href="{{ route('journal.journals') }}" class="small">
                    See All
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row ps-5">
                <div class="col-8 align-self-center p-0">
                    {{-- Journaling create --}}
                    <input type="text" name="journaling" id="journaling" class="form-control custom-placeholder shadow" placeholder="What's on your mind?" data-bs-toggle="modal" data-bs-target="#journaling-input">

                </div>
                {{-- modal for journaling --}}
                <div class="modal fade" id="journaling-input">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">

                            <div class="modal-header border-0">
                                {{-- title --}}
                                <h1>Add Journaling</h1>
                            </div>

                            <div class="modal-body">
                                {{-- input form --}}
                                <input type="text" name="journaling" id="journaling" class="form-control custom-placeholder" placeholder="What's on your mind?" autofocus>
                            </div>

                            <div class="modal-footer border-0 justify-content-center">
                                {{-- Action buttons --}}
                                <form action="#" method="post">
                                    @csrf
                                    {{-- Cancel --}}
                                    <button type="button" class="btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                    {{-- Save --}}
                                    <button type="submit" class="btn-submit ms-2"><i class="fa-solid fa-circle-check"></i> Save</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col p-0">
                    {{-- Remi-chan speaking --}}
                    <p class="small text-end p-0 m-0">
                        Write down anything <br>
                        that is in your mind!
                    </p>
                </div>
                <div class="col-auto p-0">
                    <div class="remichan_circle">
                        {{-- Remi-chan --}}
                        <img src="{{ asset('images/main/circle_remichan.png') }}" alt="Remichan">
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

{{-- Mood Tracker Section --}}
<div class="container-mood m-5">
    <div class="card bg-white border-0 py-3 px-5">
        <div class="card-header bg-white">
            <h1 class="m-0">Mood Tracking</h1>
        </div>
        <div class="card-body mb-5">

            <div class="row">
                {{-- Left: Calendar --}}
                <div class="col">
                    <div class="card border-0">
                        <div class="card-header border-0 bg-white">
                            <h3 class="calender w-100">Mood Calender</h3>
                        </div>
                    </div>
                    <div class="body border-0 bg-white">
                        <div class="w-100 text-center">
                            <a href="{{ route('mood.index') }}">Calendar</a>
                        </div>
                    </div>
                    <div class="footer bg-white border-0">
                        <p class="small px-5">
                            It shows the average score of your mood of the day.
                        </p>
                    </div>
                </div>

                {{-- Right: Graph --}}
                <div class="col">
                    <div class="card border-0">
                        <div class="card-header border-0 bg-white">
                            <h3 class="graph">Mood Graph</h3>
                        </div>
                        <div class="body border-0 bg-white">
                            <div class="w-100">

                            </div>
                        </div>
                        <div class="footer bg-white border-0">
                            <p class="small px-3">
                                It records your mood that you input when you login.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer bg-white">
            <p class="float-end">
                Do you want to record your mood more precisely?&nbsp;&nbsp;&nbsp;
                <a href="#" class="mood">Yes</a>
            </p>
        </div>
    </div>
</div>

{{-- Chat Room Section --}}
<div class="container-chat m-5">
    <div class="card bg-white py-3 px-5">

        <div class="card-header bg-white mb-3 border-0">
            {{-- Title --}}
            <h1 class="m-0 align-self-center float-start">Chat Room</h1>
        </div>
        <div class="body mb-5">
            <div class="row px-5">
                {{-- Chat Rooms --}}
                <div class="col-2 p-1">
                    <a href="#" class="btn btn-relationship w-100">Relationship</a>
                </div>
                <div class="col-2 p-1">
                    <a href="#" class="btn btn-career w-100">Career</a>
                </div>
                <div class="col-2 p-1">
                    <a href="#" class="btn btn-family w-100">Family</a>
                </div>
                <div class="col-2 p-1">
                    <a href="#" class="btn btn-health w-100">Health</a>
                </div>
                <div class="col-2 p-1">
                    <a href="#" class="btn btn-finance w-100">Finance</a>
                </div>
                <div class="col-2 p-1">
                    <a href="#" class="btn btn-others w-100">Others</a>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Option --}}
<div class="container-option m-5">
    <div class="card bg-white py-3 px-5">
        <p class="text-center">Option</p>
    </div>
</div>

<script>
    $(document).ready(function(){
console.log("test");
})
</script>

@endsection
