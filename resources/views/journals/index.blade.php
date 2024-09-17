<link rel="stylesheet" href="{{ asset('css/journal.css') }}">

@extends('layouts.app')
@extends('components.navbar-each')
@section('title', 'Journal')

@section('content')
@if(Auth::user()->role_id == 1)
    @include('components.sidebar-admin')
@else
    @include('components.sidebar')
@endif

<div>
    <div class="journal-body mt-4">
        <div class="w-75 mx-auto">

            {{-- Add journal --}}
            <div class="journal-add-area input-group mb-3" data-bs-toggle="modal" data-bs-target="#add-post">
                {{-- User Icon --}}
                @if (Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="avatar" class="avatar-sm rounded-circle icon-sm img-fluid my-auto mx-auto">
                @else
                    <i class="fa-solid fa-circle-user avatar avatar-default fa-2x my-auto mx-auto"></i>
                @endif
                <input type="text" name="journal_body" id="journal_body" class="journal-add-input form-control rounded-input shadow ms-2"
                    placeholder="What's on your mind?" value="">
            </div>
            @include('journals.contents.modals.add')

            {{-- Search Section --}}
            <div class="input-group bg-white rounded shadow mb-3 p-3">
                <form action="{{ route('journal.journals') }}" method="get" class="journal-form">
                    {{-- Sort --}}
                    <span class="text-primary ms-4 me-3">Sort</span>
                    <select name="sort" id="sort" class="journal-search-component form-select shadow" onchange="this.form.submit()">
                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest
                        </option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest
                        </option>
                        <option value="like_score" {{ request('sort') === 'like_score' ? 'selected' : '' }}>Most Liked
                        </option>
                    </select>
                    {{-- Search date --}}
                    <span class="text-primary ms-5 me-3">Search</span>
                    <input type="date" name="search_date_start" class="journal-search-component form-control search-date shadow" value="{{ $search_date_start }}">
                    ～
                    <input type="date" name="search_date_end" class="journal-search-component form-control search-date shadow" value="{{ $search_date_end }}">
                    {{-- Search keyword --}}
                    <div class="search_box">
                            @csrf
                            <input type="text" name="search" placeholder="search..." class="journal-search-component journal-search-keyword form-control shadow ms-3" value="{{ $search }}">
                    </div>
                        {{-- @if ($search)
                        <p class="text-muted mb-4 small">Search results for '<span class="fw-bold">{{ $search }}</span>'</p>
                    @endif --}}
                    {{-- <button type="submit" class="btn bg-none btn-outline-secondary btn-lg">
                        <i class="fa-solid fa-search"></i>
                      </button> --}}
                </form>
            </div>

            {{-- Journal Contents Section --}}
            @forelse ($all_journals as $journal)
                <div class="card mb-3 px-4 py-2 shadow">
                    <div class="card-body">
                        {{-- Reply Body --}}
                        {{-- @if ($journal->journals_include_replying_journal)
                        <div class="text-muted">
                                <span class="fs-6">{{ $journal->journals_include_replying_journal->created_at }}</span>
                            <div class="mb-3 fs-5">
                                {{ $journal->journals_include_replying_journal->body }}
                            </div>
                            <hr>
                        </div>
                        @endif
                         --}}
                        {{-- Date, Edit and Delete --}}
                        <div class="text-start">
                            {{-- Date --}}
                            <span class="fs-6">{{ $journal->created_at }}</span>
                            {{-- Delete --}}
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $journal->id }}">
                                <i class="fa-solid fa-trash-can delete-icon float-end"></i>
                            </a>
                            @include('journals.contents.modals.delete')
                            {{-- Edit --}}
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-post-{{ $journal->id }}">
                                <i class="fa-solid fa-pen-to-square edit-icon float-end me-2"></i>
                            </a>
                            @include('journals.contents.modals.edit')
                        </div>
                        {{-- Reply Link--}}
                        {{-- <div class="float-end">
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#reply-post-{{ $journal->id }}">
                                <i class="fa-solid fa-reply text-primary icon-sm"></i>
                                <span class="text-primary fw-bold">Reply</span>
                            </a>
                        </div> --}}
                        @include('journals.contents.modals.reply')
                        {{-- Body --}}
                        <div class="mb-3 fs-4">
                            {{ $journal->body }}
                        </div>
                        {{-- Like Score --}}
                        <div>
                            <i id="minus" class="button_minus fa-solid fa-circle-minus text-secondary fa-lg" onclick="decrementLikeScore({{ $journal->id }})"></i>
                            <div class="like-container">
                                <i class="like-icon fas fa-heart fa-2x" id="like-icon-{{ $journal->id }}"></i>
                                <div class="like-score fs-5" id="like-score-{{ $journal->id }}">{{ $journal->like_score }}</div>
                            </div>
                            <i id="plus" class="button_plus fa-solid fa-circle-plus text-secondary fa-lg" onclick="incrementLikeScore({{ $journal->id }})"></i>
                        </div>

                        {{-- Comment Section --}}
                        <div class="d-flex">
                            <div class="d-inline my-2">
                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#comment-post-{{ $journal->id }}">
                                    <i class="fa-solid fa-pencil comment-icon"></i>
                                    <span class="comment-text">Comment</span>
                                </a>
                            </div>
                            @include('journals.contents.modals.comment')
                            <div class="ms-4 mt-3 w-75">
                                @foreach ($journal->comments as $comment)
                                <hr class="my-1">
                                <div class="text-muted">
                                        <span class="comment-create-date-text">{{ $comment->created_at }}</span>
                                    <div class="mb-3 fs-5">
                                        {{ $comment->body }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const allJournals = @json($all_journals);
        if (Array.isArray(allJournals.data) && allJournals.data.length > 0) {
            allJournals.data.forEach(journal => {

                updateLikeIconColor(journal.id, journal.like_score);

                // Focus the input when the modal is displayed
                $('#add-post').on('shown.bs.modal', function () {
                    $('#journal_body_add').trigger('focus');
                });
                $('#edit-post-' + journal.id).on('shown.bs.modal', function () {
                    $('#journal_body_edit_' + journal.id).trigger('focus');
                });
                $('#reply-post-' + journal.id).on('shown.bs.modal', function () {
                    $('#journal_reply_' + journal.id).trigger('focus');
                });
                $('#comment-post-' + journal.id).on('shown.bs.modal', function () {
                    $('#journal_comment_' + journal.id).trigger('focus');
                });
            });
        } else {
            console.error("allJournals is not an array or it's empty");
        }
    });

    function incrementLikeScore(id) {
        $.post('/journal/' + id + '/like', {
            _token: '{{ csrf_token() }}'
        }, function (data) {
            $('#like-score-' + id).text(data.like_score);
            updateLikeIconColor(id, data.like_score);
        });
    }

    function decrementLikeScore(id) {
        $.post('/journal/' + id + '/dislike', {
            _token: '{{ csrf_token() }}'
        }, function (data) {
            $('#like-score-' + id).text(data.like_score);
            updateLikeIconColor(id, data.like_score);
        });
    }

    // Change the icon color depending on whether the like score is positive or negative
    function updateLikeIconColor(journalId, likeScore) {
        const likeIcon = document.getElementById(`like-icon-${journalId}`);
        if (likeScore >= 0) {
            likeIcon.classList.remove('blue', 'pink');
            likeIcon.classList.add('pink');
        } else if (likeScore < 0) {
            likeIcon.classList.remove('blue', 'pink');
            likeIcon.classList.add('blue');
        } else {
            likeIcon.classList.remove('blue', 'pink');
            likeIcon.classList.add('pink');
        }
    }
</script>
@endsection

@section('scripts')
    <script src="{{ asset('js/journal.js') }}"></script>
@endsection
