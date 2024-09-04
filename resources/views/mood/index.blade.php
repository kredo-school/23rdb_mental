<link rel="stylesheet" href="{{ asset('css/mood-tracker.css') }}">
{{-- graph --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@latest"></script>

{{-- <script src="{{ asset('js/chart.js') }}" defer></script> --}}

@extends('layouts.app')

@extends('components.navbar-each')

@section('title', 'Mood Tracking')

@section('content')

    @if (Auth::user()->role_id == 1)
        @include('components.sidebar-admin')
    @else
        @include('components.sidebar')
    @endif

    <div class="container-mood my-5 py-3">
        <div class="d-flex mb-3 input-size">

            {{-- <div class="container-mood my-5 py-3 mx-auto">
        <div class="d-flex align-items-center mb-3"> --}}
            {{-- Avatar --}}
            @if (Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" alt="icon" class="avatar-sm rounded-circle">
            @else
                <i class="fa-solid fa-circle-user avatar icon-sm"></i>
            @endif

            {{-- Mood Input --}}
            <input type="text" name="mood" id="mood" class="form-control rounded-input shadow"
                placeholder="Record your current mood" data-bs-toggle="modal" data-bs-target="#mood-input">
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
                            @csrf

                            {{-- radio buttons --}}
                            <div class="row justify-content-center mb-4">
                                <div class="selectors d-flex">
                                    <div class="col-1"></div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img1" value="2" checked>
                                        <label for="img1" class="selector great"></label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img2" value="1">
                                        <label for="img2" class="selector good"></label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img3" value="0">
                                        <label for="img3" class="selector ok"></label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img4" value="-1">
                                        <label for="img4" class="selector notgood"></label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="score" id="img5" value="-2">
                                        <label for="img5" class="selector bad"></label>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
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
                    <input type="date" name="search" placeholder="search..." class="form-control shadow" value="#">
                </form>
            @endauth
        </div>

        <div class="card card-mood my-3 py-3 bg-white shadow">
            <div class="card-header bg-white border-0">
                {{-- <h1 class="text-center"> --}}
                <canvas style="width: 150px; height: 150px;" id="moodGraph"></canvas>
                {{-- </h1> --}}
            </div>

        </div>

        <div class="card card-feedback mb-5 px-3 bg-white shadow">
            <div class="card-header bg-white">
                {{-- Title --}}
                <h3 class="float-start mb-0">Feedback of this Month</h3>
                {{-- Action buttons --}}
                <div class="action-button float-end">
                    {{-- Edit --}}
                    <button type="button" class="btn button-edit border-0 pe-0" data-bs-toggle="modal"
                        data-bs-target="#edit-feedback">
                        <i class="fa-regular fa-pen-to-square h5"></i>
                    </button>
                    {{-- Delete --}}
                    <button type="button" class="btn button-delete border-0" data-bs-toggle="modal"
                        data-bs-target="#delete-feedback">
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
                                <textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control"
                                    placeholder="How was your mood this month?" value=""></textarea>
                            </div>

                            <div class="modal-footer border-0 justify-content-center">
                                {{-- Action buttons --}}
                                <form action="#" method="post">
                                    @csrf
                                    @method('PATCH')
                                    {{-- Cancel --}}
                                    <button type="button" class="btn-cancel me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    {{-- Save --}}
                                    <button type="submit" class="btn-submit ms-2"><i
                                            class="fa-solid fa-circle-check"></i> Save</button>
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
                                    <button type="button" class="btn-cancel me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    {{-- Save --}}
                                    <button type="submit" class="btn-delete ms-2"><i class="fa-solid fa-trash-can"></i>
                                        Delete</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-white">
                <p class="text-center">No feedback yet. &nbsp;&nbsp;<a href="#" class="text-decoration-none"
                        data-bs-toggle="modal" data-bs-target="#feedback-input">Write
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
                            <textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control"
                                placeholder="How was your mood this month?"></textarea>
                        </div>

                        <div class="modal-footer border-0 justify-content-center">
                            {{-- Action buttons --}}
                            <form action="#" method="post">
                                @csrf
                                {{-- Cancel --}}
                                <button type="button" class="btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                {{-- Save --}}
                                <button type="submit" class="btn-submit ms-2"><i class="fa-solid fa-circle-check"></i>
                                    Save</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/mood/getmood', {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Data:', data);
                    if (data.length === 0) {
                        console.error('No data found');
                        return;
                    }
                    // const labels = data.map(item => new Date(item.date));
                    // const moodData = data.map(item => {
                    //     if (item.avg_score > 2) return 2;
                    //     if (item.avg_score < -2) return -2;
                    //     return item.avg_score;
                    // });
                    const labels = data.map(item => new Date(item.created_at));
                    // const moodData = data.map(item => item.score);
                    const moodData = data.map(item => ({
                        x: new Date(item.created_at),
                        y: item.score
                    }));
                    console.log('Labels:', labels);
                    console.log('Mood Data:', moodData);
                    // Chart
                    const ctx = document.getElementById('moodGraph').getContext('2d');
                    const moodGraph = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Mood Over Time',
                                data: moodData,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: false
                            }]
                        },
                        options: {
                            scales: {
                                x: {
                                    type: 'time',
                                    time: {
                                        unit: 'minute',
                                        tooltipFormat: 'll HH:mm',
                                        displayFormats: {
                                            minute: 'HH:mm',
                                            hour: 'MMM D, HH:mm',
                                            day: 'MMM D',
                                            month: 'MMM YYYY',
                                            year: 'YYYY'
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Date & Time'
                                    }
                                },
                                y: {
                                    ticks: {
                                        callback: function(value) {
                                            switch (value) {
                                                case 2:
                                                    return 'Great';
                                                case 1:
                                                    return 'Good';
                                                case 0:
                                                    return 'Okay';
                                                case -1:
                                                    return 'Not Good';
                                                case -2:
                                                    return 'Bad';
                                                default:
                                                    return '';
                                            }
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Mood'
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        });
    </script>
@endsection
