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
    <div class="mt-4" style="margin-left:200px;">
        <div class="w-75 mx-auto">

            {{-- Add journal --}}
            <div class="input-group mb-3" data-bs-toggle="modal" data-bs-target="#add-post">
                {{-- User Icon --}}
                @if (Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="avatar" class="avatar-sm rounded-circle icon-sm img-fluid">
                @else
                    <i class="fa-solid fa-circle-user avatar icon-sm"></i>
                @endif
                <input type="text" name="journal_body" id="journal_body" class="form-control rounded-input shadow"
                    placeholder="What's on your mind?" value="" style="border-radius: 25px;">
            </div>
            @include('journals.contents.modals.add')

            {{-- Search Section --}}
            <div class="card input-group mb-3 p-2 shadow">
                <form action="{{ route('journal.journals') }}" method="get" style="margin-bottom: 0px;">
                    {{-- Sort --}}
                    <span class="text-primary">Sort</span>
                    <select name="sort" id="sort" class="form-control" onchange="this.form.submit()" style="display: inline; width: 150px;">
                        <option value="date" {{ request('sort') === 'name' ? 'selected' : '' }}>Sorted by Date
                        </option>
                        <option value="like_score" {{ request('sort') === 'like_score' ? 'selected' : '' }}>Sorted by LikeScore
                        </option>
                    </select>
                    {{-- Search date --}}
                    <span class="text-primary me-3" style="display: inline; width: 100px; margin-left: 50px;">Search</span>
                    <input type="date" name="search_date_start" class="form-control search-date" value="{{ $search_date_start }}" style="display: inline; width: 150px;">
                    ～
                    <input type="date" name="search_date_end" class="form-control search-date" value="{{ $search_date_end }}" style="display: inline; width: 150px;">
                    {{-- Search keyword --}}
                    <input type="text" name="search" placeholder="search..." class="form-control" value="{{ $search }}" style="display: inline; width: 150px;">
                    {{-- @if ($search)
                        <p class="text-muted mb-4 small">Search results for '<span class="fw-bold">{{ $search }}</span>'</p>
                    @endif --}}
                    <button type="submit" class="btn bg-none btn-outline-secondary btn-lg">
                        <i class="fa-solid fa-search"></i>
                      </button>
                </form>
            </div>

            {{-- Journal Contents Section --}}
            @forelse ($all_journals as $journal)
                <div class="card mb-3 shadow">
                    <div class="card-body">
                        {{-- Reply Body --}}
                        @if ($journal->journals_include_replying_journal)
                        <div class="text-muted">
                                <span style="font-size: 16px;">{{ $journal->journals_include_replying_journal->created_at }}</span>
                            <div class="mb-3 fs-5">
                                {{ $journal->journals_include_replying_journal->body }}
                            </div>
                            <hr>
                        </div>
                        @endif
                        
                        {{-- Date, Edit and Delete --}}
                        <div class="text-start">
                            {{-- Date --}}
                            <span style="font-size: 16px;">{{ $journal->created_at }}</span>
                            {{-- Delete --}}
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $journal->id }}">
                                <i class="fa-solid fa-trash-can text-danger icon-sm d-inline float-end"></i>
                            </a>
                            @include('journals.contents.modals.delete')
                            {{-- Edit --}}
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-post-{{ $journal->id }}">
                                <i class="fa-solid fa-pen-to-square text-primary icon-sm d-inline float-end me-2"></i>
                            </a>
                            @include('journals.contents.modals.edit')
                        </div>
                        {{-- Reply Link--}}
                        <div class="float-end">
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#reply-post-{{ $journal->id }}">
                                <i class="fa-solid fa-reply text-primary icon-sm"></i>
                                <span class="text-primary fw-bold">Reply</span>
                            </a>
                        </div>
                        @include('journals.contents.modals.reply')
                        {{-- Body --}}
                        <div class="mb-3 fs-4">
                            {{ $journal->body }}
                        </div>
                        {{-- Like Score --}}
                        <div>
                            <div>
                                <i id="minus" class="button_minus fa-solid fa-circle-minus text-secondary fa-lg" onclick="decrementLikeScore({{ $journal->id }})" style="cursor: pointer;"></i>
                                <div class="like-container">
                                    <i class="like-icon fas fa-heart fa-2x" id="like-icon-{{ $journal->id }}"></i>
                                    <div class="like-score fs-5" id="like-score-{{ $journal->id }}">{{ $journal->like_score }}</div>
                                </div>
                                <i id="plus" class="button_plus fa-solid fa-circle-plus text-secondary fa-lg" onclick="incrementLikeScore({{ $journal->id }})" tyle="cursor: pointer;"></i>
                            </div>
                        </div>

                        {{-- Comment Section --}}
                        <div class="d-inline">
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#comment-post-{{ $journal->id }}">
                                <i class="fa-solid fa-pencil text-primary icon-sm"></i>
                                <span class="text-primary fw-bold">Comment</span>
                            </a>
                        </div>
                        @include('journals.contents.modals.comment')
                        <div>
                            @foreach ($journal->comments as $comment)
                                <div class="card mt-2">
                                    <div class="card-body">
                                        {{ $comment->body }}
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
