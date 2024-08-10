{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container-profile" onLoad="preLoad()">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card p-5 shadow-lg">
                <div class="card-header bg-white border-0">
                    <div class="row">
                        <div class="col-auto">
                            <img src="{{ asset('images/main/remichan.png') }}" class="remichan" alt="remichan">
                        </div>
                        <div class="col my-auto">
                            <h2>Hi #Username</h2>
                            <p>Thank you for registering! First, let's set your profile!</p>
                        </div>
                    </div>

                </div>

                <div class="card-body p-0">
                    <form method="#" action="#" class="mb-0" autocomplete="off">
                        @csrf

                        <div class="row mt-5">
                            {{-- left column --}}
                            <div class="col-5">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-6 mt-3">
                                        <i class="fa-solid fa-circle-user avatar"></i>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <label for="avatar" class="form-label">Upload your avatar</label>
                                    <input type="file" name="avatar" id="avatar" class="form-control">
                                </div>
                            </div>

                            {{-- vertical divider --}}
                            <div class="col-2 divider">
                                <div class="d-flex" style="height: 300px;">
                                    <div class="vr border-6"></div>
                                </div>
                            </div>
                            {{-- right column --}}
                            <div class="col-5">

                                {{-- sample image --}}
                                <div class="row mb-3">
                                    <img src="{{ asset('images/samples/default.png') }}" alt="themecolor">
                                </div>

                                {{-- choices --}}
                                <div class="row">
                                    <div class="row">
                                        <div class="col">
                                            <label for="colors" class="form-label">Choose your theme color:</label>
                                       </div>
                                    </div>
                                    {{-- colors --}}
                                    <div class="row d-flex justify-content-center">
                                        <div class="selector d-flex">
                                            <div class="col-2 mx-auto">
                                                <input type="radio" name="colors" id="default" value="default" checked>
                                                <label for="default" class="colors default"></label>
                                            </div>
                                            <div class="col-2 mx-auto">
                                                <input type="radio" name="colors" id="green" value="green">
                                                <label for="green" class="colors green"></label>
                                            </div>
                                            <div class="col-2">
                                                <input type="radio" name="colors" id="blue" value="blue">
                                                <label for="blue" class="colors blue"></label>
                                            </div>
                                            <div class="col-2">
                                                <input type="radio" name="colors" id="pink" value="pink">
                                                <label for="pink" class="colors pink"></label>
                                            </div>
                                            <div class="col-2">
                                                <input type="radio" name="colors" id="yellow" value="yellow">
                                                <label for="yellow" class="colors yellow"></label>
                                            </div>
                                            <div class="col-2">
                                                <input type="radio" name="colors" id="dark" value="dark">
                                                <label for="dark" class="colors dark"></label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>

                        <div class="row mb-4">
                            <div class="col text-end mt-5 mb-0">
                                <button type="submit" class="btn-submit">
                                    Start <i class="fa-solid fa-play"></i>
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