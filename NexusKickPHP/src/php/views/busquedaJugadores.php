<?php

include '../config/db.php';

// Recoger los datos del formulario
$pais = isset($_POST['pais']) ? $_POST['pais'] : '';
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
$altura = isset($_POST['altura']) ? $_POST['altura'] : '';
$pierna_buena = isset($_POST['pierna_buena']) ? $_POST['pierna_buena'] : '';
$posicion_habitual = isset($_POST['posicion_habitual']) ? $_POST['posicion_habitual'] : '';
$posicion_secundaria = isset($_POST['posicion_secundaria']) ? $_POST['posicion_secundaria'] : '';
$estilo_de_juego = isset($_POST['estilo_de_juego']) ? $_POST['estilo_de_juego'] : '';
$pases = isset($_POST['pases']) ? $_POST['pases'] : '1';
$tiros = isset($_POST['tiros']) ? $_POST['tiros'] : '1';
$velocidad = isset($_POST['velocidad']) ? $_POST['velocidad'] : '1';
$regate = isset($_POST['regate']) ? $_POST['regate'] : '1';
$defensa = isset($_POST['defensa']) ? $_POST['defensa'] : '1';

// Construir la consulta SQL básica
$sql = "SELECT * ,anuncios.usuario_id AS usuarioAnuncio
        FROM anuncios 
        JOIN usuarios ON anuncios.usuario_id = usuarios.id
        LEFT JOIN ficha_tecnica ON usuarios.id = ficha_tecnica.usuario_id
        WHERE usuarios.tipo_usuario = 'jugador'";

// Añadir filtros si están presentes
if ($pais != '') {
    $sql .= " AND usuarios.pais = '$pais'";
}
if ($ciudad != '') {
    $sql .= " AND usuarios.ciudad LIKE '%$ciudad%'";
}
if ($altura != '') {
    $sql .= " AND usuarios.altura >= $altura";
}
if ($pierna_buena != '') {
    $sql .= " AND usuarios.piernaBuena = '$pierna_buena'";
}
if ($posicion_habitual != '') {
    $sql .= " AND ficha_tecnica.posicion_habitual = '$posicion_habitual'";
}
if ($posicion_secundaria != '') {
    $sql .= " AND ficha_tecnica.posicion_secundaria = '$posicion_secundaria'";
}
if ($estilo_de_juego != '') {
    $sql .= " AND ficha_tecnica.estilo_de_juego = '$estilo_de_juego'";
}
if ($pases != '') {
    $sql .= " AND ficha_tecnica.pases >= $pases";
}
if ($tiros != '') {
    $sql .= " AND ficha_tecnica.tiros >= $tiros";
}
if ($velocidad != '') {
    $sql .= " AND ficha_tecnica.velocidad >= $velocidad";
}
if ($regate != '') {
    $sql .= " AND ficha_tecnica.regate >= $regate";
}
if ($defensa != '') {
    $sql .= " AND ficha_tecnica.defensa >= $defensa";
}

$sql .= " ORDER BY anuncios.fecha_publicacion DESC";

$result = $conn->query($sql);

$anuncios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $anuncios[] = $row;
    }
}

// Verificar el tipo de usuario
$tipo_usuario = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Anuncios Jugadores | NexusKick</title>
    <link rel="stylesheet" href="./../../css/header.css">
    <link rel="stylesheet" href="./../../css/general.css">
    <link rel="stylesheet" href="./../../css/Anuncio.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include './componentes/header.php'; ?>
    <div class="titulo-container">
        <h1>Búsqueda de Jugadores</h1>
        <?php if ($tipo_usuario === 'jugador'): ?>
            <button id="btnCrearAnuncio">Crear Anuncio</button>
        <?php endif; ?>
    </div>
    <div class="filtro-container">
        <h2 style="text-align: center;">Filtros</h2>
        <form id="filtro-form">
            <div class="filtro-seccion">
                <div class="filtro-item">
                    <label for="pais">País:</label>
                    <select id="pais" name="pais">
                        <?php include './componentes/desplegablePaises.php'; ?>
                    </select>
                </div>
                <div class="filtro-item">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($ciudad) ?>">
                </div>
            </div>

            <div class="filtro-seccion">
                <div class="filtro-item">
                    <label for="altura">Altura mínima (cm):</label>
                    <input type="number" id="altura" name="altura" min="100" max="250"
                        value="<?= htmlspecialchars($altura) ?>">
                </div>
                <div class="filtro-item">
                    <label for="pierna_buena">Pierna buena:</label>
                    <select id="pierna_buena" name="pierna_buena">
                        <option value="">Ninguna</option>
                        <option value="derecha" <?= $pierna_buena === 'derecha' ? 'selected' : '' ?>>Derecha</option>
                        <option value="izquierda" <?= $pierna_buena === 'izquierda' ? 'selected' : '' ?>>Izquierda</option>
                        <option value="ambas" <?= $pierna_buena === 'ambas' ? 'selected' : '' ?>>Ambas</option>
                    </select>
                </div>
                <div class="filtro-item">
                    <label for="posicion_habitual">Posición Habitual:</label>
                    <select id="posicion_habitual" name="posicion_habitual">
                        <option value="">Ninguna</option>
                        <option value="Portero" <?= $posicion_habitual === 'Portero' ? 'selected' : '' ?>>Portero</option>
                        <option value="Lateral Derecho" <?= $posicion_habitual === 'Lateral Derecho' ? 'selected' : '' ?>>
                            Lateral Derecho</option>
                        <option value="Lateral Izquierdo" <?= $posicion_habitual === 'Lateral Izquierdo' ? 'selected' : '' ?>>Lateral Izquierdo</option>
                        <option value="Central Derecho" <?= $posicion_habitual === 'Central Derecho' ? 'selected' : '' ?>>
                            Central Derecho</option>
                        <option value="Central Izquierdo" <?= $posicion_habitual === 'Central Izquierdo' ? 'selected' : '' ?>>Central Izquierdo</option>
                        <option value="Pivote Defensivo" <?= $posicion_habitual === 'Pivote Defensivo' ? 'selected' : '' ?>>Pivote Defensivo</option>
                        <option value="Centrocampista Derecho" <?= $posicion_habitual === 'Centrocampista Derecho' ? 'selected' : '' ?>>Centrocampista Derecho</option>
                        <option value="Centrocampista Izquierdo" <?= $posicion_habitual === 'Centrocampista Izquierdo' ? 'selected' : '' ?>>Centrocampista Izquierdo</option>
                        <option value="Centrocampista Central" <?= $posicion_habitual === 'Centrocampista Central' ? 'selected' : '' ?>>Centrocampista Central</option>
                        <option value="Mediapunta" <?= $posicion_habitual === 'Mediapunta' ? 'selected' : '' ?>>Mediapunta
                        </option>
                        <option value="Extremo Derecho" <?= $posicion_habitual === 'Extremo Derecho' ? 'selected' : '' ?>>
                            Extremo Derecho</option>
                        <option value="Extremo Izquierdo" <?= $posicion_habitual === 'Extremo Izquierdo' ? 'selected' : '' ?>>Extremo Izquierdo</option>
                        <option value="Delantero Centro" <?= $posicion_habitual === 'Delantero Centro' ? 'selected' : '' ?>>Delantero Centro</option>
                        <option value="Segundo Delantero" <?= $posicion_habitual === 'Segundo Delantero' ? 'selected' : '' ?>>Segundo Delantero</option>
                    </select>
                </div>
                <div class="filtro-item">
                    <label for="posicion_secundaria">Posición Secundaria:</label>
                    <select id="posicion_secundaria" name="posicion_secundaria">
                        <option value="">Ninguna</option>
                        <option value="Portero" <?= $posicion_secundaria === 'Portero' ? 'selected' : '' ?>>Portero
                        </option>
                        <option value="Lateral Derecho" <?= $posicion_secundaria === 'Lateral Derecho' ? 'selected' : '' ?>>Lateral Derecho</option>
                        <option value="Lateral Izquierdo" <?= $posicion_secundaria === 'Lateral Izquierdo' ? 'selected' : '' ?>>Lateral Izquierdo</option>
                        <option value="Central Derecho" <?= $posicion_secundaria === 'Central Derecho' ? 'selected' : '' ?>>Central Derecho</option>
                        <option value="Central Izquierdo" <?= $posicion_secundaria === 'Central Izquierdo' ? 'selected' : '' ?>>Central Izquierdo</option>
                        <option value="Pivote Defensivo" <?= $posicion_secundaria === 'Pivote Defensivo' ? 'selected' : '' ?>>Pivote Defensivo</option>
                        <option value="Centrocampista Derecho" <?= $posicion_secundaria === 'Centrocampista Derecho' ? 'selected' : '' ?>>Centrocampista Derecho</option>
                        <option value="Centrocampista Izquierdo" <?= $posicion_secundaria === 'Centrocampista Izquierdo' ? 'selected' : '' ?>>Centrocampista Izquierdo</option>
                        <option value="Centrocampista Central" <?= $posicion_secundaria === 'Centrocampista Central' ? 'selected' : '' ?>>Centrocampista Central</option>
                        <option value="Mediapunta" <?= $posicion_secundaria === 'Mediapunta' ? 'selected' : '' ?>>
                            Mediapunta</option>
                        <option value="Extremo Derecho" <?= $posicion_secundaria === 'Extremo Derecho' ? 'selected' : '' ?>>Extremo Derecho</option>
                        <option value="Extremo Izquierdo" <?= $posicion_secundaria === 'Extremo Izquierdo' ? 'selected' : '' ?>>Extremo Izquierdo</option>
                        <option value="Delantero Centro" <?= $posicion_secundaria === 'Delantero Centro' ? 'selected' : '' ?>>Delantero Centro</option>
                        <option value="Segundo Delantero" <?= $posicion_secundaria === 'Segundo Delantero' ? 'selected' : '' ?>>Segundo Delantero</option>
                    </select>
                </div>
                <div class="filtro-item">
                    <label for="estilo_de_juego">Estilo de Juego:</label>
                    <select id="estilo_de_juego" name="estilo_de_juego">
                        <option value="">Ninguna</option>
                        <option value="Defensivo" <?= $estilo_de_juego === 'Defensivo' ? 'selected' : '' ?>>Defensivo
                        </option>
                        <option value="Equilibrado" <?= $estilo_de_juego === 'Equilibrado' ? 'selected' : '' ?>>Equilibrado
                        </option>
                        <option value="Ofensivo" <?= $estilo_de_juego === 'Ofensivo' ? 'selected' : '' ?>>Ofensivo</option>
                    </select>
                </div>
            </div>

            <div class="filtro-seccion">
                <div class="filtro-item">
                    <label for="pases">Pases Mínimos:</label>
                    <input type="range" id="pases" name="pases" min="1" max="5" value="<?= htmlspecialchars($pases) ?>">
                    <span id="pases_value"><?= htmlspecialchars($pases) ?></span>
                </div>
                <div class="filtro-item">
                    <label for="tiros">Tiros Mínimos:</label>
                    <input type="range" id="tiros" name="tiros" min="1" max="5" value="<?= htmlspecialchars($tiros) ?>">
                    <span id="tiros_value"><?= htmlspecialchars($tiros) ?></span>
                </div>
                <div class="filtro-item">
                    <label for="velocidad">Velocidad Mínima:</label>
                    <input type="range" id="velocidad" name="velocidad" min="1" max="5"
                        value="<?= htmlspecialchars($velocidad) ?>">
                    <span id="velocidad_value"><?= htmlspecialchars($velocidad) ?></span>
                </div>
                <div class="filtro-item">
                    <label for="regate">Regate Mínimo:</label>
                    <input type="range" id="regate" name="regate" min="1" max="5"
                        value="<?= htmlspecialchars($regate) ?>">
                    <span id="regate_value"><?= htmlspecialchars($regate) ?></span>
                </div>
                <div class="filtro-item">
                    <label for="defensa">Defensa Mínima:</label>
                    <input type="range" id="defensa" name="defensa" min="1" max="5"
                        value="<?= htmlspecialchars($defensa) ?>">
                    <span id="defensa_value"><?= htmlspecialchars($defensa) ?></span>
                </div>
            </div>

            <div class="filtro-seccion">
                <button type="submit" class="primary-button">Filtrar</button>
            </div>
        </form>
    </div>

    <h2 id="resultados">Resultados de la búsqueda</h2>
    <div class='tablon'>
        <div class="card-container" id="result-container">
            <?php foreach ($anuncios as $anuncio): ?>
                <div class="anuncio-card">
                    <div class="perfil-info">
                        <img src="<?= !empty($anuncio['perfil_url']) ? $anuncio['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg' ?>"
                            alt="perfil" class="perfil-imagen">
                        <div class="info-texto">
                            <h2><?= $anuncio['nombre'] ?>     <?= $anuncio['apellidos'] ?></h2>
                            <p><?= $anuncio['edad'] ?> años - <?= $anuncio['ciudad'] ?></p>
                        </div>
                    </div>
                    <div class="anuncio-detalle">
                        <h3><?= $anuncio['titulo'] ?></h3>
                        <p><?= $anuncio['descripcion'] ?></p>
                    </div>
                    <div class="anuncio-botones">
                        <div class="button-borders">
                        <button class="primary-button" onclick="createConversation(<?= $usuario_logueado_id ?>, <?= $anuncio['usuario_id'] ?>)">Contactar</button>
                            <a href="./verPerfilJugador.php?id=<?= $anuncio['usuario_id'] ?>" class="primary-button">Ver
                                Perfil</a>
                        </div>
                    </div>
                    <p><?= $anuncio['fecha_publicacion'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal para crear anuncio -->
    <div id="modalCrearAnuncio" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="../controllers/crear_anuncio.php" method="POST">
                <h2>Crear Anuncio</h2>
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <input type="submit" value="Crear Anuncio">
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#filtro-form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: '../controllers/filtros_anuncios_jugador.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#result-container').html(response);
                    }
                });
            });

            $('input[type="range"]').on('input', function () {
                const id = $(this).attr('id');
                $(`#${id}_value`).text($(this).val());
            });

            // Modal logic
            var modal = document.getElementById("modalCrearAnuncio");
            var btn = document.getElementById("btnCrearAnuncio");
            var span = document.getElementsByClassName("close")[0];

            if (btn && modal && span) {
                btn.onclick = function () {
                    modal.style.display = "block";
                }

                span.onclick = function () {
                    modal.style.display = "none";
                }

                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            } else {
                console.error("Modal elements not found.");
            }
        });
    </script>

    <script>
        function createConversation(usuario1_id, usuario2_id) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controllers/crear_conversacion.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.conversacion_id) {
                        openConversation(response.conversacion_id);
                    } else {
                        console.error(response.error);
                    }
                }
            };
            xhr.send("usuario1_id=" + usuario1_id + "&usuario2_id=" + usuario2_id);
        }

        function openConversation(conversacionId) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../controllers/obtener_mensaje_conversacion.php?conversacion_id=" + conversacionId, true);
            xhr.onload = function () {
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
                    document.querySelector(".chat-container").dataset.conversacionId = conversacionId;
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
            xhr.open("POST", "../controllers/enviar_mensajes.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (this.status === 200) {
                    console.log(this.responseText);
                    document.getElementById("message").value = "";
                    openConversation(conversacionId); // Recargar los mensajes de la conversación actual
                }
            };
            xhr.send("mensaje=" + encodeURIComponent(message) + "&conversacion_id=" + conversacionId);
        }
    </script>
</body>

</html>