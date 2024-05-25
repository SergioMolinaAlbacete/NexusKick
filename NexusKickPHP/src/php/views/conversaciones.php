<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chat en Vivo - NexusKick</title>
    <style>
        /* Estilos existentes */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }

        header {
            width: 100%;
            padding: 10px;
            background-color: #198754;
            color: white;
            text-align: center;
        }

        .conversations-container,
        .chat-container {
            width: 80%;
            max-width: 600px;
            margin-top: 20px;
        }

        .conversation {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            cursor: pointer;
        }

        .chat-container {
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
    <header>
        <button id="open-conversations">Mis Conversaciones</button>
    </header>
    <div class="conversations-container" id="conversations-container" style="display: none;">
        <!-- Aquí se cargan las conversaciones -->
    </div>
    <div class="chat-container" style="display: none;">
        <div class="chat-box" id="chat-box"></div>
        <div class="chat-input">
            <input type="text" id="message" placeholder="Escribe tu mensaje...">
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>
    <script src="js/chat.js"></script>
</body>

</html>