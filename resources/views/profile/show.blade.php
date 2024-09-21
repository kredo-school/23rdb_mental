<link rel="stylesheet" href="{{ asset('css/profile-show.css') }}">
@extends('layouts.app')

@extends('components.navbar-each')
@section('title', 'Profile')
@section('content')

    @if (Auth::user()->role_id == 1)
        @include('components.sidebar-admin')
    @else
        @include('components.sidebar')
    @endif

    <div class="container-profile-show my-5 pb-5">
        {{-- Profile Section --}}
        <div class="card card-profile mb-5 py-3 px-5 mx-auto bg-white">
            <div class="card-header bg-white border-0">
                <h1>Profile</h1>
            </div>
            <div class="card-body bg-white">
                <div class="row d-flex justify-content-center mb-3">
                    <div class="col-auto">
                        @if ($user->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="avatar" class="rounded-circle profile-avatar">
                        @else
                            <i class="fa-solid fa-circle-user profile-avatar"></i>
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
                        <br><br><br>
                        <p class="text-end mb-2">
                            <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#edit-profile"><i
                                    class="fa-regular fa-pen-to-square"></i> Edit</button>
                        </p>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-6">
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
                    </div> --}}
                    <div class="col-3"></div>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="edit-profile">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content px-5 py-3">
                                <div class="modal-header border-0 d-flex justify-content-between align-items-center">
                                    {{-- title --}}
                                    <h1 class="float-start">Edit Profile</h1>
                                    <button type="button" data-bs-dismiss="modal"
                                        class="btn btn-profile-edit-dismiss border-0"><i
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
                                                                class="rounded-circle modal-profile-avatar text-center ">
                                                        @else
                                                            <i
                                                                class="fa-solid fa-circle-user modal-profile-avatar text-center"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col">
                                                        <label for="avatar" class="form-label">Avatar</label>
                                                        <input type="file" name="avatar" id="avatar"
                                                            class="form-control">
                                                        @if (Auth::user()->avatar)
                                                            <button type="submit" name="remove_avatar"
                                                                class="btn btn-sm remove-avatar" value="1">Remove
                                                                Avatar</button>
                                                        @endif
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
                                                            class="form-control"
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
                                                        value="1"
                                                        {{ old('theme_color', $user->theme_color) == 1 ? 'checked' : '' }}>
                                                    <label for="img1" class="selector default"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img2"
                                                        value="2"
                                                        {{ old('theme_color', $user->theme_color) == 2 ? 'checked' : '' }}>
                                                    <label for="img2" class="selector green"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img3"
                                                        value="3"
                                                        {{ old('theme_color', $user->theme_color) == 3 ? 'checked' : '' }}>
                                                    <label for="img3" class="selector blue"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img4"
                                                        value="4"
                                                        {{ old('theme_color', $user->theme_color) == 4 ? 'checked' : '' }}>
                                                    <label for="img4" class="selector pink"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img5"
                                                        value="5"
                                                        {{ old('theme_color', $user->theme_color) == 5 ? 'checked' : '' }}>
                                                    <label for="img5" class="selector yellow"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="theme_color" id="img6"
                                                        value="6"
                                                        {{ old('theme_color', $user->theme_color) == 6 ? 'checked' : '' }}>
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
                                            <textarea name="reason" id="reason" cols="30" rows="5" class="form-control"
                                                placeholder="Reason why you want to delete..."></textarea>
                                            @error('reason')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                {{-- Action buttons --}}
                                {{-- @method('DELETE') --}}
                                {{-- Cancel --}}
                                <button type="button" class="btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                {{-- Save --}}
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
        <div class="card card-quotes px-5 py-3 bg-white mb-5 mx-auto">
            <div class="card-header bg-white border-0 ">
                <h1>Favorite Quotes</h1>
            </div>
            <div class="card-body bg-white border-0">

                {{-- Table for favorite quotes --}}
                <table class="table border align-middle bg-white">
                    {{-- Header --}}
                    <thead class="table-secondary small border favorite-quote text-center">
                        <tr>
                            {{-- <th></th> --}}
                            <th colspan="7" class="text-center py-2">Quote</th>
                            {{-- <th></th> --}}
                            <th colspan="3" class="text-center py-2">Auther</th>
                            <th colspan="2" class="text-center pe-2">Bookmark</th>
                        </tr>

                    </thead>
                    {{-- Body --}}
                    <tbody class="border quote-table">

                        @forelse($bookmarked_quotes as $quote)
                            @if ($quote->isBookmarked())
                                <tr>
                                    <td colspan=7 class="h4 text-center w-50 py-4 ps-4" value="showquote-quote">
                                        " {{ $quote->quote }} "
                                    </td>

                                    <td colspan="3" class="text-center py-4">
                                        {{ $quote->author }}
                                    </td>


                                    <td colspan="2" class="text-center">
                                        {{-- cancel the bookmark --}}
                                        <div class="quote-switch text-center">
                                            @if ($quote->isBookmarked())
                                                <form action="{{ route('bookmark.destroy', $quote->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn py-5">
                                                        <i
                                                            class="fa-solid fa-bookmark text-warning quote-bookmark-store favorite-quote-icon pt-4"></i></button>
                                                @else
                                                    <form action="{{ route('bookmark.store', $quote->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn py-3"><i
                                                                class="fa-regular fa-bookmark quote-bookmark-cancel favorite-quote-icon pt-4"></i></button>
                                                    </form>
                                            @endif
                                        </div>


                                    </td>
                            @endif
                            </tr>


                        @empty
                            <tr>
                                <td colspan="12" class="lead text-muted text-center py-3">No Quote Bookmarked.</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>


                <div class="d-flex justify-content-center">
                    {{-- {{ $bookmarked_quotes->links() }} --}}
                </div>

            </div>
        </div>

    </div>
@endsection
