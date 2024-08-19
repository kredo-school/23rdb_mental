{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container-profile">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card bg-white p-5 shadow-lg">
                <div class="card-header bg-white border-0">
                    <div class="row">
                        <div class="col-auto">
                            <img src="{{ asset('images/main/remichan.png') }}" class="remichan" alt="remichan">
                        </div>
                        <div class="col my-auto">
                            <h2>Hi {{ $user->name }}!</h2>
                            <p class="small">Thank you for registering! First, let's set your profile!</p>
                        </div>
                    </div>

                </div>

                <div class="card-body p-0">
                    <form method="post" action="{{ route('profile.update') }}" class="mb-0" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
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
                                    @error('avatar')
                                        <p class="mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- vertical divider --}}
                            <div class="col-2 divider">
                                <div class="d-flex">
                                    <div class="vr border-6"></div>
                                </div>
                            </div>
                            {{-- right column --}}
                            <div class="col-5">
                                <div class="image-switcher">

                                    {{-- sample image --}}
                                    <div class="row mb-3 images">
                                        {{-- <div class="images"> --}}
                                            <img src="{{ asset('images/samples/default.png') }}" alt="Image 1" class="image hide-images" id="image1">
                                            <img src="{{ asset('images/samples/green.png') }}" alt="Image 2" class="image hide-images" id="image2">
                                            <img src="{{ asset('images/samples/blue.png') }}" alt="Image 3" class="image hide-images" id="image3">
                                            <img src="{{ asset('images/samples/pink.png') }}" alt="Image 4" class="image hide-images" id="image4">
                                            <img src="{{ asset('images/samples/yellow.png') }}" alt="Image 5" class="image hide-images" id="image5">
                                            <img src="{{ asset('images/samples/dark.png') }}" alt="Image 6" class="image hide-images" id="image6">
                                        {{-- </div> --}}
                                    </div>


                                    {{-- choices --}}
                                    <div class="row">
                                        <div class="row">
                                            <div class="col">
                                                <p>Choose your theme color:</p>
                                            </div>
                                        </div>

                                        {{-- radio buttons --}}
                                        <div class="row">
                                            <div class="selectors d-flex">
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img1" value="1" checked>
                                                    <label for="img1" class="selector default"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img2" value="2">
                                                    <label for="img2" class="selector green"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img3" value="3">
                                                    <label for="img3" class="selector blue"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img4" value="4">
                                                    <label for="img4" class="selector pink"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img5" value="5">
                                                    <label for="img5" class="selector yellow"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img6" value="6">
                                                    <label for="img6" class="selector dark"></label>

                                                </div>

                                            </div>
                                            @error('theme_color')
                                                <p class="mb-0 text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                        {{-- Action button --}}
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

@section('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection


