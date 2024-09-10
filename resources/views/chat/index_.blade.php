<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="messages"></div>
    <input type="text" id="message-input">
    <button onclick="sendMessage()">Send</button>

    <script>
        // Echoインスタンスの初期化
        const Echo = new Echo({
            broadcaster: 'pusher',
            key: 'fc62cca74c438dde1c80',
            cluster: 'ap3',
            forceTLS: true,
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
        });

        // メッセージを受信して画面に表示
        Echo.join(`chat.${roomId}`)
            .listen('MessageSent', (e) => {
                const messageElement = document.createElement('p');
                messageElement.innerText = `${e.message.user.name}: ${e.message.content}`;
                document.getElementById('messages').appendChild(messageElement);
            });

        function sendMessage() {
            const message = document.getElementById('message-input').value;

            axios.post(`/chat/${roomId}/message`, { message })
                .then(response => {
                    document.getElementById('message-input').value = '';
                });
        }
    </script>
</body>
</html>
