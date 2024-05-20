<?php
include '../config/db.php';

// Recoger los datos del formulario
$pais = isset($_POST['pais']) ? $_POST['pais'] : '';
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
$experiencia = isset($_POST['experiencia']) ? $_POST['experiencia'] : '';
$especialidad = isset($_POST['especialidad']) ? $_POST['especialidad'] : '';

// Construir la consulta SQL básica
$sql = "SELECT * 
        FROM anuncios 
        JOIN usuarios ON anuncios.usuario_id = usuarios.id
        JOIN ficha_tecnica ON usuarios.id = ficha_tecnica.usuario_id
        WHERE usuarios.tipo_usuario = 'entrenador'";

// Añadir filtros si están presentes
if ($pais != '') {
    $sql .= " AND usuarios.pais = '$pais'";
}
if ($ciudad != '') {
    $sql .= " AND usuarios.ciudad LIKE '%$ciudad%'";
}
if ($experiencia != '') {
    $sql .= " AND ficha_tecnica.experiencia >= $experiencia";
}
if ($especialidad != '') {
    $sql .= " AND ficha_tecnica.especialidad = '$especialidad'";
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
    <title>Anuncios Entrenadores | NexusKick</title>
    <link rel="stylesheet" href="./../../css/general.css">
    <link rel="stylesheet" href="./../../css/Anuncio.css">
    <link rel="stylesheet" href="./../../css/header.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include './componentes/header.php'; ?>
    <div class="titulo-container">
        <h1>Búsqueda Entrenadores</h1>
        <button id="btnCrearAnuncio">Crear Anuncio</button>
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
                    <label for="experiencia">Experiencia mínima (años):</label>
                    <input type="number" id="experiencia" name="experiencia" min="0" max="50" value="<?= htmlspecialchars($experiencia) ?>">
                </div>
                <div class="filtro-item">
                    <label for="especialidad">Especialidad:</label>
                    <select id="especialidad" name="especialidad">
                        <option value="">Ninguna</option>
                        <option value="Preparador Físico" <?= $especialidad === 'Preparador Físico' ? 'selected' : '' ?>>Preparador Físico</option>
                        <option value="Entrenador de Porteros" <?= $especialidad === 'Entrenador de Porteros' ? 'selected' : '' ?>>Entrenador de Porteros</option>
                        <option value="Analista" <?= $especialidad === 'Analista' ? 'selected' : '' ?>>Analista</option>
                        <option value="Táctico" <?= $especialidad === 'Táctico' ? 'selected' : '' ?>>Táctico</option>
                        <option value="Psicólogo Deportivo" <?= $especialidad === 'Psicólogo Deportivo' ? 'selected' : '' ?>>Psicólogo Deportivo</option>
                    </select>
                </div>
            </div>

            <div class="filtro-seccion">
                <button type="submit" class="primary-button">Filtrar</button>
            </div>
        </form>
    </div>

    <h2 id="resultados">Resultados</h2>
    <div class='tablon'>
        <div class="card-container" id="result-container">
            <?php foreach ($anuncios as $anuncio) : ?>
                <div class="anuncio-card">
                    <div class="perfil-info">
                        <img src="<?= !empty($anuncio['perfil_url']) ? $anuncio['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg' ?>" alt="perfil" class="perfil-imagen">
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
                            <a href="./verPerfilEntrenador.php?id=<?= $anuncio['usuario_id'] ?>" class="primary-button">Ver Perfil</a>
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
                    url: '../controllers/filtros_anuncios_entrenador.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#result-container').html(response);
                    }
                });
            });

            $('input[type="range"]').on('input', function() {
                const id = $(this).attr('id');
                $(`#${id}_value`).text($(this).val());
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
