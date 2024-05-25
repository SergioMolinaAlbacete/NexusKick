<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chat en Vivo - NexusKick</title>
    <style>
        .chat-container {
            width: 80%;
            max-width: 600px;
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .chat-box {
            flex: 1;
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            overflow-y: scroll;
            height: 400px;
        }

        .chat-input {
            display: flex;
        }

        .chat-input input {
            flex: 1;
            padding: 10px;
            border: none;
            border-top: 1px solid #dee2e6;
            border-bottom-left-radius: 5px;
            outline: none;
        }

        .chat-input button {
            background-color: #198754;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-bottom-right-radius: 5px;
        }

        .chat-input button:hover {
            background-color: #157a47;
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-box" id="chat-box"></div>
        <div class="chat-input">
            <input type="text" id="message" placeholder="Escribe tu mensaje...">
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>
    <script src="../controllers/chat.js"></script>
</body>

</html>