<link rel="stylesheet" href="{{ asset('css/journal.css') }}">

@extends('layouts.app')

@extends('components.navbar-each')

@include('components.sidebar-admin')

@section('title', 'Test Site')

@section('content')

<div>
    <div class="mt-0">
    </div>
</div>

{{-- <script>
    function plusLikeScore(id) {
        document.getElementById('likeScore' + id).value++;
    }
    function minusLikeScore(id) {
        document.getElementById('likeScore' + id).value--;
    }
</script> --}}

{{-- @inculde('components.footer') --}}

@endsection

