@extends('layouts.app')

@extends('components.navbar-each')
@extends('components.sidebar')

@section('title', 'Journal')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/journal.css') }}">
</head>

<div>
    <div class="mt-4" style="margin-left:200px;">
        <div class="w-75 mx-auto">

            <div class="input-group mb-3" data-bs-toggle="modal" data-bs-target="#add-post">
                <i class="fa-solid fa-circle-user fa-3x me-3"></i>
                <input type="text" name="journal_body" id="journal_body" class="form-control rounded-3" placeholder="What's on your mind?" value="">
            </div>
            @include('journals.contents.modals.add')

            <div class="card input-group mb-3 p-2">
                <form action="#" method="get">
                    <span class="text-primary">Sort</span>
                    <div class="dropdown d-inline me-5">
                        <button class="btn dropdown-toggle btn-link text-decoration-none text-muted" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Latest
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                      </div>
                    <span class="text-primary me-3">Search</span>

                          <form class="">
                            <div class="search-date-area input-group date d-inline" id="datetimepicker1" data-target-input="nearest">
                              <label for="datetimepicker1" class="pt-2 pr-2">開始：</label>
                              <input type="text" class="form-control datetimepicker-input d-inline" style="width:100px;" data-target="#datetimepicker1"/>
                              <div class="input-group-text d-inline" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <i class="far fa-calendar-alt d-inline"></i>
                              </div>
                            </div>

                            <div class="input-group date d-inline" id="datetimepicker1" data-target-input="nearest">
                                <label for="datetimepicker1" class="pt-2 pr-2"> ～ 終了：</label>
                                <input type="text" class="form-control datetimepicker-input d-inline" style="width:100px;" data-target="#datetimepicker1"/>
                                <div class="input-group-text d-inline" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                  <i class="far fa-calendar-alt d-inline"></i>
                                </div>
                              </div>

                            <input type="text" class="form-control d-inline text-muted" style="width:150px;" name="search" placeholder="keyword" value="">
                        </form>
                </form>
            </div>

            @forelse ($all_journals as $journal)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-inline text-start">

                            <span>{{ $journal->created_at }}</span>
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $journal->id }}">
                                <i class="fa-solid fa-trash-can text-danger icon-sm d-inline float-end"></i>
                            </a>
                            @include('journals.contents.modals.delete')

                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-post-{{ $journal->id }}">
                                <i class="fa-solid fa-pen-to-square text-primary icon-sm d-inline float-end me-2"></i>
                            </a>
                                @include('journals.contents.modals.edit')

                        </div>
                        <div class="mb-3 fs-3">
                            {{ $journal->body }}
                        </div>
                        <div>
                            <form action="{{ route('journal.update_like', $journal->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <i id="plus" class="fa-solid fa-circle-plus text-secondary  fa-2x" style="cursor: pointer;" onclick="plusLikeScore({{ $journal->id }});"></i>
                                <div class="like_score d-inline" style="position:relative;">
                                    <i class="fa-solid fa-heart text-danger fa-2x"></i>
                                    <input type="text" id="likeScore{{ $journal->id }}" name="likeScore{{ $journal->id }}" value="{{ $journal->like_score }}" class="inputtext fw-bold text-white" style="width:30px; position:absolute; left:30%; margin:0; padding:0; background-color:transparent; outline: none; border: none;">
                                </div>
                                <i id="minus" class="fa-solid fa-circle-minus text-secondary fa-2x" style="cursor: pointer;" onclick="minusLikeScore({{ $journal->id }});"></i>
                                <button type="submit" class="btn btn-save">
                                    <i class="fa-solid fa-circle-check"></i> Save
                                </button>
                            </form>

                            <div class="d-inline float-end">
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#reply-post-{{ $journal->id }}">
                                    <i class="fa-solid fa-arrow-left-long text-primary icon-sm"></i>
                                    <span class="text-primary">Reply</span>
                                </a>
                            </div>
                            @include('journals.contents.modals.reply')
                        </div>
                        <div>
                            @foreach ($journal->replies as $reply)
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="mb-3 fs-5">
                                            {{ $reply->body }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="lead text-muted text-center">
                    No Journal Found.
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function plusLikeScore(id) {
        document.getElementById('likeScore' + id).value++;
    }
    function minusLikeScore(id) {
        document.getElementById('likeScore' + id).value--;
    }
</script>

@endsection
