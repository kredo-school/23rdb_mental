<link rel="stylesheet" href="{{ asset('css/mood-tracker.css') }}">
@extends('layouts.app')

@extends('components.navbar-each')

@section('title', 'Mood Tracking')


@section('content')

@include('components.sidebar')

<div class="container-mood my-5 py-3">
    <div class="d-flex mb-3 input-size">

    {{-- <div class="container-mood my-5 py-3 mx-auto">
        <div class="d-flex align-items-center mb-3"> --}}

@include('components.sidebar')

<div class="container-mood my-5 py-3">
    <div class="d-flex mb-3 input-size">

    {{-- <div class="container-mood my-5 py-3 mx-auto">
        <div class="d-flex align-items-center mb-3"> --}}
            {{-- Avatar --}}
            <div class="icon-sm">
                <i class="fa-solid fa-circle-user avatar"></i>
            </div>

            {{-- Mood Input --}}
            <input type="text" name="mood" id="mood" class="form-control rounded-input shadow"
                placeholder="What's on your mind?" data-bs-toggle="modal" data-bs-target="#mood-input">
        </div>
        {{-- Modal for mood input --}}
        <div class="modal fade" id="mood-input">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                {{-- <div class="container-mood"> --}}
                <div class="modal-content bg-white">
                    {{-- <div class="row justify-content-center m-5"> --}}
                    {{-- <div class="col"> --}}
                    {{-- <div class="card p-5 bg-white shadow-lg"> --}}
                    <div class="modal-header border-0 mt-3">
                        <div class="row d-flex">
                            <div class="col-auto">
                                {{-- Remichan --}}
                                <div class="remi">
                                    <img src="{{ asset('images/main/circle_remichan.png') }}" alt="Remi-chan"
                                        class="w-20">
                                </div>
                            </div>
                            <div class="col">
                                {{-- Title --}}
                                <div class="row">
                                    <div class="col">
                                        <h2 class="text-center">What's Your Mood?</h2>
                                    </div>
                                    <div class="col-1 text-end">
                                        {{-- <div class="text-end"> --}}
                                            <button type="button" class="btn border-0 btn-lg" data-bs-dismiss="modal">
                                                <i class="fa-regular fa-circle-xmark"></i>
                                            </button>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('mood.store') }}">
                        <form method="post" action="{{ route('mood.store') }}">
                            @csrf

                            {{-- radio buttons --}}
                            <div class="row justify-content-center mb-4">
                                <div class="selectors d-flex">
                                    <div class="col-1"></div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img1" value="2" checked>
                                        <input type="radio" name="score" id="img1" value="2" checked>
                                        <label for="img1" class="selector great"></label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img2" value="1">
                                        <input type="radio" name="score" id="img2" value="1">
                                        <label for="img2" class="selector good"></label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img3" value="0">
                                        <input type="radio" name="score" id="img3" value="0">
                                        <label for="img3" class="selector ok"></label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img4" value="-1">
                                        <input type="radio" name="score" id="img4" value="-1">
                                        <label for="img4" class="selector notgood"></label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img5" value="-2">
                                        <input type="radio" name="score" id="img5" value="-2">
                                        <label for="img5" class="selector bad"></label>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                                @error('score')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror

                                @error('score')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror

                            </div>


                            <div class="row">
                                <div class="col text-end mb-0 pe-5">
                                    <button type="submit" class="btn-submit">
                                        Go &nbsp;<i class="fa-solid fa-play"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <div class="d-flex justify-content-end">
            @auth {{-- if logged in --}}
                <form action="" method="get" class="form-position">
                <form action="" method="get" class="form-position">
                    <input type="date" name="search" placeholder="search..." class="form-control shadow" value="#">
                </form>
            @endauth
        </div>

        <div class="card card-mood my-3 py-3 bg-white shadow">
        <div class="card card-mood my-3 py-3 bg-white shadow">
            <div class="card-header bg-white border-0">
                <h1 class="text-center">Calendar(API)</h1>
            </div>
        </div>
        <div class="card card-mood mb-5 px-3 bg-white shadow">
        <div class="card card-mood mb-5 px-3 bg-white shadow">
            <div class="card-header bg-white">
                {{-- Title --}}
                <h3 class="float-start mb-0">Feedback of this Month</h3>
                {{-- Action buttons --}}
                <div class="action-button float-end">
                    {{-- Edit --}}
                    <button type="button" class="btn button-edit border-0 pe-0" data-bs-toggle="modal" data-bs-target="#edit-feedback">
                        <i class="fa-regular fa-pen-to-square h5"></i>
                    </button>
                    {{-- Delete --}}
                    <button type="button" class="btn button-delete border-0" data-bs-toggle="modal" data-bs-target="#delete-feedback">
                        <i class="fa-solid fa-trash-can h5"></i>
                    </button>
                </div>
                {{-- Modal for edit --}}
                <div class="modal fade" id="edit-feedback">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">

                            <div class="modal-header border-0">
                                {{-- title --}}
                                <h3>Edit Monthly Feedback</h3>
                            </div>

                            <div class="modal-body">
                                {{-- input form --}}
                                <textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control" placeholder="How was your mood this month?" value=""></textarea>
                            </div>

                            <div class="modal-footer border-0 justify-content-center">
                                {{-- Action buttons --}}
                                <form action="#" method="post">
                                    @csrf
                                    @method('PATCH')
                                    {{-- Cancel --}}
                                    <button type="button" class="btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                    {{-- Save --}}
                                    <button type="submit" class="btn-submit ms-2"><i class="fa-solid fa-circle-check"></i> Save</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Modal for delete --}}
                <div class="modal fade modal-delete" id="delete-feedback">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">

                            <div class="modal-header px-5 py-3">
                                {{-- title --}}
                                <h3>Delete Monthly Feedback</h3>
                            </div>

                            <div class="modal-body p-5">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <p class="text-center">
                                            Are you sure you want to delete your feedback?
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer border-0 justify-content-center">
                                {{-- Action buttons --}}
                                <form action="#" method="post">
                                    @csrf
                                    @method('DELETE')
                                    {{-- Cancel --}}
                                    <button type="button" class="btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                    {{-- Save --}}
                                    <button type="submit" class="btn-delete ms-2"><i class="fa-solid fa-trash-can"></i> Delete</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-white">
                <p class="text-center">No feedback yet. &nbsp;&nbsp;<a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#feedback-input">Write
                        your feedback of this month</a></p>
            </div>
            <div class="modal fade" id="feedback-input">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">

                        <div class="modal-header border-0">
                            {{-- title --}}
                            <h1>Monthly Feedback</h1>
                        </div>

                        <div class="modal-body">
                            {{-- input form --}}
                            <textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control" placeholder="How was your mood this month?"></textarea>
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
        </div>
    </div>

@endsection
