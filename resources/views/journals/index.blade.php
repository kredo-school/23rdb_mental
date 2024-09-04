<link rel="stylesheet" href="{{ asset('css/journal.css') }}">
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

{{--
<div class="container-mood my-5 py-3">
    <div class="d-flex mb-3 input-size">
--}}

<div>
    <div class="mt-4" style="margin-left:200px;">
        <div class="w-75 mx-auto">

            {{-- Add journal --}}
            <div class="input-group mb-3" data-bs-toggle="modal" data-bs-target="#add-post">
                <i class="fa-solid fa-circle-user fa-3x me-3 avatar"></i>
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
                            <div class="mb-3 fs-4">
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
                        <div class="mb-3 fs-3">
                            {{ $journal->body }}
                        </div>
                        {{-- Like Score --}}
                        <div>
                            <div>
                                <i id="minus" class="button_minus fa-solid fa-circle-minus text-secondary fa-2x" onclick="decrementLikeScore({{ $journal->id }})" style="cursor: pointer;"></i>
                                <div class="like-container">
                                    <i class="like-icon fas fa-heart text-danger fa-2x"></i>
                                    <div class="like-score" id="like-score-{{ $journal->id }}">{{ $journal->like_score }}</div>
                                </div>
                                <i id="plus" class="button_plus fa-solid fa-circle-plus text-secondary fa-2x" onclick="incrementLikeScore({{ $journal->id }})" tyle="cursor: pointer;"></i>
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
                                <div class="card mt-2" style="border: none;">
                                    <div class="card-body">
                                        <div class="mb-3 fs-5">
                                            {{ $comment->body }}
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




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script>
// function incrementLikeScore(id) {
//     $.post('/journal/' + id + '/like', {
//         _token: '{{ csrf_token() }}'
//     }, function (data) {
//         $('#like-score-' + id).text(data.like_score);
//     });
// }

function incrementLikeScore(id) {
            $.post('/journal/' + id + '/like', {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                $('#like-score-' + id).text(data.like_score);
            });
        }


function decrementLikeScore(id) {
            $.post('/journal/' + id + '/dislike', {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                $('#like-score-' + id).text(data.like_score);
            });
        }
</script>


{{-- 
<script>
    function plusLikeScore(id) {
        document.getElementById('likeScore' + id).value++;
    }
    function minusLikeScore(id) {
        document.getElementById('likeScore' + id).value--;
    }

    let like = $('.button_plus'); //button_plusのついたiタグを取得し代入。
    let journal_id;
    like.on('click', function () {
      let $this = like; //this=イベントの発火した要素＝iタグを代入
    //   journal_id = $this.data('journal_id'); //iタグに仕込んだdata-review-idの値を取得
      journal_id = 3; //iタグに仕込んだdata-review-idの値を取得

      alert(journal_id);
      // いいね数を1増やす
    //   $this.next('.like-counter').html(parseInt($this.next('.like-counter').html()) + 1);

      //ajax処理スタート
      $.ajax({
        headers: {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        url: '/journal/like_plus_one',
        method: 'POST',
        data: {
          'journal_id': journal_id //いいねされた投稿のidを送る
        },
      })
      //成功した時の処理
      .done(function (data) {
        alert("success!");
        // 返却されたカウント後のいいね数を表示
        $this.next('.like-counter').html(data.likes_count);
      })
      //失敗した時の処理
      .fail(function () {
        alert("fail!");
        console.log('err');
      });
    });
</script> --}}

@endsection

@section('scripts')
    <script src="{{ asset('js/journal.js') }}"></script>
@endsection
