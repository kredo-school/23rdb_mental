<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
@extends('layouts.app')

@section('title', 'footer')

@section('content')
<body>
    <footer class="bg-footer fixed-bottom">
        <div class="container-fluid p-3 p-md-5">
            <p>MEntal copyright 2024 Designed and built by Kred 23rd Batch B</p>
        </div>
            <div class="modal-body d-md-flex justify-content-md-end me-4 mb-4 ms-4">
                <button class="btn-contact" data-bs-toggle="modal" data-bs-target="#ContactUs">Contact Us</button>
            </div>
    </footer>

    @include('contactus.modals.inquiry')
    @include('contactus.modals.submitcomplete')

@endsection


@section('scripts')
    <script src="{{ asset('js/inquiry.js') }}"></script>
@endsection
