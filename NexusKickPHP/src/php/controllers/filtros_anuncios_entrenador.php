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
        WHERE usuarios.tipo_usuario = 'entrenador'";

// Añadir filtros si están presentes
if ($pais != '') {
    $sql .= " AND usuarios.pais = '" . $conn->real_escape_string($pais) . "'";
}
if ($ciudad != '') {
    $sql .= " AND usuarios.ciudad LIKE '%" . $conn->real_escape_string($ciudad) . "%'";
}
if ($experiencia != '') {
    $sql .= " AND usuarios.experiencia >= " . intval($experiencia);
}
if ($especialidad != '') {
    $sql .= " AND usuarios.especialidad LIKE '%" . $conn->real_escape_string($especialidad) . "%'";
}

$sql .= " ORDER BY anuncios.fecha_publicacion DESC";

$result = $conn->query($sql);

$anuncios = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $anuncios[] = $row;
    }
} else {
    echo "No se encontraron resultados.";
}

foreach ($anuncios as $anuncio) {
    echo "<div class='anuncio-card'>";
    echo "<div class='perfil-info'>";
    echo "<img src='" . (!empty($anuncio['perfil_url']) ? $anuncio['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg') . "' alt='perfil' class='perfil-imagen'>";
    echo "<div class='info-texto'>";
    echo "<h2>" . htmlspecialchars($anuncio['nombre']) . " " . htmlspecialchars($anuncio['apellidos']) . "</h2>";
    echo "<p>" . htmlspecialchars($anuncio['edad']) . " años - " . htmlspecialchars($anuncio['ciudad']) . "</p>";
    echo "</div>";
    echo "</div>";
    echo "<div class='anuncio-detalle'>";
    echo "<h3>" . htmlspecialchars($anuncio['titulo']) . "</h3>";
    echo "<p>" . htmlspecialchars($anuncio['descripcion']) . "</p>";
    echo "</div>";
    echo "<div class='anuncio-botones'>";
    echo "<div class='button-borders'>";
    echo "<a class='primary-button'>Contactar</a>";
    echo "<a href='./verPerfilEntrenador.php?id=" . htmlspecialchars($anuncio['usuario_id']) . "' class='primary-button'>Ver Perfil</a>";
    echo "</div>";
    echo "</div>";
    echo "<p>" . htmlspecialchars($anuncio['fecha_publicacion']) . "</p>";
    echo "</div>";
}
?>
