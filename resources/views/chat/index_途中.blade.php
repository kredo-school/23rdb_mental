<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャットルーム</title>
    <style>
        /* CSS */
        .chat-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .chat-message {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .message-content {
            max-width: 70%;
            padding: 10px;
            border-radius: 15px;
            position: relative;
        }
        .my-message {
            justify-content: flex-end;
        }
        .my-message .message-content {
            background-color: #DCF8C6;
        }
        .other-message .message-content {
            background-color: #FFF;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .time {
            font-size: 0.75em;
            color: #999;
        }
        .icons {
            margin-left: 10px;
            font-size: 0.8em;
        }
    </style>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<body>
    <div class="chat-container">
        @foreach ($chats as $chat)
            <div class="chat-message {{ $chat->user_id === auth()->id() ? 'my-message' : 'other-message' }}">
                <img src="{{ $chat->user->avatar }}" alt="avatar" class="avatar">
                <div class="message-content">
                    <p>{{ $chat->body }}</p>
                    <div class="time">{{ $chat->created_at }}</div>
                    <div class="icons">
                        <span>📝</span>
                        <span>🗑</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <input type="hidden" id="chat_room_id" value="{{ $currentRoom->id }}">
    <input type="text" id="message" placeholder="メッセージを入力">
    <button id="send">送信</button>

    <script>
        // Pusherの設定
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            encrypted: true
        });

        const channel = pusher.subscribe('chat');
        channel.bind('message-sent', function(data) {
            // メッセージが届いたらリアルタイムで画面に追加
            const messageContainer = document.querySelector('.chat-container');
            const newMessage = `<div class="chat-message other-message">
                <img src="${data.user.avatar}" alt="avatar" class="avatar">
                <div class="message-content">
                    <p>${data.body}</p>
                    <div class="time">${data.created_at}</div>
                    <div class="icons">
                        <span>📝</span>
                        <span>🗑</span>
                    </div>
                </div>
            </div>`;
            messageContainer.insertAdjacentHTML('beforeend', newMessage);
        });

        // 送信ボタンの処理
        document.getElementById('send').addEventListener('click', function() {
            const message = document.getElementById('message').value;
            const chatRoomId = document.getElementById('chat_room_id').value;

            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    chat_room_id: chatRoomId,
                    message: message
                })
            }).then(response => response.json())
              .then(data => {
                // メッセージ送信成功時
                console.log(data);
            });
        });
    </script>
</body>
</html>
