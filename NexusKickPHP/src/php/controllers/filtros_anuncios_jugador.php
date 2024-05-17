<?php
include '../config/db.php';

// Recoger los datos del formulario
$pais = isset($_POST['pais']) ? $_POST['pais'] : '';
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
$altura = isset($_POST['altura']) ? $_POST['altura'] : '';
$pierna_buena = isset($_POST['pierna_buena']) ? $_POST['pierna_buena'] : '';
$posicion_habitual = isset($_POST['posicion_habitual']) ? $_POST['posicion_habitual'] : '';
$posicion_secundaria = isset($_POST['posicion_secundaria']) ? $_POST['posicion_secundaria'] : '';
$estilo_de_juego = isset($_POST['estilo_de_juego']) ? $_POST['estilo_de_juego'] : '';
$pases = isset($_POST['pases']) ? $_POST['pases'] : '';
$tiros = isset($_POST['tiros']) ? $_POST['tiros'] : '';
$velocidad = isset($_POST['velocidad']) ? $_POST['velocidad'] : '';
$regate = isset($_POST['regate']) ? $_POST['regate'] : '';
$defensa = isset($_POST['defensa']) ? $_POST['defensa'] : '';

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
    $sql .= " AND ficha_tecnica.pases >= $pases";
}
if ($tiros != '') {
    $sql .= " AND ficha_tecnica.tiros >= $tiros";
}
if ($velocidad != '') {
    $sql .= " AND ficha_tecnica.velocidad >= $velocidad";
}
if ($regate != '') {
    $sql .= " AND ficha_tecnica.regate >= $regate";
}
if ($defensa != '') {
    $sql .= " AND ficha_tecnica.defensa >= $defensa";
}

$sql .= " ORDER BY anuncios.fecha_publicacion DESC";

$result = $conn->query($sql);

$anuncios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $anuncios[] = $row;
    }
}

foreach ($anuncios as $anuncio) {
    echo "<div class='anuncio-card'>";
    echo "<div class='perfil-info'>";
    echo "<img src='" . (!empty($anuncio['perfil_url']) ? $anuncio['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg') . "' alt='perfil' class='perfil-imagen'>";
    echo "<div class='info-texto'>";
    echo "<h2>" . $anuncio['nombre'] . " " . $anuncio['apellidos'] . "</h2>";
    echo "<p>" . $anuncio['edad'] . " años - " . $anuncio['ciudad'] . "</p>";
    echo "</div>";
    echo "</div>";
    echo "<div class='anuncio-detalle'>";
    echo "<h3>" . $anuncio['titulo'] . "</h3>";
    echo "<p>" . $anuncio['descripcion'] . "</p>";
    echo "</div>";
    echo "<div class='anuncio-botones'>";
    echo "<div class='button-borders'>";
    echo "<a class='primary-button'>Contactar</a>";
    echo "<a href='./verPerfilJugador.php?id=" . $anuncio['usuario_id'] . "' class='primary-button'>Ver Perfil</a>";
    echo "</div>";
    echo "</div>";
    echo "<p>" . $anuncio['fecha_publicacion'] . "</p>";
    echo "</div>";
}
?>
