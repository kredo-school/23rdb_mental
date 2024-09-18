{{-- Style CSS --}}
<link rel="stylesheet" href="{{ asset('css/mood.css') }}">

@extends('layouts.app')

@section('title', 'Mood Tracking (First login)')

@section('content')
<div class="container-mood">
    <div class="row justify-content-center m-5">
        <div class="col">
            <div class="card p-5 bg-white shadow-lg">
                {{-- Cancel Button --}}
                <div class="row mb-3">
                    <div class="col-10"></div>
                    <div class="col-2 pe-0 align-self-end me-0 mood-cancel">
                        <a href="{{ route('home') }}" class="text-decoration-none"><i class="fa-solid fa-angles-right"></i> Skip</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        {{-- Remichan --}}
                        <div class="remi">
                            <img src="{{ asset('images/main/circle_remichan.png') }}" alt="Remi-chan" class="w-20">
                        </div>
                    </div>
                    <div class="col">
                        {{-- Title --}}
                        <div class="row">
                            <div class="col">
                                <h2 class="text-center">What's Your Mood?</h2>
                           </div>
                        </div>
                        {{-- Devider --}}
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('mood.store') }}">
                        @csrf

                       {{-- radio buttons --}}
                       <div class="row justify-content-center mb-4">
                        <div class="selectors d-flex">
                            <div class="col-1"></div>
                            <div class="col-2">
                                <input type="radio" name="score" id="img1" value="2">
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
                            <div class="col text-end mb-0">
                                <button type="submit" class="btn-submit">
                                    Go <i class="fa-solid fa-play"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
