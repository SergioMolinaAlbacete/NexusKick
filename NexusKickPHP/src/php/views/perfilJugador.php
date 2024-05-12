<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>anuncios</title>
    <link rel="stylesheet" href="./../../css/general.css">
    <link rel="stylesheet" href="./../../css/header.css">
    <link rel="stylesheet" href="./../../css/perfil.css">

</head>

<body>
    <?php
    include './componentes/header.php';
    include '../config/db.php'; // Asegúrate de que la ruta es correcta

    // Suponemos que recibimos el ID del usuario de alguna forma, aquí lo definimos manualmente
    $usuario_id = 1; // Deberías obtener este ID dinámicamente, por ejemplo a través de $_GET['id'] o una sesión

    // Consulta para obtener la información del jugador
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $player = $resultado->fetch_assoc();
    ?>



    <div class="titulo-container">
        <h1>Perfil de <?= $player['nombre'] ?> <?= $player['apellidos'] ?></h1><button>Editar Perfil</button>
    </div>
    <!-- Bloque información personal -->
    <div class="player-profile">
        <div class="player-profile-column">
            <img src="<?= $player['perfil_url'] ?>" alt="<?= $player['nombre'] ?>" class="player-image" />
            <h2 class="player-nickname"><?= $player['apodo'] ?></h2>
        </div>
        <div class="player-info">
            <h2>Información Personal</h2>
            <p><span class="info-label">Nombre Completo:</span> <?= $player['nombre'] ?> <?= $player['apellidos'] ?></p>
            <p><span class="info-label">País de Nacimiento:</span> <?= $player['pais'] ?></p>
            <p><span class="info-label">Lugar de Nacimiento:</span> <?= $player['ciudad'] ?></p>
            <p><span class="info-label">Fecha de Nacimiento:</span> <?= $player['fnacimiento'] ?></p>
            <p><span class="info-label">Edad:</span> <?= $player['edad'] ?></p>
            <p><span class="info-label">Altura:</span> <?= $player['altura'] ?></p>
            <p><span class="info-label">Peso:</span> <?= $player['peso'] ?></p>
            <p><span class="info-label">Pierna Buena:</span> <?= $player['piernaBuena'] ?></p>
            <p><span class="info-label">Talla de Ropa:</span> <?= $player['tallaRopa'] ?></p>
            <p><span class="info-label">Talla de Calzado:</span> <?= $player['tallaCalzado'] ?></p>
            <p><span class="info-label">Número Preferido:</span> <?= $player['numeroPreferido'] ?></p>
        </div>
    </div>





    <?php
    // Consulta para obtener el historial deportivo del usuario
    $sqlHistorial = "SELECT * FROM historial_deportivo WHERE usuario_id = ?";
    $stmtHistorial = $conn->prepare($sqlHistorial);
    $stmtHistorial->bind_param("i", $usuario_id);
    $stmtHistorial->execute();
    $resultadoHistorial = $stmtHistorial->get_result();
    $historiales = [];
    while ($fila = $resultadoHistorial->fetch_assoc()) {
        $historiales[] = $fila;
    }

    ?>

    <!-- Bloque Historial -->
    <div class="player-history">
        <h2>Historial del jugador</h2>
        <div class="history-slider">
            <button class="slide-arrow left-arrow">
                <img src="../../img/flechaIzquierda.png" alt="Anterior" />
            </button>

            <?php foreach ($historiales as $item) : ?>
                <div class="history-card">
                    <img src="<?= htmlspecialchars($item['imagenEscudo']) ?>" alt="Escudo del equipo <?= htmlspecialchars($item['equipo']) ?>" class="team-shield" />
                    <h3><?= htmlspecialchars($item['equipo']) ?></h3>
                    <p>Temporada: <?= htmlspecialchars($item['temporada']) ?></p>
                    <p>Resultado: <?= htmlspecialchars($item['resultado']) ?></p>
                </div>
            <?php endforeach; ?>

            <button class="slide-arrow right-arrow">
                <img src="../../img/flechaDerecha.png" alt="Siguiente" />
            </button>
        </div>
    </div>








    <?php
    // Consulta para obtener la ficha técnica del jugador
    $sqlFichaTecnica = "SELECT * FROM ficha_tecnica WHERE usuario_id = ?";
    $stmtFichaTecnica = $conn->prepare($sqlFichaTecnica);
    $stmtFichaTecnica->bind_param("i", $usuario_id);
    $stmtFichaTecnica->execute();
    $resultadoFichaTecnica = $stmtFichaTecnica->get_result();
    $fichaTecnica = $resultadoFichaTecnica->fetch_assoc();

    ?>

    <!-- Bloque Ficha Técnica -->
    <div class="player-technical-info">
        <h2>Ficha Técnica</h2>
        <div class="technical-details">
            <div class="column">
                <p>Posición Habitual: <?= htmlspecialchars($fichaTecnica['posicion_habitual']) ?> (Secundaria: <?= htmlspecialchars($fichaTecnica['posicion_secundaria']) ?>)</p>
                <p>Estilo de Juego: <?= htmlspecialchars($fichaTecnica['estilo_de_juego']) ?></p>
            </div>
            <div class="column">
                <div class="skills">
                    <h3>Habilidades Técnicas</h3>
                    <p>Pases: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['pases']) ?></p>
                    <p>Tiros: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['tiros']) ?></p>
                    <p>Velocidad: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['velocidad']) ?></p>
                    <p>Regate: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['regate']) ?></p>
                    <p>Defensa: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['defensa']) ?></p>
                </div>
                <p>Notas Adicionales: <?= htmlspecialchars($fichaTecnica['notas_adicionales']) ?></p>
            </div>
        </div>
    </div>




    <?php
    // Consulta para obtener la situación académica o laboral del usuario
    $sqlSituacion = "SELECT actividad, lugar, horario FROM situacion_academica_laboral WHERE usuario_id = ?";
    $stmtSituacion = $conn->prepare($sqlSituacion);
    $stmtSituacion->bind_param("i", $usuario_id); // Asegúrate de que $usuario_id está definido y corresponde al usuario en sesión
    $stmtSituacion->execute();
    $resultadoSituacion = $stmtSituacion->get_result();
    $situaciones = [];
    while ($fila = $resultadoSituacion->fetch_assoc()) {
        $situaciones[] = $fila;
    }
    ?>

    <!-- Bloque Situacion -->
    <div class="work-reviews-container">
        <div class="work-info">
            <h2>Situación Laboral y/o Estudio</h2>
            <table>
                <thead>
                    <tr>
                        <th>Actividad</th>
                        <th>Lugar</th>
                        <th>Horario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($situaciones as $situacion) : ?>
                        <tr>
                            <td><?= htmlspecialchars($situacion['actividad']) ?></td>
                            <td><?= htmlspecialchars($situacion['lugar']) ?></td>
                            <td><?= htmlspecialchars($situacion['horario']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



        <?php
        // Consulta para obtener las reseñas y las fotos de perfil de los usuarios que las escribieron
        $sqlReseñas = "SELECT r.reseña, r.puntuacion, r.fecha, u.perfil_url
                   FROM reseñas r
                   JOIN usuarios u ON r.de_usuario_id = u.id
                   WHERE r.para_usuario_id = ?";
        $stmtReseñas = $conn->prepare($sqlReseñas);
        $stmtReseñas->bind_param("i", $usuario_id);
        $stmtReseñas->execute();
        $resultadoReseñas = $stmtReseñas->get_result();
        $reseñas = [];
        while ($fila = $resultadoReseñas->fetch_assoc()) {
            $reseñas[] = $fila;
        }
        ?>


        <!-- Bloque Reseñas -->
        <div class="reviews">
            <h2>Reseñas</h2>
            <?php foreach ($reseñas as $reseña) : ?>
                <div class="review">
                    <!-- Mostrar la foto de perfil si está disponible, de lo contrario mostrar una imagen por defecto -->
                    <img src="<?= $reseña['perfil_url'] ?: '../img/imagenPerfilPredeterminada.jpg' ?>" alt="Foto de perfil" style="width: 50px; height: 50px; border-radius: 50%;">
                    <p><?= htmlspecialchars($reseña['reseña']) ?></p>
                    <p><?= str_repeat("⭐", intval($reseña['puntuacion'])) ?></p>
                    <small><?= date("d/m/Y", strtotime($reseña['fecha'])) ?></small>
                </div>
            <?php endforeach; ?>
        </div>






        <!-- Modal para editar perfil -->
        <div id="modalEditarPerfil" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form action="../controllers/guardar_cambios_perfil.php" method="POST">
                    <h2>Editar Perfil</h2>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($player['nombre']) ?>" required>
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($player['apellidos']) ?>" required>
                    <!-- Añade más campos según necesites -->
                    <input type="submit" value="Guardar Cambios">
                </form>

                <!-- Sección para Historial Deportivo -->
                <h2>Historial Deportivo</h2>
                <?php foreach ($historiales as $item) : ?>
                    <div class="historial-item">
                        <form action="../controllers/editar_historial.php" method="POST">
                            <input type="hidden" name="historial_id" value="<?= $item['id'] ?>">
                            <label>Equipo:</label>
                            <input type="text" name="equipo" value="<?= htmlspecialchars($item['equipo']) ?>">
                            <label>Temporada:</label>
                            <input type="text" name="temporada" value="<?= htmlspecialchars($item['temporada']) ?>">
                            <label>Resultado:</label>
                            <input type="text" name="resultado" value="<?= htmlspecialchars($item['resultado']) ?>">
                            <button type="submit" name="action" value="update">Actualizar</button>
                            <button type="submit" name="action" value="delete">Eliminar</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <script>
            // Obtener el modal
            var modal = document.getElementById("modalEditarPerfil");

            // Obtener el botón que abre el modal
            var btn = document.querySelector(".titulo-container button");

            // Obtener el elemento que cierra el modal
            var span = document.getElementsByClassName("close")[0];

            // Cuando el usuario hace clic en el botón, abre el modal 
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // Cuando el usuario hace clic en <span> (x), cierra el modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // Cuando el usuario hace clic fuera del modal, cierra el modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>

</body>

</html>