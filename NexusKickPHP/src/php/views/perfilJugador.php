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
    
    //Comprobar si el usuario ha iniciado sesión
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }

    $usuario_id = $_SESSION['id_usuario'];  // Aquí accedes al ID del usuario desde la sesión
    

    // Consulta para obtener la información del jugador
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $player = $resultado->fetch_assoc();
    ?>



    <div class="titulo-container">
        <h1>Perfil de <?= $player['nombre'] ?> <?= $player['apellidos'] ?></h1>
    </div>
    <!-- Bloque información personal -->
    <div class="player-profile">
        <div class="player-profile-column">
            <img src="<?= !empty($player['perfil_url']) ? $player['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg' ?>"
                alt="<?= htmlspecialchars($player['nombre']) ?>" class="player-image" />
            <h2 class="player-nickname"><?= $player['apodo'] ?></h2>
        </div>
        <div class="player-info">
            <h2>Información Personal<button id="editarInfoPersonal">Editar</button></h2>
            <p><span class="info-label">Nombre Completo:</span> <?= $player['nombre'] ?> <?= $player['apellidos'] ?></p>
            <p><span class="info-label">País de Nacimiento:</span> <?= $player['pais'] ?></p>
            <p><span class="info-label">Lugar de Nacimiento:</span> <?= $player['ciudad'] ?></p>
            <p><span class="info-label">Fecha de Nacimiento:</span> <?= $player['fnacimiento'] ?></p>
            <p><span class="info-label">Edad:</span> <?= $player['edad'] ?> años</p>
            <p><span class="info-label">Altura:</span> <?= $player['altura'] ?> cm</p>
            <p><span class="info-label">Peso:</span> <?= $player['peso'] ?> Kg</p>
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
        <h2>Historial del jugador<button id="editarHistorial">Editar/Añadir</button></h2>
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
        <h2>Ficha Técnica<button id="editarFichaTecnica">Editar</button></h2>
        <div class="technical-details">
            <div class="column">
                <p>Posición Habitual: <?= htmlspecialchars($fichaTecnica['posicion_habitual']) ?> | Posición Secundaria:
                    <?= htmlspecialchars($fichaTecnica['posicion_secundaria']) ?>)</p>
                <p>Estilo de Juego: <?= htmlspecialchars($fichaTecnica['estilo_de_juego']) ?></p>
            </div>
            <div class="column">
                <div class="skills">
                    <h3>Habilidades Técnicas</h3>
                    <p>Pases:
                        <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['pases']) ?>
                    </p>
                    <p>Tiros:
                        <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['tiros']) ?>
                    </p>
                    <p>Velocidad:
                        <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['velocidad']) ?>
                    </p>
                    <p>Regate:
                        <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['regate']) ?>
                    </p>
                    <p>Defensa:
                        <?= str_repeat('<img src="../../img/balon.png" alt="Balón" style="width:30px; height:30px;position:relative;top:6px;">', $fichaTecnica['defensa']) ?>
                    </p>
                </div>
                <p>Puntos fuertes: <?= htmlspecialchars($fichaTecnica['notas_adicionales']) ?></p>
            </div>
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
            <h2>Situación Laboral y/o Estudio<button id="editarSituacion">Editar/Añadir</button></h2>
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
            <h2>Reseñas</h2>
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



        <!-------------------------------------------------------------------------MODALES ----------------------------------------------------------------------------->

        <!-- Modal para editar perfil datos personales-->
        <div id="modalEditarPerfil" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form action="../controllers/guardar_cambios_infoPersonal_jugador.php" method="POST">
                    <h2>Editar Perfil</h2>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($player['nombre']) ?>">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos"
                        value="<?= htmlspecialchars($player['apellidos']) ?>">
                    <label for="apodo">Apodo Futbolístico:</label>
                    <input type="text" id="apodo" name="apodo" value="<?= htmlspecialchars($player['apodo']) ?>">
                    <label for="perfil_url">Foto de Perfil:</label>
                    <input type="text" id="perfil_url" name="perfil_url"
                        value="<?= htmlspecialchars($player['perfil_url']) ?>">
                    <label for="pais">País de Nacimiento:</label>
                    <select id="pais" name="pais">
                        <option value="">Seleccionar país</option>
                        <option value="albania" <?= $player['pais'] === 'albania' ? 'selected' : '' ?>>Albania</option>
                        <option value="alemania" <?= $player['pais'] === 'alemania' ? 'selected' : '' ?>>Alemania</option>
                        <option value="andorra" <?= $player['pais'] === 'andorra' ? 'selected' : '' ?>>Andorra</option>
                        <option value="austria" <?= $player['pais'] === 'austria' ? 'selected' : '' ?>>Austria</option>
                        <option value="bélgica" <?= $player['pais'] === 'bélgica' ? 'selected' : '' ?>>Bélgica</option>
                        <option value="bielorrusia" <?= $player['pais'] === 'bielorrusia' ? 'selected' : '' ?>>Bielorrusia
                        </option>
                        <option value="bosnia" <?= $player['pais'] === 'bosnia' ? 'selected' : '' ?>>Bosnia y Herzegovina
                        </option>
                        <option value="bulgaria" <?= $player['pais'] === 'bulgaria' ? 'selected' : '' ?>>Bulgaria</option>
                        <option value="croacia" <?= $player['pais'] === 'croacia' ? 'selected' : '' ?>>Croacia</option>
                        <option value="dinamarca" <?= $player['pais'] === 'dinamarca' ? 'selected' : '' ?>>Dinamarca
                        </option>
                        <option value="eslovaquia" <?= $player['pais'] === 'eslovaquia' ? 'selected' : '' ?>>Eslovaquia
                        </option>
                        <option value="eslovenia" <?= $player['pais'] === 'eslovenia' ? 'selected' : '' ?>>Eslovenia
                        </option>
                        <option value="españa" <?= $player['pais'] === 'españa' ? 'selected' : '' ?>>España</option>
                        <option value="estonia" <?= $player['pais'] === 'estonia' ? 'selected' : '' ?>>Estonia</option>
                        <option value="finlandia" <?= $player['pais'] === 'finlandia' ? 'selected' : '' ?>>Finlandia
                        </option>
                        <option value="francia" <?= $player['pais'] === 'francia' ? 'selected' : '' ?>>Francia</option>
                        <option value="grecia" <?= $player['pais'] === 'grecia' ? 'selected' : '' ?>>Grecia</option>
                        <option value="hungría" <?= $player['pais'] === 'hungría' ? 'selected' : '' ?>>Hungría</option>
                        <option value="irlanda" <?= $player['pais'] === 'irlanda' ? 'selected' : '' ?>>Irlanda</option>
                        <option value="islandia" <?= $player['pais'] === 'islandia' ? 'selected' : '' ?>>Islandia</option>
                        <option value="italia" <?= $player['pais'] === 'italia' ? 'selected' : '' ?>>Italia</option>
                        <option value="letonia" <?= $player['pais'] === 'letonia' ? 'selected' : '' ?>>Letonia</option>
                        <option value="liechtenstein" <?= $player['pais'] === 'liechtenstein' ? 'selected' : '' ?>>
                            Liechtenstein</option>
                        <option value="lituania" <?= $player['pais'] === 'lituania' ? 'selected' : '' ?>>Lituania</option>
                        <option value="luxemburgo" <?= $player['pais'] === 'luxemburgo' ? 'selected' : '' ?>>Luxemburgo
                        </option>
                        <option value="malta" <?= $player['pais'] === 'malta' ? 'selected' : '' ?>>Malta</option>
                        <option value="moldavia" <?= $player['pais'] === 'moldavia' ? 'selected' : '' ?>>Moldavia</option>
                        <option value="mónaco" <?= $player['pais'] === 'mónaco' ? 'selected' : '' ?>>Mónaco</option>
                        <option value="montenegro" <?= $player['pais'] === 'montenegro' ? 'selected' : '' ?>>Montenegro
                        </option>
                        <option value="noruega" <?= $player['pais'] === 'noruega' ? 'selected' : '' ?>>Noruega</option>
                        <option value="países-bajos" <?= $player['pais'] === 'países-bajos' ? 'selected' : '' ?>>Países
                            Bajos</option>
                        <option value="polonia" <?= $player['pais'] === 'polonia' ? 'selected' : '' ?>>Polonia</option>
                        <option value="portugal" <?= $player['pais'] === 'portugal' ? 'selected' : '' ?>>Portugal</option>
                        <option value="reino-unido" <?= $player['pais'] === 'reino-unido' ? 'selected' : '' ?>>Reino Unido
                        </option>
                        <option value="república-checa" <?= $player['pais'] === 'república-checa' ? 'selected' : '' ?>>
                            República Checa</option>
                        <option value="rumanía" <?= $player['pais'] === 'rumanía' ? 'selected' : '' ?>>Rumanía</option>
                        <option value="rusia" <?= $player['pais'] === 'rusia' ? 'selected' : '' ?>>Rusia</option>
                        <option value="san-marino" <?= $player['pais'] === 'san-marino' ? 'selected' : '' ?>>San Marino
                        </option>
                        <option value="serbia" <?= $player['pais'] === 'serbia' ? 'selected' : '' ?>>Serbia</option>
                        <option value="suecia" <?= $player['pais'] === 'suecia' ? 'selected' : '' ?>>Suecia</option>
                        <option value="suiza" <?= $player['pais'] === 'suiza' ? 'selected' : '' ?>>Suiza</option>
                        <option value="ucrania" <?= $player['pais'] === 'ucrania' ? 'selected' : '' ?>>Ucrania</option>
                    </select>

                    <label for="ciudad">Ciudad de Nacimiento:</label>
                    <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($player['ciudad']) ?>">
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" value="<?= htmlspecialchars($player['edad']) ?>">
                    <label for="altura">Altura (cm):</label>
                    <input type="number" id="altura" name="altura" value="<?= htmlspecialchars($player['altura']) ?>">
                    <label for="peso">Peso (kg):</label>
                    <input type="text" id="peso" name="peso" value="<?= htmlspecialchars($player['peso']) ?>">
                    <label for="piernaBuena">Pierna buena:</label>
                    <select id="piernaBuena" name="piernaBuena">
                        <option value="">Seleccionar</option>
                        <option value="Derecha" <?= $player['piernaBuena'] === 'Derecha' ? 'selected' : '' ?>>Derecha
                        </option>
                        <option value="Izquierda" <?= $player['piernaBuena'] === 'Izquierda' ? 'selected' : '' ?>>Izquierda
                        </option>
                        <option value="Ambas" <?= $player['piernaBuena'] === 'Ambas' ? 'selected' : '' ?>>Ambas</option>
                    </select>
                    <label for="tallaRopa">Talla de Ropa:</label>
                    <select id="tallaRopa" name="tallaRopa">
                        <option value="">Seleccionar</option>
                        <option value="XS" <?= $player['tallaRopa'] === 'XS' ? 'selected' : '' ?>>XS</option>
                        <option value="S" <?= $player['tallaRopa'] === 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $player['tallaRopa'] === 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $player['tallaRopa'] === 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $player['tallaRopa'] === 'XL' ? 'selected' : '' ?>>XL</option>
                        <option value="XXL" <?= $player['tallaRopa'] === 'XXL' ? 'selected' : '' ?>>XXL</option>
                    </select>
                    <label for="tallaCalzado">Talla de Calzado:</label>
                    <input type="number" id="tallaCalzado" name="tallaCalzado"
                        value="<?= htmlspecialchars($player['tallaCalzado']) ?>">
                    <label for="numeroPreferido">Número preferido:</label>
                    <input type="number" min="1" max="99" id="numeroPreferido" name="numeroPreferido"
                        value="<?= htmlspecialchars($player['numeroPreferido']) ?>">

                    <input type="submit" value="Guardar Cambios">

                </form>

            </div>
        </div>


        <script>
            // Obtener el modal
            var modal = document.getElementById("modalEditarPerfil");

            // Obtener el botón que abre el modal
            var btn = document.getElementById("editarInfoPersonal");

            // Obtener el elemento que cierra el modal
            var span = document.getElementsByClassName("close")[0];

            // Cuando el usuario hace clic en el botón, abre el modal 
            btn.onclick = function () {
                modal.style.display = "block";
            }

            // Cuando el usuario hace clic en <span> (x), cierra el modal
            span.onclick = function () {
                modal.style.display = "none";
            }

            // Cuando el usuario hace clic fuera del modal, cierra el modal
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>




        <!-- Modal para editar/añadir historial deportivo -->
        <div id="modalEditarHistorial" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Gestionar Historial Deportivo</h2>
                <!-- Formulario para añadir nuevo historial -->
                <h3>Añadir nuevo historial</h3>
                <form action="../controllers/editar_historial.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <label>Equipo:</label>
                    <input type="text" name="equipo" placeholder="Nombre del equipo">
                    <label>Temporada:</label>
                    <input type="text" name="temporada" placeholder="Temporada">
                    <label>Resultado:</label>
                    <input type="text" name="resultado" placeholder="Resultado">
                    <label>Escudo del equipo (URL):</label>
                    <input type="text" name="imagenEscudo" placeholder="Imagen escudo">
                    <button type="submit">Añadir al Historial</button>
                </form>
                <hr>
                <!-- Listado de historiales existentes para editar o eliminar -->
                <h3>Editar o eliminar historial existente</h3>
                <?php foreach ($historiales as $item): ?>
                    <div class="historial-item">
                        <form action="../controllers/editar_historial.php" method="POST">
                            <input type="hidden" name="historial_id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="action" value="update">
                            <label>Equipo:</label>
                            <input type="text" name="equipo" value="<?= htmlspecialchars($item['equipo']) ?>">
                            <label>Temporada:</label>
                            <input type="text" name="temporada" value="<?= htmlspecialchars($item['temporada']) ?>">
                            <label>Resultado:</label>
                            <input type="text" name="resultado" value="<?= htmlspecialchars($item['resultado']) ?>">
                            <label>Escudo del Equipo:</label>
                            <input type="text" name="imagenEscudo" value="<?= htmlspecialchars($item['imagenEscudo']) ?>">
                            <button type="submit">Actualizar</button>
                        </form>
                        <form action="../controllers/editar_historial.php" method="POST">
                            <input type="hidden" name="historial_id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit">Eliminar</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
            // Modal para Historial Deportivo
            var modalHistorial = document.getElementById("modalEditarHistorial");

            // Botón que abre el modal de Historial Deportivo
            var btnHistorial = document.getElementById("editarHistorial");

            // Botón de cierre en el modal de Historial Deportivo
            // Asumiendo que cada modal tiene su propio botón de cierre y no comparten el primer índice
            var spanHistorial = document.querySelector("#modalEditarHistorial .close");

            btnHistorial.onclick = function () {
                modalHistorial.style.display = "block";
            }

            spanHistorial.onclick = function () {
                modalHistorial.style.display = "none";
            }

            // Evento para cerrar el modal si el usuario hace clic fuera de él
            window.onclick = function (event) {
                if (event.target == modalHistorial) {
                    modalHistorial.style.display = "none";
                }
            }
        </script>







        <!-- Modal para editar ficha técnica del jugador -->
        <div id="modalEditarFichaTecnica" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form action="../controllers/guardar_cambios_fichaTecnica.php" method="POST">
                    <h2>Editar Ficha Técnica</h2>
                    <!-- Posición Habitual -->
                    <label for="posicionHabitual">Posición Habitual:</label>
                    <select id="posicionHabitual" name="posicion_habitual">
                        <?php
                        $positions = [
                            'Portero',
                            'Lateral Derecho',
                            'Lateral Izquierdo',
                            'Central Derecho',
                            'Central Izquierdo',
                            'Pivote Defensivo',
                            'Centrocampista Derecho',
                            'Centrocampista Izquierdo',
                            'Centrocampista Central',
                            'Mediapunta',
                            'Extremo Derecho',
                            'Extremo Izquierdo',
                            'Delantero Centro',
                            'Segundo Delantero'
                        ];
                        foreach ($positions as $position) {
                            $selected = ($position === ($fichaTecnica['posicion_habitual'] ?? '')) ? ' selected' : '';
                            echo "<option value='$position'$selected>$position</option>";
                        }
                        ?>
                    </select>
                    <!-- Posición Secundaria -->
                    <label for="posicionSecundaria">Posición Secundaria:</label>
                    <select id="posicionSecundaria" name="posicion_secundaria">
                        <?php
                        foreach ($positions as $position) {
                            $selected = ($position === ($fichaTecnica['posicion_secundaria'] ?? '')) ? ' selected' : '';
                            echo "<option value='$position'$selected>$position</option>";
                        }
                        ?>
                    </select>
                    <!-- Estilo de Juego -->
                    <label for="estiloDeJuego">Estilo de Juego:</label>
                    <select id="estiloDeJuego" name="estilo_de_juego">
                        <?php
                        $styles = ['Defensivo', 'Equilibrado', 'Ofensivo'];
                        foreach ($styles as $style) {
                            $selected = ($style === ($fichaTecnica['estilo_de_juego'] ?? '')) ? ' selected' : '';
                            echo "<option value='$style'$selected>$style</option>";
                        }
                        ?>
                    </select>
                    <!-- Campos de habilidades -->
                    <?php $skills = ['pases', 'tiros', 'velocidad', 'regate', 'defensa']; ?>
                    <?php foreach ($skills as $skill): ?>
                        <label for="<?= $skill ?>"><?= ucfirst($skill) ?>:</label>
                        <select id="<?= $skill ?>" name="<?= $skill ?>">
                            <?php
                            $skillValue = $fichaTecnica[$skill] ?? '';
                            for ($i = 1; $i <= 5; $i++) {
                                $selected = ($i == $skillValue) ? ' selected' : '';
                                echo "<option value='$i'$selected>$i</option>";
                            }
                            ?>
                        </select>
                    <?php endforeach; ?>
                    <!-- Notas Adicionales -->
                    <label for="notasAdicionales">Describe tus puntos fuertes:</label>
                    <textarea id="notasAdicionales"
                        name="notas_adicionales"><?= htmlspecialchars($fichaTecnica['notas_adicionales'] ?? '') ?></textarea>
                    <input type="submit" value="Guardar Cambios">
                </form>
            </div>
        </div>



        <script>
            // Obtener el modal
            var modalFT = document.getElementById("modalEditarFichaTecnica");

            // Obtener el botón que abre el modal
            var btnFT = document.getElementById("editarFichaTecnica");

            // Obtener el elemento que cierra el modal
            var spanFT = document.querySelector("#modalEditarFichaTecnica .close");

            // Cuando el usuario hace clic en el botón, abre el modal 
            btnFT.onclick = function () {
                modalFT.style.display = "block";
            }

            // Cuando el usuario hace clic en <span> (x), cierra el modal
            spanFT.onclick = function () {
                modalFT.style.display = "none";
            }

            // Cuando el usuario hace clic fuera del modal, cierra el modal
            window.onclick = function (event) {
                if (event.target == modalFT) {
                    modalFT.style.display = "none";
                }
            }
        </script>





        <!-- Modal para editar/añadir situación -->
        <div id="modalEditarSituacion" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Editar Situación</h2>

                <!-- Formulario para añadir nueva situación -->
                <form action="../controllers/guardar_cambios_situacion.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <label>Actividad:</label>
                    <input type="text" name="actividad" placeholder="Actividad">
                    <label>Lugar:</label>
                    <input type="text" name="lugar" placeholder="Lugar">
                    <label>Horario:</label>
                    <input type="text" name="horario" placeholder="Horario">
                    <button type="submit">Añadir Situación</button>
                </form>
                <hr>
                <!-- Formularios para editar o eliminar situaciones existentes -->
                <?php foreach ($situaciones as $situacion): ?>
                    <form action="../controllers/guardar_cambios_situacion.php" method="POST">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="situacion_id" value="<?= htmlspecialchars($situacion['id']) ?>">
                        <label>Actividad:</label>
                        <input type="text" name="actividad" value="<?= htmlspecialchars($situacion['actividad']) ?>">
                        <label>Lugar:</label>
                        <input type="text" name="lugar" value="<?= htmlspecialchars($situacion['lugar']) ?>">
                        <label>Horario:</label>
                        <input type="text" name="horario" value="<?= htmlspecialchars($situacion['horario']) ?>">
                        <button type="submit">Actualizar Situación</button>
                    </form>
                    <form action="../controllers/guardar_cambios_situacion.php" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="situacion_id" value="<?= htmlspecialchars($situacion['id']) ?>">
                        <button type="submit">Eliminar Situación</button>
                    </form>
                <?php endforeach; ?>


            </div>
        </div>

        <script>
            // Obtener el modal
            var modalSituacion = document.getElementById("modalEditarSituacion");

            // Obtener el botón que abre el modal
            var btnSituacion = document.getElementById("editarSituacion");

            // Obtener el elemento que cierra el modal
            var spanSituacion = document.querySelector("#modalEditarSituacion .close");

            // Cuando el usuario hace clic en el botón, abre el modal 
            btnSituacion.onclick = function () {
                modalSituacion.style.display = "block";
            }

            // Cuando el usuario hace clic en <span> (x), cierra el modal
            spanSituacion.onclick = function () {
                modalSituacion.style.display = "none";
            }

            // Cuando el usuario hace clic fuera del modal, cierra el modal
            window.onclick = function (event) {
                if (event.target == modalSituacion) {
                    modalSituacion.style.display = "none";
                }
            }
        </script>



</body>

</html>