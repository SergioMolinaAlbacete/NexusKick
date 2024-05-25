document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("open-conversations").addEventListener("click", loadConversations);

    function loadConversations() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "php/obtenerConversaciones.php?usuario_id=1", true); // Ajusta el usuario_id dinámicamente
        xhr.onload = function() {
            if (this.status === 200) {
                const conversationsContainer = document.getElementById("conversations-container");
                conversationsContainer.innerHTML = "";
                const conversations = JSON.parse(this.responseText);
                conversations.forEach(conversation => {
                    const div = document.createElement("div");
                    div.classList.add("conversation");
                    div.textContent = conversation.usuario1_id == 1 ? conversation.usuario2 : conversation.usuario1; // Ajusta el usuario_id dinámicamente
                    div.dataset.conversacionId = conversation.id;
                    div.addEventListener("click", () => openConversation(conversation.id));
                    conversationsContainer.appendChild(div);
                });
                conversationsContainer.style.display = "block";
            }
        };
        xhr.send();
    }

    function openConversation(conversacionId) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "php/obtenerMensajes.php?conversacion_id=" + conversacionId, true);
        xhr.onload = function() {
            if (this.status === 200) {
                const chatBox = document.getElementById("chat-box");
                chatBox.innerHTML = "";
                const messages = JSON.parse(this.responseText);
                messages.forEach(message => {
                    const div = document.createElement("div");
                    div.innerHTML = `<strong>${message.de_usuario}:</strong> ${message.mensaje} <small>${message.fecha_envio}</small>`;
                    chatBox.appendChild(div);
                });
                chatBox.scrollTop = chatBox.scrollHeight;
                document.querySelector(".chat-container").style.display = "block";
            }
        };
        xhr.send();
    }

    document.querySelector(".chat-input button").addEventListener("click", sendMessage);

    function sendMessage() {
        const message = document.getElementById("message").value;
        if (message.trim() === "") return;

        const conversacionId = document.querySelector(".chat-container").dataset.conversacionId;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/sendMessage.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (this.status === 200) {
                console.log(this.responseText);
                document.getElementById("message").value = "";
                openConversation(conversacionId); // Recargar los mensajes de la conversación actual
            }
        };
        xhr.send("mensaje=" + encodeURIComponent(message) + "&conversacion_id=" + conversacionId);
    }
});
