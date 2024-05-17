<?php
include '../config/db.php';

// Recoger los datos del formulario (para la primera carga de la página)
$pais = isset($_GET['pais']) ? $_GET['pais'] : '';
$ciudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';
$altura = isset($_GET['altura']) ? $_GET['altura'] : '';
$pierna_buena = isset($_GET['pierna_buena']) ? $_GET['pierna_buena'] : '';
$posicion_habitual = isset($_GET['posicion_habitual']) ? $_GET['posicion_habitual'] : '';
$posicion_secundaria = isset($_GET['posicion_secundaria']) ? $_GET['posicion_secundaria'] : '';
$estilo_de_juego = isset($_GET['estilo_de_juego']) ? $_GET['estilo_de_juego'] : '';
$pases = isset($_GET['pases']) ? $_GET['pases'] : '';
$tiros = isset($_GET['tiros']) ? $_GET['tiros'] : '';
$velocidad = isset($_GET['velocidad']) ? $_GET['velocidad'] : '';
$regate = isset($_GET['regate']) ? $_GET['regate'] : '';
$defensa = isset($_GET['defensa']) ? $_GET['defensa'] : '';

// Construir la consulta SQL básica
$sql = "SELECT * 
        FROM anuncios 
        JOIN usuarios ON anuncios.usuario_id = usuarios.id
        JOIN ficha_tecnica ON usuarios.id = ficha_tecnica.usuario_id
        WHERE usuarios.tipo_usuario = 'jugador'";

// Añadir filtros si están presentes (para la primera carga de la página)
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
    $sql .= " AND ficha_tecnica.pases = '$pases'";
}
if ($tiros != '') {
    $sql .= " AND ficha_tecnica.tiros = '$tiros'";
}
if ($velocidad != '') {
    $sql .= " AND ficha_tecnica.velocidad = '$velocidad'";
}
if ($regate != '') {
    $sql .= " AND ficha_tecnica.regate = '$regate'";
}
if ($defensa != '') {
    $sql .= " AND ficha_tecnica.defensa = '$defensa'";
}

$sql .= " ORDER BY anuncios.fecha_publicacion DESC";

$result = $conn->query($sql);

$anuncios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $anuncios[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Anuncios Jugadores | NexusKick</title>
    <link rel="stylesheet" href="./../../css/general.css">
    <link rel="stylesheet" href="./../../css/Anuncio.css">
    <link rel="stylesheet" href="./../../css/header.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include './componentes/header.php'; ?>
    <div class="titulo-container">
        <h1>Búsqueda Jugadores</h1>
        <button id="btnCrearAnuncio">Crear Anuncio</button>
    </div>
    <div class="filtro-container">
        <form id="filtro-form">
            <label for="pais">País:</label>
            <select id="pais" name="pais">
                <?php include './componentes/desplegablePaises.php'; ?>
            </select>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($ciudad) ?>">

            <label for="altura">Altura mínima (cm):</label>
            <input type="number" id="altura" name="altura" min="100" max="250" value="<?= htmlspecialchars($altura) ?>">

            <label for="pierna_buena">Pierna buena:</label>
            <select id="pierna_buena" name="pierna_buena">
                <option value="">Seleccionar</option>
                <option value="derecha" <?= $pierna_buena === 'derecha' ? 'selected' : '' ?>>Derecha</option>
                <option value="izquierda" <?= $pierna_buena === 'izquierda' ? 'selected' : '' ?>>Izquierda</option>
                <option value="ambas" <?= $pierna_buena === 'ambas' ? 'selected' : '' ?>>Ambas</option>
            </select>

            <label for="posicion_habitual">Posición Habitual:</label>
            <select id="posicion_habitual" name="posicion_habitual">
                <option value="">Seleccionar</option>
                <option value="Portero" <?= $posicion_habitual === 'Portero' ? 'selected' : '' ?>>Portero</option>
                <option value="Lateral Derecho" <?= $posicion_habitual === 'Lateral Derecho' ? 'selected' : '' ?>>Lateral Derecho</option>
                <option value="Lateral Izquierdo" <?= $posicion_habitual === 'Lateral Izquierdo' ? 'selected' : '' ?>>Lateral Izquierdo</option>
                <option value="Central Derecho" <?= $posicion_habitual === 'Central Derecho' ? 'selected' : '' ?>>Central Derecho</option>
                <option value="Central Izquierdo" <?= $posicion_habitual === 'Central Izquierdo' ? 'selected' : '' ?>>Central Izquierdo</option>
                <option value="Pivote Defensivo" <?= $posicion_habitual === 'Pivote Defensivo' ? 'selected' : '' ?>>Pivote Defensivo</option>
                <option value="Centrocampista Derecho" <?= $posicion_habitual === 'Centrocampista Derecho' ? 'selected' : '' ?>>Centrocampista Derecho</option>
                <option value="Centrocampista Izquierdo" <?= $posicion_habitual === 'Centrocampista Izquierdo' ? 'selected' : '' ?>>Centrocampista Izquierdo</option>
                <option value="Centrocampista Central" <?= $posicion_habitual === 'Centrocampista Central' ? 'selected' : '' ?>>Centrocampista Central</option>
                <option value="Mediapunta" <?= $posicion_habitual === 'Mediapunta' ? 'selected' : '' ?>>Mediapunta</option>
                <option value="Extremo Derecho" <?= $posicion_habitual === 'Extremo Derecho' ? 'selected' : '' ?>>Extremo Derecho</option>
                <option value="Extremo Izquierdo" <?= $posicion_habitual === 'Extremo Izquierdo' ? 'selected' : '' ?>>Extremo Izquierdo</option>
                <option value="Delantero Centro" <?= $posicion_habitual === 'Delantero Centro' ? 'selected' : '' ?>>Delantero Centro</option>
                <option value="Segundo Delantero" <?= $posicion_habitual === 'Segundo Delantero' ? 'selected' : '' ?>>Segundo Delantero</option>
            </select>

            <label for="posicion_secundaria">Posición Secundaria:</label>
            <select id="posicion_secundaria" name="posicion_secundaria">
                <option value="">Seleccionar</option>
                <option value="Portero" <?= $posicion_secundaria === 'Portero' ? 'selected' : '' ?>>Portero</option>
                <option value="Lateral Derecho" <?= $posicion_secundaria === 'Lateral Derecho' ? 'selected' : '' ?>>Lateral Derecho</option>
                <option value="Lateral Izquierdo" <?= $posicion_secundaria === 'Lateral Izquierdo' ? 'selected' : '' ?>>Lateral Izquierdo</option>
                <option value="Central Derecho" <?= $posicion_secundaria === 'Central Derecho' ? 'selected' : '' ?>>Central Derecho</option>
                <option value="Central Izquierdo" <?= $posicion_secundaria === 'Central Izquierdo' ? 'selected' : '' ?>>Central Izquierdo</option>
                <option value="Pivote Defensivo" <?= $posicion_secundaria === 'Pivote Defensivo' ? 'selected' : '' ?>>Pivote Defensivo</option>
                <option value="Centrocampista Derecho" <?= $posicion_secundaria === 'Centrocampista Derecho' ? 'selected' : '' ?>>Centrocampista Derecho</option>
                <option value="Centrocampista Izquierdo" <?= $posicion_secundaria === 'Centrocampista Izquierdo' ? 'selected' : '' ?>>Centrocampista Izquierdo</option>
                <option value="Centrocampista Central" <?= $posicion_secundaria === 'Centrocampista Central' ? 'selected' : '' ?>>Centrocampista Central</option>
                <option value="Mediapunta" <?= $posicion_secundaria === 'Mediapunta' ? 'selected' : '' ?>>Mediapunta</option>
                <option value="Extremo Derecho" <?= $posicion_secundaria === 'Extremo Derecho' ? 'selected' : '' ?>>Extremo Derecho</option>
                <option value="Extremo Izquierdo" <?= $posicion_secundaria === 'Extremo Izquierdo' ? 'selected' : '' ?>>Extremo Izquierdo</option>
                <option value="Delantero Centro" <?= $posicion_secundaria === 'Delantero Centro' ? 'selected' : '' ?>>Delantero Centro</option>
                <option value="Segundo Delantero" <?= $posicion_secundaria === 'Segundo Delantero' ? 'selected' : '' ?>>Segundo Delantero</option>
            </select>

            <label for="estilo_de_juego">Estilo de Juego:</label>
            <select id="estilo_de_juego" name="estilo_de_juego">
                <option value="">Seleccionar</option>
                <option value="Defensivo" <?= $estilo_de_juego === 'Defensivo' ? 'selected' : '' ?>>Defensivo</option>
                <option value="Equilibrado" <?= $estilo_de_juego === 'Equilibrado' ? 'selected' : '' ?>>Equilibrado</option>
                <option value="Ofensivo" <?= $estilo_de_juego === 'Ofensivo' ? 'selected' : '' ?>>Ofensivo</option>
            </select>

            <label for="pases">Pases:</label>
            <select id="pases" name="pases">
                <option value="">Seleccionar</option>
                <option value="1" <?= $pases === '1' ? 'selected' : '' ?>>1</option>
                <option value="2" <?= $pases === '2' ? 'selected' : '' ?>>2</option>
                <option value="3" <?= $pases === '3' ? 'selected' : '' ?>>3</option>
                <option value="4" <?= $pases === '4' ? 'selected' : '' ?>>4</option>
                <option value="5" <?= $pases === '5' ? 'selected' : '' ?>>5</option>
            </select>

            <label for="tiros">Tiros:</label>
            <select id="tiros" name="tiros">
                <option value="">Seleccionar</option>
                <option value="1" <?= $tiros === '1' ? 'selected' : '' ?>>1</option>
                <option value="2" <?= $tiros === '2' ? 'selected' : '' ?>>2</option>
                <option value="3" <?= $tiros === '3' ? 'selected' : '' ?>>3</option>
                <option value="4" <?= $tiros === '4' ? 'selected' : '' ?>>4</option>
                <option value="5" <?= $tiros === '5' ? 'selected' : '' ?>>5</option>
            </select>

            <label for="velocidad">Velocidad:</label>
            <select id="velocidad" name="velocidad">
                <option value="">Seleccionar</option>
                <option value="1" <?= $velocidad === '1' ? 'selected' : '' ?>>1</option>
                <option value="2" <?= $velocidad === '2' ? 'selected' : '' ?>>2</option>
                <option value="3" <?= $velocidad === '3' ? 'selected' : '' ?>>3</option>
                <option value="4" <?= $velocidad === '4' ? 'selected' : '' ?>>4</option>
                <option value="5" <?= $velocidad === '5' ? 'selected' : '' ?>>5</option>
            </select>

            <label for="regate">Regate:</label>
            <select id="regate" name="regate">
                <option value="">Seleccionar</option>
                <option value="1" <?= $regate === '1' ? 'selected' : '' ?>>1</option>
                <option value="2" <?= $regate === '2' ? 'selected' : '' ?>>2</option>
                <option value="3" <?= $regate === '3' ? 'selected' : '' ?>>3</option>
                <option value="4" <?= $regate === '4' ? 'selected' : '' ?>>4</option>
                <option value="5" <?= $regate === '5' ? 'selected' : '' ?>>5</option>
            </select>

            <label for="defensa">Defensa:</label>
            <select id="defensa" name="defensa">
                <option value="">Seleccionar</option>
                <option value="1" <?= $defensa === '1' ? 'selected' : '' ?>>1</option>
                <option value="2" <?= $defensa === '2' ? 'selected' : '' ?>>2</option>
                <option value="3" <?= $defensa === '3' ? 'selected' : '' ?>>3</option>
                <option value="4" <?= $defensa === '4' ? 'selected' : '' ?>>4</option>
                <option value="5" <?= $defensa === '5' ? 'selected' : '' ?>>5</option>
            </select>

            <button type="submit" class="primary-button">Filtrar</button>
        </form>
    </div>

    <div class='tablon'>
        <div class="card-container" id="result-container">
            <?php foreach ($anuncios as $anuncio): ?>
                <div class="anuncio-card">
                    <div class="perfil-info">
                        <img src="<?= !empty($anuncio['perfil_url']) ? $anuncio['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg' ?>"
                            alt="perfil" class="perfil-imagen">
                        <div class="info-texto">
                            <h2><?= $anuncio['nombre'] ?> <?= $anuncio['apellidos'] ?></h2>
                            <p><?= $anuncio['edad'] ?> años - <?= $anuncio['ciudad'] ?></p>
                        </div>
                    </div>
                    <div class="anuncio-detalle">
                        <h3><?= $anuncio['titulo'] ?></h3>
                        <p><?= $anuncio['descripcion'] ?></p>
                    </div>
                    <div class="anuncio-botones">
                        <div class="button-borders">
                            <a class="primary-button">Contactar</a>
                            <a href="./verPerfilJugador.php?id=<?= $anuncio['usuario_id'] ?>" class="primary-button">Ver
                                Perfil</a>
                        </div>
                    </div>
                    <p><?= $anuncio['fecha_publicacion'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#filtro-form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../controllers/filtros_anuncios_jugador.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#result-container').html(response);
                    }
                });
            });
        });
    </script>

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
        // Get the modal
        var modal = document.getElementById("modalCrearAnuncio");

        // Get the button that opens the modal
        var btn = document.getElementById("btnCrearAnuncio");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
