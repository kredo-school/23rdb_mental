<link rel="stylesheet" href="{{ asset('css/chats.css') }}">
<link rel="stylesheet" href="{{ asset('css/chatroom.css') }}">

@extends('layouts.app')
@extends('components.navbar-each')
@section('title', 'Chat')

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
            <div class="chat-body col-10 py-2 chats-body-size w-75">
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

                <div class="chat-background">
                {{-- My User and Search Section --}}
                <div class="d-flex mb-3 p-2 shadow align-items-center">
                    {{-- User Icon --}}
                    @if (Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="avatar" class="rounded-circle avatar">
                    @else
                        <i class="fa-solid fa-circle-user avatar fa-2x me-3"></i>
                    @endif
                    {{-- User Name --}}
                    <span class="fw-bold me-2">
                        @if (auth()->user()->username)
                            {{ auth()->user()->username }}
                        @else
                            {{ auth()->user()->name }}
                        @endif
                    </span>
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-username-{{ auth()->user()->id }}">
                        <i class="fa-solid fa-pen-to-square edit-icon"></i>
                    </a>
                    @include('chat.contents.modals.edit_username')
                    {{-- <form action="{{ route('chat.chats', $currentRoom->id) }}" method="get" class="chat-form"> --}}
                    {{-- Search keyword --}}
                    <form action="{{ route('chat.chats', $currentRoom->id) }}" method="get" class="mb-0">
                        <div class="search_box ms-5">
                            @csrf
                            <input type="text" name="search" placeholder="search..." class="chats-search-component chats-search-keyword form-control shadow chat-other-btn ms-4" value="">
                            {{-- <button type="submit">
                                <i class="fa-solid fa-search chat-other-btn"></i>
                            </button> --}}
                        </div> 
                    </form>



                        {{-- <div class="chat-form-search">
                            <input type="text" id="search" name="search" placeholder="search keyword" class="chat-search-input form-control" value="">
                            <button type="submit" class="btn bg-none btn-outline-secondary btn-lg">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </div> --}}
                        {{-- value ={{ $search }} --}}
                        {{-- @if ($search)
                            <p class="text-muted mb-4 small">Search results for '<span class="fw-bold">{{ $search }}</span>'</p>
                        @endif --}}

                    {{-- </form> --}}
                </div>

                {{-- Chats Section --}}
                <div id="chat-messages" class="chat-messages">
                    @foreach ($chats as $chat)
                        <div id="chat-message" class="chat-message {{ $chat->user_id == auth()->id() ? 'my-message' : 'other-message' }}">
                            {{-- User avatar and name (only other's chat) --}}
                            <div class="chat-content">
                                @if ($chat->user_id != auth()->id())
                                <div class="chat-user">
                                    {{-- avatar --}}
                                    @if ($chat->user->avatar)
                                        <img src="{{ $chat->user->avatar }}" alt="avatar" class="rounded-circle avatar">
                                    @else
                                        <i class="fa-solid fa-circle-user avatar fa-2x me-1"></i>
                                    @endif
                                    {{-- username --}}
                                    @if ($chat->user->username)
                                        <span class="me-1">{{ $chat->user->username }}</span>
                                    @else
                                        <span class="me-1">{{ $chat->user->name }}</span>
                                    @endif
                                </div>
                                @endif
                            </div>
                            {{-- Chat Body --}}
                            <div class="bubble">
                                {{-- Reply Body --}}
                                @if ($chat->chats_include_replying_chat)
                                    <div class="text-muted">
                                            <span class="fs-6">{{ $chat->chats_include_replying_chat->created_at }}</span>
                                        <div class="mb-3 fs-6">
                                            {{ $chat->chats_include_replying_chat->body }}
                                        </div>
                                        <hr>
                                    </div>
                                @endif
                                {{-- Body --}}
                                <p>{{ $chat->body }}</p>
                            </div>
                            {{-- Chat Info --}}
                            <div class="message-info-area">
                                {{-- Reply Link--}}
                                <div class="d-flex flex-wrap">
                                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#reply-post-{{ $chat->id }}">
                                        <i class="fa-solid fa-reply reply-icon"></i>
                                        <span class="reply-text">Reply</span>
                                    </a>
                                    @include('chat.contents.modals.reply')
                                </div>
                                {{-- Chat DateTime --}}
                                <div class="message-time">{{ $chat->created_at->format('m/d H:i') }}</div>
                                {{-- Chat Icons --}}
                                <div class="chat-icons-area d-flex">
                                    @if ($chat->user_id == auth()->id())
                                        <div class="d-flex flex-wrap">
                                            {{-- Edit (only my chat) --}}
                                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-post-{{ $chat->id }}">
                                                <i class="fa-regular fa-pen-to-square edit-icon icon-sm"></i>
                                            </a>
                                            @include('chat.contents.modals.edit')
                                            {{-- Delete (only my chat) --}}
                                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $chat->id }}">
                                                <i class="fa-regular fa-trash-can delete-icon icon-sm"></i>
                                            </a>
                                            @include('chat.contents.modals.delete')
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        
                <form action="{{ route('chat.store', $currentRoom->id) }}" method="post" id="chat-form" class="chat-input">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">  <!-- 現在のユーザーIDを送信 -->
                        <input type="text" id="body" name="body" placeholder="message">
                        <button type="submit" id="submit" onclick="sendMessage()">send</button>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection

@section('scripts')
<!-- PusherのJavaScriptライブラリをCDN経由で読み込む -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>

    //  Pusher.logToConsole = true;

    var pusherTest = new Pusher('fc62cca74c438dde1c80', {
        cluster: 'ap3'
    });

    var channelTest = pusherTest.subscribe('chat-room-{{ $currentRoom->id }}');
    channelTest.bind('new-message', function(data) {
        // alert(JSON.stringify(data));
        console.log(data);
        const chatMessages = document.getElementById('chat-messages');
        var newMessage = ``;
        newMessage += `<div id="chat-message" class="chat-message {{ $chat->user_id == auth()->id() ? 'my-message' : 'other-message' }}">`;
        newMessage += `    {{-- User avatar and name (only other's chat) --}}`;
        newMessage += `    <div class="chat-content">`;
        newMessage += `        @if ($chat->user_id != auth()->id())`;
        newMessage += `        <div class="chat-user">`;
        newMessage += `            {{-- avatar --}}`;
        newMessage += `            @if ($chat->user->avatar)`;
        newMessage += `                <img src="{{ $chat->user->avatar }}" alt="avatar" class="rounded-circle avatar">`;
        newMessage += `            @else`;
        newMessage += `                <i class="fa-solid fa-circle-user avatar fa-2x me-1"></i>`;
        newMessage += `            @endif`;
        newMessage += `            {{-- username --}}`;
        newMessage += `            @if ($chat->user->username)`;
        newMessage += `                <span class="me-1">${data.username}</span>`;
        newMessage += `            @else`;
        newMessage += `                <span class="me-1">${data.name}</span>`;
        newMessage += `            @endif`;
        newMessage += `        </div>`;
        newMessage += `        @endif`;
        newMessage += `    </div>`;
        newMessage += `    {{-- Chat Body --}}`;
        newMessage += `    <div class="bubble">`;
        newMessage += `        {{-- Reply Body --}}`;
        newMessage += `        @if ($chat->chats_include_replying_chat)`;
        newMessage += `            <div class="text-muted">`;
        newMessage += `                    <span class="fs-6">{{ $chat->chats_include_replying_chat->created_at }}</span>`;
        newMessage += `                <div class="mb-3 fs-6">`;
        newMessage += `                    {{ $chat->chats_include_replying_chat->body }}`;
        newMessage += `                </div>`;
        newMessage += `                <hr>`;
        newMessage += `            </div>`;
        newMessage += `        @endif`;
        newMessage += `        {{-- Body --}}`;
        newMessage += `        <p>${data.message}</p>`;
        newMessage += `    </div>`;
        newMessage += `    {{-- Chat Info --}}`;
        newMessage += `    <div class="message-info-area">`;
        newMessage += `        {{-- Reply Link--}}`;
        newMessage += `        <div class="d-flex flex-wrap">`;
        newMessage += `            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#reply-post-${data.id}">`;
        newMessage += `                <i class="fa-solid fa-reply reply-icon"></i>`;
        newMessage += `                <span class="reply-text">Reply</span>`;
        newMessage += `            </a>`;
        newMessage += `            @include('chat.contents.modals.reply')`;
        newMessage += `        </div>`;
        newMessage += `        {{-- Chat DateTime --}}`;
        newMessage += `        <div class="message-time">{{ $chat->created_at->format('m/d H:i') }}</div>`;
        newMessage += `        {{-- Chat Icons --}}`;
        newMessage += `        <div class="chat-icons-area d-flex">`;
        newMessage += `            @if ($chat->user_id == auth()->id())`;
        newMessage += `                <div class="d-flex flex-wrap">`;
        newMessage += `                    {{-- Edit (only my chat) --}}`;
        newMessage += `                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-post-${data.id}">`;
        newMessage += `                        <i class="fa-regular fa-pen-to-square edit-icon icon-sm"></i>`;
        newMessage += `                    </a>`;
        newMessage += `                    @include('chat.contents.modals.edit')`;
        newMessage += `                    {{-- Delete (only my chat) --}}`;
        newMessage += `                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#delete-post-${data.id}">`;
        newMessage += `                        <i class="fa-regular fa-trash-can delete-icon icon-sm"></i>`;
        newMessage += `                    </a>`;
        newMessage += `                    @include('chat.contents.modals.delete')`;
        newMessage += `                </div>`;
        newMessage += `            @endif`;
        newMessage += `        </div>`;
        newMessage += `    </div>`;
        newMessage += `</div>`;
        chatMessages.insertAdjacentHTML('beforeend', newMessage);
                
        // メッセージが追加されたらスクロール
        scrollToBottom();
    });




    document.addEventListener('DOMContentLoaded', function() {
        // alert('Page has loaded');
        scrollToBottom();
    });

    function scrollToBottom() {
        var chatMessages = document.getElementById('chat-messages');
        console.log(chatMessages.scrollHeight); // 要素のスクロール全体の高さ
        console.log(chatMessages.clientHeight); // 要素の表示部分の高さ
        console.log(chatMessages.scrollTop);    // 現在のスクロール位置

        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }

    // 初期表示でスクロールを一番下にする
    // window.onload = function() {
    //     console.log('Window has loaded');
    //     scrollToBottom();
    // };

    // document.addEventListener('DOMContentLoaded', function () {
    //     alert('Page has loaded 2');
    //     console.log('Page fully loaded');
    //     setTimeout(scrollToBottom, 100);
    // });
    // document.addEventListener('DOMContentLoaded', function () {
    //     console.log('Page fully loaded');
    //     setTimeout(scrollToBottom, 500);
    // });

    var sendBtn = document.getElementById('send-btn');
    sendBtn.addEventListener('click', function() {
        // メッセージ送信後にスクロールを実行
        console.log('Scrolling to bottom...');
        scrollToBottom();
        console.log('scrollTop:', chatMessages.scrollTop);
    });

    // echo({{ env('PUSHER_APP_KEY') }});
    // Pusherのインスタンスを作成
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });

    console.log('Pusher instance created:', pusher);

    // チャネルのサブスクライブ
    const channel = pusher.subscribe('chat-room-{{ $currentRoom->id }}');

    // 新しいメッセージが送信されたときのイベントをリッスン
    channel.bind('new-message', function(data) {
        console.log('Received message:', data); // デバッグ用にデータを確認
        alert('new-message');
        // メッセージを画面に表示
        const chatMessages = document.getElementById('chat-messages');
        const newMessage = `<div class="chat-message"><strong>${data.username}:</strong><p>${data.message}</p></div>`;
        chatMessages.insertAdjacentHTML('beforeend', newMessage);
                
        // メッセージが追加されたらスクロール
        scrollToBottom();
    });

    pusher.connection.bind('state_change', function(states) {
        console.log('Pusher state changed:', states);
    });

    pusher.connection.bind('error', function(err) {
    if (err.error.data.code === 4004) {
        console.error('Over limit: Your plan might have exceeded the allowed concurrent connections.');
    } else {
        console.error('Pusher error:', err);
    }
});

    // メッセージ送信処理
        // function sendMessage() {

    document.getElementById('chat-form').addEventListener('submit', function(e) {

        alert('submit clicked');
        e.preventDefault();



        const user_id = document.getElementById('user_id').value;
        const body = document.getElementById('body').value;

        if (body === "") {
            alert("Please enter a message.");
            return;
        }

        console.log('test console');
        alert("test");

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
