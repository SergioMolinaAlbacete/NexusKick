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



    <h1>Perfil </h1>

    <!-- Bloque información personal -->
    <div class="player-profile">
        <div class="player-profile-column">
            <img src="<?= $player['perfil_url'] ?>" alt="<?= $player['nombre'] ?>" class="player-image" />
            <h1 class="player-nickname"><?= $player['apodo'] ?></h1>
        </div>
        <div class="player-info">
            <h2>Información Personal</h2>
            <p><span class="info-label">Nombre Completo:</span> <?= $player['nombre'] ?></p>
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
                <img src="path_to_previous_icon" alt="Anterior" />
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
                <img src="path_to_next_icon" alt="Siguiente" />
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
                    <p>Pases: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:40px; height:40px;">', $fichaTecnica['pases']) ?></p>
                    <p>Tiros: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:40px; height:40px;">', $fichaTecnica['tiros']) ?></p>
                    <p>Velocidad: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:40px; height:40px;">', $fichaTecnica['velocidad']) ?></p>
                    <p>Regate: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:40px; height:40px;">', $fichaTecnica['regate']) ?></p>
                    <p>Defensa: <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:40px; height:40px;">', $fichaTecnica['defensa']) ?></p>
                </div>
                <p>Notas Adicionales: <?= htmlspecialchars($fichaTecnica['notas_adicionales']) ?></p>
            </div>
        </div>
    </div>


    <!-- Bloque Situacion -->
    <div class="work-info">
        <h2>Situación Laboral y/o Estudio</h2>
        <table>
            <tbody>
                <tr>
                    <td>Actividad</td>
                    <td>Ciclo superior DAW</td>
                </tr>
                <tr>
                    <td>Lugar</td>
                    <td>EIG Business School</td>
                </tr>
                <tr>
                    <td>Horario</td>
                    <td>08:15 - 14:45</td>
                </tr>
            </tbody>
        </table>
    </div>



    <!-- Bloque Reseñas -->
    <div class="reviews">
        <h2>Reseñas</h2>
        <p>El mejor de la Historia⭐⭐⭐⭐⭐</p>
        <p>⭐⭐⭐⭐</p>
        {/* Añade más reseñas según sea necesario */}
    </div>
</body>

</html>