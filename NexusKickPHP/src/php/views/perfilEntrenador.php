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
    $entrenador = $resultado->fetch_assoc();
    ?>



    <div class="titulo-container">
        <h1>Perfil de <?= $entrenador['nombre'] ?> <?= $entrenador['apellidos'] ?></h1>
    </div>
    <!-- Bloque información personal -->
    <div class="player-profile">
        <div class="player-profile-column">
            <img src="<?= !empty($entrenador['perfil_url']) ? $entrenador['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg' ?>" alt="<?= htmlspecialchars($entrenador['nombre']) ?>" class="player-image" />
            <h2 class="player-nickname"><?= $entrenador['apodo'] ?></h2>
        </div>
        <div class="player-info">
            <h2>Información Personal<button id="editarInfoPersonal">Editar</button></h2>
            <p><span class="info-label">Nombre Completo:</span> <?= $entrenador['nombre'] ?> <?= $entrenador['apellidos'] ?></p>
            <p><span class="info-label">País de Nacimiento:</span> <?= $entrenador['pais'] ?></p>
            <p><span class="info-label">Lugar de Nacimiento:</span> <?= $entrenador['ciudad'] ?></p>
            <p><span class="info-label">Fecha de Nacimiento:</span> <?= $entrenador['fnacimiento'] ?></p>
            <p><span class="info-label">Edad:</span> <?= $entrenador['edad'] ?> años</p>
            <p><span class="info-label">Experiencia:</span> <?= $entrenador['experiencia'] ?> años</p>
            <p><span class="info-label">Especialidad:</span> <?= $entrenador['especialidad'] ?></p>
            <p><span class="info-label">Talla de Ropa:</span> <?= $entrenador['tallaRopa'] ?></p>
            <p><span class="info-label">Talla de Calzado:</span> <?= $entrenador['tallaCalzado'] ?></p>

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



        <!-------------------------------------------------------------------------MODALES ----------------------------------------------------------------------------->

        <!-- Modal para editar perfil datos personales-->
        <div id="modalEditarPerfil" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form action="../controllers/guardar_cambios_infoPersonal_entrenador.php" method="POST">
                    <h2>Editar Perfil</h2>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($entrenador['nombre']) ?>">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($entrenador['apellidos']) ?>">
                    <label for="apodo">Apodo Futbolístico:</label>
                    <input type="text" id="apodo" name="apodo" value="<?= htmlspecialchars($entrenador['apodo']) ?>">
                    <label for="perfil_url">Foto de Perfil:</label>
                    <input type="text" id="perfil_url" name="perfil_url" value="<?= htmlspecialchars($entrenador['perfil_url']) ?>">
                    <label for="pais">País de Nacimiento:</label>
                    <select id="pais" name="pais">
                        <option value="">Seleccionar país</option>
                        <option value="albania" <?= $entrenador['pais'] === 'albania' ? 'selected' : '' ?>>Albania</option>
                        <option value="alemania" <?= $entrenador['pais'] === 'alemania' ? 'selected' : '' ?>>Alemania</option>
                        <option value="andorra" <?= $entrenador['pais'] === 'andorra' ? 'selected' : '' ?>>Andorra</option>
                        <option value="austria" <?= $entrenador['pais'] === 'austria' ? 'selected' : '' ?>>Austria</option>
                        <option value="bélgica" <?= $entrenador['pais'] === 'bélgica' ? 'selected' : '' ?>>Bélgica</option>
                        <option value="bielorrusia" <?= $entrenador['pais'] === 'bielorrusia' ? 'selected' : '' ?>>Bielorrusia
                        </option>
                        <option value="bosnia" <?= $entrenador['pais'] === 'bosnia' ? 'selected' : '' ?>>Bosnia y Herzegovina
                        </option>
                        <option value="bulgaria" <?= $entrenador['pais'] === 'bulgaria' ? 'selected' : '' ?>>Bulgaria</option>
                        <option value="croacia" <?= $entrenador['pais'] === 'croacia' ? 'selected' : '' ?>>Croacia</option>
                        <option value="dinamarca" <?= $entrenador['pais'] === 'dinamarca' ? 'selected' : '' ?>>Dinamarca
                        </option>
                        <option value="eslovaquia" <?= $entrenador['pais'] === 'eslovaquia' ? 'selected' : '' ?>>Eslovaquia
                        </option>
                        <option value="eslovenia" <?= $entrenador['pais'] === 'eslovenia' ? 'selected' : '' ?>>Eslovenia
                        </option>
                        <option value="españa" <?= $entrenador['pais'] === 'españa' ? 'selected' : '' ?>>España</option>
                        <option value="estonia" <?= $entrenador['pais'] === 'estonia' ? 'selected' : '' ?>>Estonia</option>
                        <option value="finlandia" <?= $entrenador['pais'] === 'finlandia' ? 'selected' : '' ?>>Finlandia
                        </option>
                        <option value="francia" <?= $entrenador['pais'] === 'francia' ? 'selected' : '' ?>>Francia</option>
                        <option value="grecia" <?= $entrenador['pais'] === 'grecia' ? 'selected' : '' ?>>Grecia</option>
                        <option value="hungría" <?= $entrenador['pais'] === 'hungría' ? 'selected' : '' ?>>Hungría</option>
                        <option value="irlanda" <?= $entrenador['pais'] === 'irlanda' ? 'selected' : '' ?>>Irlanda</option>
                        <option value="islandia" <?= $entrenador['pais'] === 'islandia' ? 'selected' : '' ?>>Islandia</option>
                        <option value="italia" <?= $entrenador['pais'] === 'italia' ? 'selected' : '' ?>>Italia</option>
                        <option value="letonia" <?= $entrenador['pais'] === 'letonia' ? 'selected' : '' ?>>Letonia</option>
                        <option value="liechtenstein" <?= $entrenador['pais'] === 'liechtenstein' ? 'selected' : '' ?>>
                            Liechtenstein</option>
                        <option value="lituania" <?= $entrenador['pais'] === 'lituania' ? 'selected' : '' ?>>Lituania</option>
                        <option value="luxemburgo" <?= $entrenador['pais'] === 'luxemburgo' ? 'selected' : '' ?>>Luxemburgo
                        </option>
                        <option value="malta" <?= $entrenador['pais'] === 'malta' ? 'selected' : '' ?>>Malta</option>
                        <option value="moldavia" <?= $entrenador['pais'] === 'moldavia' ? 'selected' : '' ?>>Moldavia</option>
                        <option value="mónaco" <?= $entrenador['pais'] === 'mónaco' ? 'selected' : '' ?>>Mónaco</option>
                        <option value="montenegro" <?= $entrenador['pais'] === 'montenegro' ? 'selected' : '' ?>>Montenegro
                        </option>
                        <option value="noruega" <?= $entrenador['pais'] === 'noruega' ? 'selected' : '' ?>>Noruega</option>
                        <option value="países-bajos" <?= $entrenador['pais'] === 'países-bajos' ? 'selected' : '' ?>>Países
                            Bajos</option>
                        <option value="polonia" <?= $entrenador['pais'] === 'polonia' ? 'selected' : '' ?>>Polonia</option>
                        <option value="portugal" <?= $entrenador['pais'] === 'portugal' ? 'selected' : '' ?>>Portugal</option>
                        <option value="reino-unido" <?= $entrenador['pais'] === 'reino-unido' ? 'selected' : '' ?>>Reino Unido
                        </option>
                        <option value="república-checa" <?= $entrenador['pais'] === 'república-checa' ? 'selected' : '' ?>>
                            República Checa</option>
                        <option value="rumanía" <?= $entrenador['pais'] === 'rumanía' ? 'selected' : '' ?>>Rumanía</option>
                        <option value="rusia" <?= $entrenador['pais'] === 'rusia' ? 'selected' : '' ?>>Rusia</option>
                        <option value="san-marino" <?= $entrenador['pais'] === 'san-marino' ? 'selected' : '' ?>>San Marino
                        </option>
                        <option value="serbia" <?= $entrenador['pais'] === 'serbia' ? 'selected' : '' ?>>Serbia</option>
                        <option value="suecia" <?= $entrenador['pais'] === 'suecia' ? 'selected' : '' ?>>Suecia</option>
                        <option value="suiza" <?= $entrenador['pais'] === 'suiza' ? 'selected' : '' ?>>Suiza</option>
                        <option value="ucrania" <?= $entrenador['pais'] === 'ucrania' ? 'selected' : '' ?>>Ucrania</option>
                    </select>

                    <label for="ciudad">Ciudad de Nacimiento:</label>
                    <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($entrenador['ciudad']) ?>">
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" value="<?= htmlspecialchars($entrenador['edad']) ?>">
                    <label for="experiencia">Experiencia:</label>
                    <input type="number" id="experiencia" name="experiencia" value="<?= htmlspecialchars($entrenador['experiencia']) ?>">

                    <label for="especialidad">Especialidad:</label>
                    <select id="especialidad" name="especialidad">
                        <option value="">Seleccionar</option>
                        <option value="Entrenador Principal" <?= $entrenador['especialidad'] === 'Entrenador Principal' ? 'selected' : '' ?>>Entrenador Principal</option>
                        <option value="Preparador Físico" <?= $entrenador['especialidad'] === 'Preparador Físico' ? 'selected' : '' ?>>Preparador Físico</option>
                        <option value="Entrenador de Porteros" <?= $entrenador['especialidad'] === 'Entrenador de Porteros' ? 'selected' : '' ?>>Entrenador de Porteros</option>
                        <option value="Segundo Entrenador" <?= $entrenador['especialidad'] === 'Segundo Entrenador' ? 'selected' : '' ?>>Segundo Entrenador</option>
                        <option value="Psicólogo Deportivo" <?= $entrenador['especialidad'] === 'Psicólogo Deportivo' ? 'selected' : '' ?>>Psicólogo Deportivo</option>
                    </select>
                    <label for="tallaRopa">Talla de Ropa:</label>
                    <select id="tallaRopa" name="tallaRopa">
                        <option value="">Seleccionar</option>
                        <option value="XS" <?= $entrenador['tallaRopa'] === 'XS' ? 'selected' : '' ?>>XS</option>
                        <option value="S" <?= $entrenador['tallaRopa'] === 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $entrenador['tallaRopa'] === 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $entrenador['tallaRopa'] === 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $entrenador['tallaRopa'] === 'XL' ? 'selected' : '' ?>>XL</option>
                        <option value="XXL" <?= $entrenador['tallaRopa'] === 'XXL' ? 'selected' : '' ?>>XXL</option>
                    </select>
                    <label for="tallaCalzado">Talla de Calzado:</label>
                    <input type="number" id="tallaCalzado" name="tallaCalzado" value="<?= htmlspecialchars($entrenador['tallaCalzado']) ?>">


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
                <?php foreach ($historiales as $item) : ?>
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

            btnHistorial.onclick = function() {
                modalHistorial.style.display = "block";
            }

            spanHistorial.onclick = function() {
                modalHistorial.style.display = "none";
            }

            // Evento para cerrar el modal si el usuario hace clic fuera de él
            window.onclick = function(event) {
                if (event.target == modalHistorial) {
                    modalHistorial.style.display = "none";
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
                <?php foreach ($situaciones as $situacion) : ?>
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
            btnSituacion.onclick = function() {
                modalSituacion.style.display = "block";
            }

            // Cuando el usuario hace clic en <span> (x), cierra el modal
            spanSituacion.onclick = function() {
                modalSituacion.style.display = "none";
            }

            // Cuando el usuario hace clic fuera del modal, cierra el modal
            window.onclick = function(event) {
                if (event.target == modalSituacion) {
                    modalSituacion.style.display = "none";
                }
            }
        </script>



</body>

</html>