@extends('layouts.app')
@section('title', 'Test')
@section('content')
    {{-- <section> --}}
        <h1>MEntal</h1>
        <p>This is a testing page using the app layout.</p>


        <h2>Buttons</h2>
        Submit<br>
        <button class="btn-submit"><i class="fa-solid fa-file-import"></i> Submit</button>

        <br><br>
        Save<br>
        <button class="btn-save"><i class="fa-solid fa-circle-check"></i> Save</button>

        <br><br>
        Edit<br>
        <button class="btn-edit"><i class="fa-regular fa-pen-to-square"></i> Edit</button>

        <br><br>
        Delete<br>
        <button class="btn-delete"><i class="fa-solid fa-trash-can"></i> Delete</button>

        <br><br>
        Hide<br>
        <button class="btn-hide"><i class="fa-solid fa-eye-slash"></i> Hide</button>

        <br><br>
        Cancel<br>
        <button class="btn-cancel">Cancel</button>

        <br><br>
        Go Back to Home<br>
        <button class="btn-home">Go Back to Home</button>

        <br><br>
        Contact Us<br>
        <button class="btn-contact">Contact Us</button>

        <br><br>
        Logout<br>
        <button class="btn-logout">Logout</button>

        <br><br>
        Register<br>
        <button class="btn-register">Register</button>

    {{-- </section> --}}
    <br><br>

    <img src="{{ asset('images/main/default_logo.png') }}" style="width: 300px" alt="logo">
    <img src="{{ asset('images/main/remichan.png') }}" style="width: 300px" alt="logo">




@endsection
