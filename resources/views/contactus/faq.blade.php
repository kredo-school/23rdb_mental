<link rel="stylesheet" href="{{ asset('css/faq.css') }}">

@extends('layouts.app')

@extends('components.navbar-each')

@section('title', 'FAQ')

@section('content')
@if(Auth::user()->role_id == 1)
    @include('components.sidebar-admin')
@else
    @include('components.sidebar')
@endif


    <div class="balloon2">
        <div class="icon faq-remichan_circle">
            {{-- Remi-chan --}}
            <img src="{{ asset('images/main/circle_remichan.png') }}" alt="Remichan" class="w-50 h-50"></div>
            <p class="text-center mt-2">We update the FAQ page regularly.&nbsp;&nbsp; <br> If you can't find answers,
                <a class="" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</a>.
            </p>
        <br>
    </div>

    @include('contactus.modals.inquiry')
    @include('contactus.modals.submitcomplete')



<div class="container-faq-show my-5">
    <div class="card mb-5 mx-auto py-3 px-5 bg-white">
        <div class="card-header bg-white border-0 my-3">
            <h1 class="">FAQ</h1>
        </div>
        <div class="card-body bg-white mt-3">

            <h3>Your account</h3>
            <details class="qa-7">
                <summary>How do I create a new MEntal Account?</summary>
                <p>1. Go to the sign in page <br> 
                    2. Click Register <br>
                    3. Enter your name, email address, and Password <br>
                    4. Click <strong>Register</strong> button
                    <br>
                    <br>
                    Tip: You can't use the same email address.
                </p>
            </details>
            <details class="qa-7">
                <summary>Can I change my username or email address?</summary>
                <p>Yes, you can change your username, email address, or any other personal information on your profile page. <br>
                1. Click <strong>your avator icon</strong> <br>
                2. Click <strong>edit</strong> button on profile page <br>
                3. Change your information <br>
                4. If you finish, click <strong>save</strong> button
                </p>
            </details>

            <details class="qa-7">
                <summary>Do I need to create a new account if I get a new device?</summary>
                <p>No, you can keep using our service with your exsiting account. </p>
            </details>
            <details class="qa-7">
                <summary>I can't sign in to my account</summary>
                <p>If you forgot your email address or password to sign in, Please contact us.
                <br>
                If an account's owner hasn't followed our policy, the account might be disabled.
                    <br>
                    You can contact us clicking <strong>Contact Us</strong> button.
                </p>
            </details>

            <details class="qa-7">
                <summary>Can I recover my account?</summary>
                <p>Once you delete your account, you can't recover it.
                    <br>
                Please  create your account again.
                </p>
            </details>

            <h3 class="mt-5">Setting</h3>
            <details class="qa-7">
                <summary>How do I change the theme color?</summary>
                <p>
                1. Click <strong>your avator icon</strong> <br>
                2. Click <strong>edit</strong> button on profile page <br>
                3. Change theme color <br>
                4. If you finish, click <strong>save</strong> button
                </p>
            </details>

            <details class="qa-7">
                <summary>What's the difference between username and nickname</summary>
                <p>Username is your personal infomation to use our service.
                    <br>
                    Nickname can be used when you don't want to visualize your username to anyone in chat room. Your perosonal information whould be protected.
                </p>
            </details>

            <h3 class="mt-5">Quote</h3>
            <details class="qa-7">
                <summary>What is today's quote?</summary>
                <p>
                You can read one different famous quote every day.
                <br>
                If you find a favorite quote, you can bookmark and see all quotes you bookmarked. 
                </p>
            </details>

            <h3 class="mt-5">Journaling</h3>
            <details class="qa-7">
                <summary>What I write on Journaling? </summary>
                <p>
                You can write whatever you come up in your mind now and vent your feelings.
                </p>
            </details>

            <h3 class="mt-5">Mood Tracking</h3>
            <details class="qa-7">
                <summary>What is mood face icon?</summary>
                <p>

                1. Click <strong>your avator icon</strong> <br>
                2. Click <strong>edit</strong> button on profile page <br>
                3. Change theme color <br>
                4. If you finish, click <strong>save</strong> button
                </p>
            </details>

            <h3 class="mt-5">Chat Room</h3>
            <details class="qa-7">
                <summary>How do I change the theme color?</summary>
                <p>
                1. Click <strong>your avator icon</strong> <br>
                2. Click <strong>edit</strong> button on profile page <br>
                3. Change theme color <br>
                4. If you finish, click <strong>save</strong> button
                </p>
            </details>


            

            {{-- <p class="text-end">If you can't find answers, <strong>Contact Us</strong>.</p> --}}
            {{-- <p class="text-end mt-4">We update the FAQ page regularly.&nbsp;&nbsp; If you can't find answers,
            <a class="" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</a>.
            </p> --}}
        </div>

       
    
    {{-- @endsection --}}

    
    
    
    @section('scripts')
        <script src="{{ asset('js/inquiry.js') }}"></script>
    @endsection
    
    </div>

</div>



    {{-- <div class="remichan_circle"> --}}
        {{-- Remi-chan --}}
        {{-- <img src="{{ asset('images/main/circle_remichan.png') }}" alt="Remichan">
    </div> --}}





@endsection