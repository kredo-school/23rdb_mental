{{-- Style CSS --}}
<link rel="stylesheet" href="{{ asset('css/mood.css') }}">

@extends('layouts.app')

@section('title', 'Mood Tracking (First login)')

@section('content')
<div class="container-mood">
    <div class="row justify-content-center m-5">
        <div class="col">
            <div class="card p-5 bg-white shadow-lg">
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
                    <form method="#" action="#">
                        @csrf

                       {{-- radio buttons --}}
                       <div class="row justify-content-center mb-4">
                            <div class="selectors d-flex">
                                <div class="col-1"></div>
                                <div class="col-2">
                                    <input type="radio" name="selector" id="img1" value="great" checked>
                                    <label for="img1" class="selector great"></label>
                                </div>
                                <div class="col-2">
                                    <input type="radio" name="selector" id="img2" value="good">
                                    <label for="img2" class="selector good"></label>
                                </div>
                                <div class="col-2">
                                    <input type="radio" name="selector" id="img3" value="ok">
                                    <label for="img3" class="selector ok"></label>
                                </div>
                                <div class="col-2">
                                    <input type="radio" name="selector" id="img4" value="notgood">
                                    <label for="img4" class="selector notgood"></label>
                                </div>
                                <div class="col-2">
                                    <input type="radio" name="selector" id="img5" value="bad">
                                    <label for="img5" class="selector bad"></label>
                                </div>
                                <div class="col-1"></div>
                            </div>
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
