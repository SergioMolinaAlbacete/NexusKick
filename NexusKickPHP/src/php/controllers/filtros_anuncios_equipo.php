<?php
include '../config/db.php';

// Recoger los datos del formulario
$pais = isset($_POST['pais']) ? $_POST['pais'] : '';
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
$estadio = isset($_POST['estadio']) ? $_POST['estadio'] : '';
$fundacion = isset($_POST['fundacion']) ? $_POST['fundacion'] : '';

// Construir la consulta SQL básica
$sql = "SELECT anuncios.*, usuarios.id AS usuario_id, usuarios.nombre, usuarios.ciudad, usuarios.perfil_url 
        FROM anuncios 
        JOIN usuarios ON anuncios.usuario_id = usuarios.id
        WHERE usuarios.tipo_usuario = 'equipo'";

// Añadir filtros si están presentes
if ($pais != '') {
    $sql .= " AND usuarios.pais = '$pais'";
}
if ($ciudad != '') {
    $sql .= " AND usuarios.ciudad LIKE '%$ciudad%'";
}
if ($estadio != '') {
    $sql .= " AND usuarios.estadio LIKE '%$estadio%'";
}
if ($fundacion != '') {
    $sql .= " AND usuarios.fundacion >= '$fundacion'";
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
    echo "<img src='" . (!empty($anuncio['perfil_url']) ? $anuncio['perfil_url'] : '../../img/escudoPredeterminado.jpg') . "' alt='perfil' class='perfil-imagen'>";
    echo "<div class='info-texto'>";
    echo "<h2>" . $anuncio['nombre'] . "</h2>";
    echo "<p>" . $anuncio['ciudad'] . "</p>";
    echo "</div>";
    echo "</div>";
    echo "<div class='anuncio-detalle'>";
    echo "<h3>" . $anuncio['titulo'] . "</h3>";
    echo "<p>" . $anuncio['descripcion'] . "</p>";
    echo "</div>";
    echo "<div class='anuncio-botones'>";
    echo "<div class='button-borders'>";
    echo "<a class='primary-button'>Contactar</a>";
    echo "<a href='./verPerfilEquipo.php?id=" . $anuncio['usuario_id'] . "' class='primary-button'>Ver Perfil</a>";
    echo "</div>";
    echo "</div>";
    echo "<p>" . $anuncio['fecha_publicacion'] . "</p>";
    echo "</div>";
}
?>
