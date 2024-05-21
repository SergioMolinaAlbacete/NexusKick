<?php

include '../config/db.php';

// Recoger los datos del formulario
$pais = isset($_POST['pais']) ? $_POST['pais'] : '';
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
$estadio = isset($_POST['estadio']) ? $_POST['estadio'] : '';
$fundacion = isset($_POST['fundacion']) ? $_POST['fundacion'] : '';

// Construir la consulta SQL básica
$sql = "SELECT * 
        FROM anuncios 
        JOIN usuarios ON anuncios.usuario_id = usuarios.id
        LEFT JOIN ficha_tecnica ON usuarios.id = ficha_tecnica.usuario_id
        WHERE usuarios.tipo_usuario = 'equipo'";

// Añadir filtros si están presentes
if ($pais != '') {
    $sql .= " AND usuarios.pais = '$pais'";
}
if ($ciudad != '') {
    $sql .= " AND usuarios.ciudad LIKE '%$ciudad%'";
}
if ($estadio != '') {
    $sql .= " AND ficha_tecnica.estadio LIKE '%$estadio%'";
}
if ($fundacion != '') {
    $sql .= " AND ficha_tecnica.fnacimiento >= '$fundacion'";
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
    <title>Anuncios Equipos | NexusKick</title>
    <link rel="stylesheet" href="./../../css/general.css">
    <link rel="stylesheet" href="./../../css/Anuncio.css">
    <link rel="stylesheet" href="./../../css/header.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include './componentes/header.php'; ?>
    <div class="titulo-container">
        <h1>Búsqueda Equipos</h1>
        <?php if ($tipo_usuario === 'equipo'): ?>
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
                    <label for="estadio">Estadio:</label>
                    <input type="text" id="estadio" name="estadio" value="<?= htmlspecialchars($estadio) ?>">
                </div>
                <div class="filtro-item">
                    <label for="fundacion">Año de Fundación:</label>
                    <input type="number" id="fundacion" name="fundacion" min="1800" max="<?= date('Y') ?>" value="<?= htmlspecialchars($fundacion) ?>">
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
                            <h2><?= $anuncio['nombre'] ?></h2>
                            <p><?= $anuncio['ciudad'] ?> - <?= $anuncio['estadio'] ?></p>
                        </div>
                    </div>
                    <div class="anuncio-detalle">
                        <h3><?= $anuncio['titulo'] ?></h3>
                        <p><?= $anuncio['descripcion'] ?></p>
                    </div>
                    <div class="anuncio-botones">
                        <div class="button-borders">
                            <a class="primary-button">Contactar</a>
                            <a href="./verPerfilEquipo.php?id=<?= $anuncio['usuario_id'] ?>" class="primary-button">Ver Perfil</a>
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
        $(document).ready(function() {
            $('#filtro-form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../controllers/filtros_anuncios_equipo.php',
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

            // Modal logic
            var modal = document.getElementById("modalCrearAnuncio");
            var btn = document.getElementById("btnCrearAnuncio");
            var span = document.getElementsByClassName("close")[0];

            if (btn && modal && span) {
                btn.onclick = function() {
                    modal.style.display = "block";
                }

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            } else {
                console.error("Modal elements not found.");
            }
        });
    </script>
</body>

</html>
