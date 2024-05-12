<?php
include '../config/db.php'; // Asegúrate de que la conexión a la base de datos es correcta

$usuario_id = $_POST['usuario_id']; // Asegúrate de tener este campo en tu formulario o sesión
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
// Asegúrate de validar y limpiar todos los campos correctamente

$sql = "UPDATE usuarios SET nombre = ?, apellidos = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $nombre, $apellidos, $usuario_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Perfil actualizado correctamente.";
} else {
    echo "No se pudo actualizar el perfil.";
}

header("Location: perfil.php?id=$usuario_id"); // Redirecciona de nuevo al perfil
?>
