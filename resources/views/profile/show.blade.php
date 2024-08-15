<link rel="stylesheet" href="{{ asset('css/profile-show.css') }}">

@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container-profile-show justify-content-center m-5">

        {{-- Profile Section --}}
        <div class="card card-profile mb-5 mx-auto py-3 px-5 bg-white">
            <div class="card-header bg-white border-0">
                <h1>Profile</h1>
            </div>
            <div class="card-body bg-white">
                <div class="row d-flex justify-content-center mb-3">
                    <div class="col-auto">
                        <i class="fa-solid fa-circle-user avatar"></i>
                    </div>

                    <div class="col align-self-center">
                        <p class="mb-0">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username</p>
                        <hr class="mt-0">
                        <p class="mb-0">Email Address:&nbsp;&nbsp; user@mail.com</p>
                        <hr class="mt-0">
                        <p class="mb-0">Theme Color:&nbsp;&nbsp; <img class="selector" src="{{ asset('images/selectors/default.png') }}" alt=""></p>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="mb-0 small">Birthday:&nbsp;&nbsp;&nbsp;Not Registered</p>
                        <hr class="mt-0">
                        <p class="mb-0 small">Location:&nbsp;&nbsp;&nbsp;Not Registered</p>
                        <hr class="mt-0">
                    </div>
                    <div class="col-3"></div>
                    <div class="col-3 align-self-end mb-2">
                        <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#edit-profile"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                    </div>
                    {{-- Edit Modal --}}
                    <div class="modal fade" id="edit-profile">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content px-5 py-3">
                                <div class="modal-header border-0 d-flex justify-content-between align-items-center">
                                    {{-- title --}}
                                    <h1 class="float-start">Edit Profile</h1>

                                    <button type="button" data-bs-dismiss="modal" class="btn btn-dismiss border-0"><i class="fa-solid fa-xmark"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                        <div class="row d-flex justify-content-center mb-3">
                                            <div class="col-5">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-9">
                                                        <i class="fa-solid fa-circle-user avatar text-center"></i>
                                                    </div>
                                                </div>

                                                <div class="row mt-5">
                                                    <div class="col">
                                                        <label for="avatar" class="form-label">Avatar</label>
                                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <label for="name" class="form-label">Name</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" name="name" id="name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" name="email" id="email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <label for="birthday" class="form-label">Birthday</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="date" name="birthday" id="birthday" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <label for="location" class="form-label">Location</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" name="location" id="location" class="form-control">
                                                    </div>
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
                                                    <input type="radio" name="selector" id="img1" value="default" checked>
                                                    <label for="img1" class="selector default"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="selector" id="img2" value="green">
                                                    <label for="img2" class="selector green"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="selector" id="img3" value="blue">
                                                    <label for="img3" class="selector blue"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="selector" id="img4" value="pink">
                                                    <label for="img4" class="selector pink"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="selector" id="img5" value="yellow">
                                                    <label for="img5" class="selector yellow"></label>
                                                </div>
                                                <div class="col-2">
                                                    <input type="radio" name="selector" id="img6" value="dark">
                                                    <label for="img6" class="selector dark"></label>

                                                </div>
                                            </div>
                                        </div>
                                </div>
                            <div class="modal-footer border-0">
                                <button type="submit" class="btn btn-save"><i class="fa-solid fa-circle-check"></i> Save</button>
                                </form>
                            </div>
                         </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
               <div class="text-end">
                    <button type="button" class="btn btn-sm btn-delete-account text-end" data-bs-toggle="modal" data-bs-target="#delete-account">Delete Account</button>
                </div>
                <div class="modal fade modal-delete" id="delete-account">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">

                            <div class="modal-header px-5 py-3">
                                {{-- title --}}
                                <h1>Delete Account</h1>
                            </div>

                            <div class="modal-body p-5">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <p class="text-center">
                                            Are you sure you want to delete your account? <br>Please tell us the reason:
                                        </p>
                                        {{-- input form --}}
                                        <input type="text" name="delete-account" id="delete-account" class="form-control custom-placeholder expanded-input" placeholder="Reason why you want to delete..." autofocus>
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
