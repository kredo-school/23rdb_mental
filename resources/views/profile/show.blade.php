<link rel="stylesheet" href="{{ asset('css/profile-show.css') }}">

{{-- @extends('layouts.app') --}}
@extends('components.navbar-each')

@section('title', 'Profile')

@section('content')

    @extends('components.sidebar')
    <div class="container-profile-show my-5">

        {{-- Profile Section --}}
        <div class="card card-profile mb-5 mx-auto py-3 px-5 bg-white">
            <div class="card-header bg-white border-0">
                <h1>Profile</h1>
            </div>
            <div class="card-body bg-white">
                <div class="row d-flex justify-content-center mb-3">
                    <div class="col-auto">
                        @if ($user->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="avatar" class="rounded-circle avatar">
                        @else
                            <i class="fa-solid fa-circle-user avatar"></i>
                        @endif
                    </div>

                    <div class="col align-self-center">
                        <p class="mb-0">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->name }}</p>
                        <hr class="mt-0">
                        <p class="mb-0">Email Address:&nbsp;&nbsp; {{ $user->email }}</p>
                        <hr class="mt-0">
                        <p class="mb-0">Theme Color:&nbsp;&nbsp;
                            @if ($user->theme_color == 1)
                                <img class="selector" src="{{ asset('images/selectors/default.png') }}" alt="">
                            @elseif ($user->theme_color == 2)
                                <img class="selector" src="{{ asset('images/selectors/green.png') }}" alt="">
                            @elseif ($user->theme_color == 3)
                                <img class="selector" src="{{ asset('images/selectors/blue.png') }}" alt="">
                            @elseif ($user->theme_color == 4)
                                <img class="selector" src="{{ asset('images/selectors/pink.png') }}" alt="">
                            @elseif ($user->theme_color == 5)
                                <img class="selector" src="{{ asset('images/selectors/yellow.png') }}" alt="">
                            @else
                                <img class="selector" src="{{ asset('images/selectors/dark.png') }}" alt="">
                            @endif
                        </p>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="mb-0 small">Birthday:&nbsp;&nbsp;&nbsp;
                            @if ($user->birthday)
                                {{ $user->birthday }}
                            @else
                                Not Registered
                            @endif
                        </p>
                        <hr class="mt-0">
                        <p class="mb-0 small">Location:&nbsp;&nbsp;&nbsp;
                            @if ($user->location)
                                {{ $user->location }}
                            @else
                                Not Registered
                            @endif
                        </p>
                        <hr class="mt-0">
                    </div>
                    <div class="col-3"></div>
                    <div class="col-3 align-self-end mb-2">
                        <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#edit-profile"><i
                                class="fa-regular fa-pen-to-square"></i> Edit</button>
                    </div>
                    {{-- Edit Modal --}}
                    <div class="modal fade" id="edit-profile">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content px-5 py-3">
                                <div class="modal-header border-0 d-flex justify-content-between align-items-center">
                                    {{-- title --}}
                                    <h1 class="float-start">Edit Profile</h1>

                                    <button type="button" data-bs-dismiss="modal" class="btn btn-dismiss border-0"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('profile.update2') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row d-flex justify-content-center mb-3">
                                            <div class="col-5">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-9">
                                                        @if (Auth::user()->avatar)
                                                            <img src="{{ Auth::user()->avatar }}" alt="avatar"
                                                                class="rounded-circle avatar text-center ">
                                                        @else
                                                            <i class="fa-solid fa-circle-user avatar text-center"></i>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mt-5">
                                                    <div class="col">
                                                        <label for="avatar" class="form-label">Avatar</label>
                                                        <input type="file" name="avatar" id="avatar"
                                                            class="form-control">
                                                    </div>
                                                    @error('avatar')
                                                        <p class="text-danger small">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <label for="name" class="form-label">Name</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" name="name" id="name"
                                                            class="form-control"
                                                            value="{{ old('name', Auth::user()->name) }}">
                                                    </div>
                                                    @error('name')
                                                        <p class="text-danger small">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" name="email" id="email"
                                                            class="form-control"
                                                            value="{{ old('email', Auth::user()->email) }}">
                                                    </div>
                                                    @error('email')
                                                        <p class="text-danger small">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <label for="birthday" class="form-label">Birthday</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="date" name="birthday" id="birthday"
                                                            class="form-control"
                                                            value="{{ old('birthday', Auth::user()->birthday) }}">
                                                    </div>
                                                    @error('birthday')
                                                        <p class="text-danger small">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <label for="location" class="form-label">Location</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" name="location" id="location"
                                                            class="form-control" placeholder="Tokyo, Japan"
                                                            value="{{ old('location', Auth::user()->location) }}">
                                                    </div>
                                                    @error('location')
                                                        <p class="text-danger small">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <p>Choose your theme color:</p>
                                            </div>
                                        </div>
                                        {{-- radio buttons --}}
                                        <div class="row">
                                            <div class="selectors d-flex">
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img1"
                                                        value="1" checked>
                                                    <label for="img1" class="selector default"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img2"
                                                        value="2">
                                                    <label for="img2" class="selector green"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img3"
                                                        value="3">
                                                    <label for="img3" class="selector blue"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img4"
                                                        value="4">
                                                    <label for="img4" class="selector pink"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img5"
                                                        value="5">
                                                    <label for="img5" class="selector yellow"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img6"
                                                        value="6">
                                                    <label for="img6" class="selector dark"></label>

                                                </div>
                                                @error('theme_color')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="submit" class="btn btn-save"><i class="fa-solid fa-circle-check"></i>
                                        Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="text-end">
                    <button type="button" class="btn btn-sm btn-delete-account text-end" data-bs-toggle="modal"
                        data-bs-target="#delete-account">Delete Account</button>
                </div>
                <div class="modal fade modal-delete" id="delete-account">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">

                            <div class="modal-header px-5 py-3">
                                {{-- title --}}
                                <h1>Delete Account</h1>
                            </div>

                            <div class="modal-body p-5">
                                <form action="{{ route('deletion-reason.store') }}" method="post">
                                @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-8">
                                            <p class="text-center">
                                                Are you sure you want to delete your account? <br>Please tell us the reason:
                                            </p>
                                            {{-- input form --}}
                                            <textarea name="reason" id="reason" cols="30" rows="5" class="form-control" placeholder="Reason why you want to delete..."></textarea>
                                        </div>
                                        @error('reason')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                            </div>

                            <div class="modal-footer border-0 justify-content-center">
                                {{-- Action buttons --}}
                                    {{-- @method('DELETE') --}}
                                    {{-- Cancel --}}
                                    <button type="button" class="btn-cancel me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    {{-- Save deletion reason/Delete account --}}
                                    <button type="submit" class="btn-delete ms-2"><i class="fa-solid fa-trash-can"></i>
                                        Delete</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quote Section --}}
        <div class="card card-quotes mx-auto px-5 py-3 bg-white">
            <div class="card-header bg-white border-0 ">
                <h1>Favorite Quotes</h1>
            </div>
            <div class="card-body bg-white border-0">

                {{-- Table for favorite quotes --}}
                <table class="table border table-hover align-middle bg-white text-secondary">
                    {{-- Header --}}
                    <thead class="table-secondary small">
                        <tr>
                            <th class="quote-column">Quote</th>
                            <th class="author-column">Author</th>
                        </tr>
                    </thead>
                    {{-- Body --}}
                    <tbody>
                        <tr>
                            {{-- @forelse ($collection as $item)
                                    <td class="quote-column"></td>
                                    <td class="author-column"></td>
                                @empty --}}
                            <td class="text-center" colspan="2">No quotes saved.</td>
                            {{-- @endforelse --}}
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
