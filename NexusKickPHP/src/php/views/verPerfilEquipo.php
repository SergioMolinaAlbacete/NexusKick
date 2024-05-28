<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Perfil | NexusKick</title>
    <link rel="stylesheet" href="./../../css/general.css">
    <link rel="stylesheet" href="./../../css/header.css">
    <link rel="stylesheet" href="./../../css/perfil.css">

</head>

<body>
    <?php
    include './componentes/header.php';
    include '../config/db.php'; // Asegúrate de que la ruta es correcta
    


    //Obtener el usuario que estoy visitando
    $usuario_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($usuario_id == 0) {
        echo "Usuario no válido";
        exit;
    }


    // Consulta para obtener la información del jugador
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $equipo = $resultado->fetch_assoc();
    ?>



    <div class="titulo-container">
        <h1>Perfil de <?= $equipo['nombre'] ?> <?= $equipo['apellidos'] ?></h1>
    </div>
    <!-- Bloque información personal -->
    <div class="player-profile">
        <div class="player-profile-column">
            <img src="<?= !empty($equipo['perfil_url']) ? $equipo['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg' ?>"
                alt="<?= htmlspecialchars($equipo['nombre']) ?>" class="player-image" />
            <h2 class="player-nickname"><?= $equipo['apodo'] ?></h2>
        </div>
        <div class="player-info">
            <h2>Información Personal</h2>
            <p><span class="info-label">Nombre Completo:</span> <?= $equipo['nombre'] ?>
                <?= $equipo['apellidos'] ?></p>
            <p><span class="info-label">País de Nacimiento:</span> <?= $equipo['pais'] ?></p>
            <p><span class="info-label">Lugar de Nacimiento:</span> <?= $equipo['ciudad'] ?></p>
            <p><span class="info-label">Fecha de Nacimiento:</span> <?= $equipo['fnacimiento'] ?></p>
            <p><span class="info-label">Edad:</span> <?= $equipo['edad'] ?> años</p>

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

            <?php foreach ($historiales as $item): ?>
                <div class="history-card">
                    <img src="<?= htmlspecialchars($item['imagenEscudo']) ?>"
                        alt="Escudo del equipo <?= htmlspecialchars($item['equipo']) ?>" class="team-shield" />
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
    // Consulta para obtener la situación académica o laboral del usuario
    $sqlSituacion = "SELECT id,actividad, lugar, horario FROM situacion_academica_laboral WHERE usuario_id = ?";
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
                    <?php foreach ($situaciones as $situacion): ?>
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
        $sqlReseñas = "SELECT *
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
            <h2>Reseñas<button id="añadirReseñas">Añadir reseña</button></h2>
            <?php foreach ($reseñas as $reseña): ?>
                <div class="review">
                    <!-- Mostrar la foto de perfil si está disponible, de lo contrario mostrar una imagen por defecto -->
                    <img src="<?= $reseña['perfil_url'] ?: '../img/imagenPerfilPredeterminada.jpg' ?>" alt="Foto de perfil"
                        style="width: 50px; height: 50px; border-radius: 50%;">
                    <p><?= htmlspecialchars($reseña['reseña']) ?></p>
                    <p><?= str_repeat("⭐", intval($reseña['puntuacion'])) ?></p>
                    <small><?= date("d/m/Y", strtotime($reseña['fecha'])) ?></small>
                </div>
            <?php endforeach; ?>
        </div>


        <!-- Modal para añadir reseña -->
        <div id="modalAñadirReseña" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Añadir Reseña</h2>
                <form action="../controllers/añadir_reseña.php" method="POST">
                    <input type="hidden" name="de_usuario_id" value="<?= $_SESSION['id_usuario'] ?>">
                    <input type="hidden" name="para_usuario_id" value="<?= $usuario_id ?>">
                    <label>Reseña:</label>
                    <textarea name="reseña" placeholder="Escribe tu reseña aquí"></textarea>
                    <label>Puntuación:</label>
                    <select name="puntuacion">
                        <option value="1"> ⭐</option>
                        <option value="2"> ⭐⭐</option>
                        <option value="3"> ⭐⭐⭐</option>
                        <option value="4"> ⭐⭐⭐⭐</option>
                        <option value="5"> ⭐⭐⭐⭐⭐</option>
                    </select>
                    <button type="submit">Añadir Reseña</button>
                </form>
            </div>
        </div>

        <script>
            // Modal para añadir reseña
            var modalReseña = document.getElementById("modalAñadirReseña");

            // Botón que abre el modal de añadir reseña
            var btnReseña = document.getElementById("añadirReseñas");

            // Botón de cierre en el modal de añadir reseña
            var spanReseña = document.querySelector("#modalAñadirReseña .close");

            btnReseña.onclick = function () {
                modalReseña.style.display = "block";
            }

            spanReseña.onclick = function () {
                modalReseña.style.display = "none";
            }

            // Evento para cerrar el modal si el usuario hace clic fuera de él
            window.onclick = function (event) {
                if (event.target == modalReseña) {
                    modalReseña.style.display = "none";
                }
            }
        </script>



</body>

</html>