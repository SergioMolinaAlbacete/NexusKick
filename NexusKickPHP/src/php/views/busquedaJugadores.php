<?php
include '../config/db.php';

// Recoger los datos del formulario
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

</head>

<body>
    <?php
    include './componentes/header.php';
    ?>
    <div class="titulo-container">
    <h1>Búsqueda Jugadores</h1>
    <button id="btnCrearAnuncio">Crear Anuncio</button>
</div>
<div class="filtro-container">
    <form action="" method="GET" id="filtro-form">
        <label for="pais">País:</label>
        <select id="pais" name="pais">
            <?php include './componentes/desplegablePaises.php'; ?>
        </select>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad">

        <label for="altura">Altura mínima (cm):</label>
        <input type="number" id="altura" name="altura" min="100" max="250">

        <label for="pierna_buena">Pierna buena:</label>
        <select id="pierna_buena" name="pierna_buena">
            <option value="">Seleccionar</option>
            <option value="derecha">Derecha</option>
            <option value="izquierda">Izquierda</option>
            <option value="ambas">Ambas</option>
        </select>

        <label for="posicion_habitual">Posición Habitual:</label>
        <select id="posicion_habitual" name="posicion_habitual">
            <option value="">Seleccionar</option>
            <option value="Portero">Portero</option>
            <option value="Lateral Derecho">Lateral Derecho</option>
            <option value="Lateral Izquierdo">Lateral Izquierdo</option>
            <option value="Central Derecho">Central Derecho</option>
            <option value="Central Izquierdo">Central Izquierdo</option>
            <option value="Pivote Defensivo">Pivote Defensivo</option>
            <option value="Centrocampista Derecho">Centrocampista Derecho</option>
            <option value="Centrocampista Izquierdo">Centrocampista Izquierdo</option>
            <option value="Centrocampista Central">Centrocampista Central</option>
            <option value="Mediapunta">Mediapunta</option>
            <option value="Extremo Derecho">Extremo Derecho</option>
            <option value="Extremo Izquierdo">Extremo Izquierdo</option>
            <option value="Delantero Centro">Delantero Centro</option>
            <option value="Segundo Delantero">Segundo Delantero</option>
        </select>

        <label for="posicion_secundaria">Posición Secundaria:</label>
        <select id="posicion_secundaria" name="posicion_secundaria">
            <option value="">Seleccionar</option>
            <option value="Portero">Portero</option>
            <option value="Lateral Derecho">Lateral Derecho</option>
            <option value="Lateral Izquierdo">Lateral Izquierdo</option>
            <option value="Central Derecho">Central Derecho</option>
            <option value="Central Izquierdo">Central Izquierdo</option>
            <option value="Pivote Defensivo">Pivote Defensivo</option>
            <option value="Centrocampista Derecho">Centrocampista Derecho</option>
            <option value="Centrocampista Izquierdo">Centrocampista Izquierdo</option>
            <option value="Centrocampista Central">Centrocampista Central</option>
            <option value="Mediapunta">Mediapunta</option>
            <option value="Extremo Derecho">Extremo Derecho</option>
            <option value="Extremo Izquierdo">Extremo Izquierdo</option>
            <option value="Delantero Centro">Delantero Centro</option>
            <option value="Segundo Delantero">Segundo Delantero</option>
        </select>

        <label for="estilo_de_juego">Estilo de Juego:</label>
        <select id="estilo_de_juego" name="estilo_de_juego">
            <option value="">Seleccionar</option>
            <option value="Defensivo">Defensivo</option>
            <option value="Equilibrado">Equilibrado</option>
            <option value="Ofensivo">Ofensivo</option>
        </select>

        <label for="pases">Pases:</label>
        <select id="pases" name="pases">
            <option value="">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="tiros">Tiros:</label>
        <select id="tiros" name="tiros">
            <option value="">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="velocidad">Velocidad:</label>
        <select id="velocidad" name="velocidad">
            <option value="">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="regate">Regate:</label>
        <select id="regate" name="regate">
            <option value="">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="defensa">Defensa:</label>
        <select id="defensa" name="defensa">
            <option value="">Seleccionar</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <button type="submit" class="primary-button">Filtrar</button>
    </form>
</div>


    <div class='tablon'>
        <div class="card-container">
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

    <!-- Juntar Sliders -->
    <script>
        function updateValue(slider) {
            const output = slider.nextElementSibling;
            const sliderRect = slider.getBoundingClientRect();
            const min = parseInt(slider.min, 10);
            const max = parseInt(slider.max, 10);
            const relativeValue = (slider.value - min) / (max - min);
            const thumbOffset = relativeValue * (sliderRect.width - 20); // 20 px para el thumb

            if (slider.id === 'edad1') {
                output.style.left = `${thumbOffset}px`;
            } else {
                output.style.left = `${thumbOffset}px`;
            }
            output.textContent = slider.value;
            adjustSliders();
        }

        function adjustSliders() {
            if (parseInt(edad1.value, 10) > parseInt(edad2.value, 10)) {
                const temp = edad2.value;
                edad2.value = edad1.value;
                edad1.value = temp;
            }
            updateValue(edad1);
            updateValue(edad2);
        }

        document.getElementById('edad1').addEventListener('input', function () {
            updateValue(this);
        });
        document.getElementById('edad2').addEventListener('input', function () {
            updateValue(this);
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
        var modal = document.getElementById("modalCrearAnuncio");

        var btn = document.getElementById("btnCrearAnuncio");

        var span = document.getElementsByClassName("close")[0];

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
    </script>



</body>

</html>