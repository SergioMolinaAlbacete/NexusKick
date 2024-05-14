<?php
include '../config/db.php';

$sql = "SELECT * 
FROM Anuncios 
JOIN Usuarios ON Anuncios.usuario_id = Usuarios.id
WHERE Usuarios.tipo_usuario = 'jugador';
";
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
        <h1>Búsqueda Jugadores</h1><button id="btnCrearAnuncio">Crear Anuncio</button>
    </div>
    <div class="filtro-container">
        <form action="" method="GET" id="filtro-form">
            <!-- <label for="edad">Rango de edad:</label>
            <div class="slider">
                <input type="range" id="edad1" name="edad" min="10" max="70" value="10" oninput="updateValue(this)">
                <output for="edad1" id="output1">10</output>
                <input type="range" id="edad2" name="edad" min="10" max="70" value="70" oninput="updateValue(this)">
                <output for="edad2" id="output2">70</output>
            </div> -->
            <label for="pais">País:</label>
            <select id="pais" name="pais">
                <option value="">Seleccionar país</option>
                <!-- Añade aquí más opciones según los países disponibles -->
            </select>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad">

            <label for="altura">Altura mínima(cm):</label>
            <input type="number" id="altura" name="altura" min="100" max="250">

            <label for="pierna_buena">Pierna buena:</label>
            <select id="pierna_buena" name="pierna_buena">
                <option value="">Seleccionar</option>
                <option value="derecha">Derecha</option>
                <option value="izquierda">Izquierda</option>
                <option value="izquierda">Ambas</option>
            </select>

            <button type="submit" class="primary-button">Filtrar</button>
        </form>
    </div>

    <div class='tablon'>
        <div class="card-container">
            <?php foreach ($anuncios as $anuncio) : ?>
                <div class="anuncio-card">
                    <div class="perfil-info">
                        <img src="<?= htmlspecialchars($anuncio['perfil_url']) ?>" alt="perfil" class="perfil-imagen">
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
                            <a href="./verPerfilJugador.php?id=<?= $anuncio['usuario_id'] ?>" class="primary-button">Ver Perfil</a>
                        </div>
                    </div>
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

        document.getElementById('edad1').addEventListener('input', function() {
            updateValue(this);
        });
        document.getElementById('edad2').addEventListener('input', function() {
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
        // Get the modal
        var modal = document.getElementById("modalCrearAnuncio");

        // Get the button that opens the modal
        var btn = document.getElementById("btnCrearAnuncio");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>



</body>

</html>