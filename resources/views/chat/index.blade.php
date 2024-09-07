<link rel="stylesheet" href="{{ asset('css/chats.css') }}">
<link rel="stylesheet" href="{{ asset('css/chatroom.css') }}">

@extends('layouts.app')
@extends('components.navbar-each')
@section('title', 'Journal')

@section('content')
@if(Auth::user()->role_id == 1)
    @include('components.sidebar-admin')
@else
    @include('components.sidebar')
@endif
{{--@extends('layouts.app')--}}

@section('title', 'Admin: Chats')

@section('content')

<body class="">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10 py-2 chats-body-size w-75" style="margin-left:200px;">
                {{-- Chat Rooms --}}
                <div class="row px-5 mb-2">
                    <div class="col-2 p-1">
                        <a href="{{ url('/chat/1') }}" class="btn btn-relationship w-100 {{ request()->is('chat/1') ? 'active-room' : 'inactive-room' }}">Relationship</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="{{ url('/chat/2') }}" class="btn btn-career w-100 {{ request()->is('chat/2') ? 'active-room' : 'inactive-room' }}">Career</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="{{ url('/chat/3') }}" class="btn btn-family w-100 {{ request()->is('chat/3') ? 'active-room' : 'inactive-room' }}">Family</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="{{ url('/chat/4') }}" class="btn btn-health w-100 {{ request()->is('chat/4') ? 'active-room' : 'inactive-room' }}">Health</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="{{ url('/chat/5') }}" class="btn btn-finance w-100 {{ request()->is('chat/5') ? 'active-room' : 'inactive-room' }}">Finance</a>
                    </div>
                    <div class="col-2 p-1">
                        <a href="{{ url('/chat/6') }}" class="btn btn-others w-100 {{ request()->is('chat/6') ? 'active-room' : 'inactive-room' }}">Others</a>
                    </div>
                    {{--
                    <h1>{{ $currentRoom->name }}</h1>
                    <div class="chat-room-links">
                        @foreach($chatRooms as $room)
                            <a href="{{ url('/chat/' . $room->id) }}">{{ $room->name }}</a>
                        @endforeach
                    </div>
                    --}}
                </div>

                <div style="background-color: aliceblue;">
                {{-- My User and Search Section --}}
                <div class="card input-group mb-3 p-2 shadow">
                    <form action="{{ route('chat.chats', $currentRoom->id) }}" method="get" style="margin-bottom: 0px;">
                        {{-- User Icon and User Name --}}
                        <i class="fa-solid fa-circle-user fa-2x me-3 avatar"></i>
                        <span>{{ auth()->user()->username }}</span>
                        <i class="fa-solid fa-pen-to-square text-primary icon-sm d-inline me-2"></i>
                        {{-- Search keyword --}}
                        <div style="float: right;">
                            <input type="text" name="search" placeholder="search keyword" class="form-control" value="" style="display: inline; width: 300px;">
                            <button type="submit" class="btn bg-none btn-outline-secondary btn-lg">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </div>
                        {{-- value ={{ $search }} --}}
                        {{-- @if ($search)
                            <p class="text-muted mb-4 small">Search results for '<span class="fw-bold">{{ $search }}</span>'</p>
                        @endif --}}
                    </form>
                </div>

                {{-- Chats Section --}}
                <div id="chat-messages" class="chat-messages">
                    @foreach ($chats as $chat)
                        <div class="chat-message {{ $chat->user_id == auth()->id() ? 'my-message' : 'other-message' }}">
                            <div class="chat-icons">
                                <i class="fa-solid fa-pen-to-square text-primary icon-sm d-inline me-2"></i>
                                <i class="fa-solid fa-trash-can text-danger icon-sm d-inline"></i>
                            </div>
                            <div class="chat-content">
                                @if ($chat->user_id != auth()->id())
                                <div style="display: block;">
                                    <img src="{{ $chat->user->avatar_url }}" alt="Avatar" class="avatar">
                                    {{ $chat->user->username }}
                                </div>
                                @endif
                                <div class="bubble">
                                    <p>{{ $chat->body }}</p>
                                </div>
                                <div class="message-info">
                                    <span class="message-time">{{ $chat->created_at }}</span>
                                    <span class="reply-icon">↩</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        
                <form action="{{ route('chat.store', $currentRoom->id) }}" method="post" id="chat-form" class="chat-input">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">  <!-- 現在のユーザーIDを送信 -->
                        <input type="text" id="body" name="body" placeholder="メッセージを入力">
                        <button type="submit" id="submit">送信</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection

@section('scripts')
<!-- PusherのJavaScriptライブラリをCDN経由で読み込む -->
<script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>

<script>
    function scrollToBottom() {
        var chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(scrollToBottom, 100);
    });

    var sendBtn = document.getElementById('send-btn');
    sendBtn.addEventListener('click', function() {
        // メッセージ送信後にスクロールを実行
        scrollToBottom();
    });
</script>

<script>
    // echo({{ env('PUSHER_APP_KEY') }});
    // Pusherのインスタンスを作成
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });

    // チャネルのサブスクライブ
    const channel = pusher.subscribe('chat-room-{{ $currentRoom->id }}');

    // 新しいメッセージが送信されたときのイベントをリッスン
    channel.bind('new-message', function(data) {
        // メッセージを画面に表示
        const chatMessages = document.getElementById('chat-messages');
        const newMessage = `<div class="chat-message"><strong>${data.username}:</strong><p>${data.message}</p></div>`;
        chatMessages.insertAdjacentHTML('beforeend', newMessage);
    });

    // メッセージ送信処理
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const user_id = document.getElementById('user_id').value;
        const body = document.getElementById('body').value;

        if (body === "") {
            alert("メッセージを入力してください");
            return;
        }

        fetch(`/chat/{{ $currentRoom->id }}/send`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ user_id: user_id, body: body })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                console.log('Success:', data);
                // Clear the input field after sending the message
                document.getElementById('body').value = '';

                const chatMessages = document.getElementById('chat-messages');
                const newMessage = `<div class="chat-message my-message">
                                        <div class="bubble">
                                            <p>${body}</p>
                                        </div>
                                        <div class="message-info">
                                            <span class="message-time">${new Date().toLocaleTimeString()}</span>
                                            <span class="reply-icon">↩</span>
                                        </div>
                                        </div>`;
                chatMessages.insertAdjacentHTML('beforeend', newMessage);

                // Scroll to the bottom 
                // scrollToBottom();
            } else {
                console.error('Error:', data.error);
                alert('Failed to send message.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('An error occurred while sending the message.');
        });
    });
</script>
@endsection
