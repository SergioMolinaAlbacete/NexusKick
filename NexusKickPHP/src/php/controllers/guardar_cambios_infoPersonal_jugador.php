<?php
session_start();
include '../config/db.php'; // Asegúrate de que la conexión a la base de datos es correcta
$usuario_id = $_SESSION['id_usuario'];  // Aquí accedes al ID del usuario desde la sesión

// Recuperar y limpiar datos de entrada
$nombre = $conn->real_escape_string($_POST['nombre']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$apodo = $conn->real_escape_string($_POST['apodo']);
$pais = $conn->real_escape_string($_POST['pais']);
$ciudad = $conn->real_escape_string($_POST['ciudad']);
$edad = $conn->real_escape_string($_POST['edad']);
$altura = $conn->real_escape_string($_POST['altura']);
$peso = $conn->real_escape_string($_POST['peso']);
$piernaBuena = $conn->real_escape_string($_POST['piernaBuena']);
$tallaRopa = $conn->real_escape_string($_POST['tallaRopa']);
$tallaCalzado = $conn->real_escape_string($_POST['tallaCalzado']);
$numeroPreferido = $conn->real_escape_string($_POST['numeroPreferido']);
$perfil_url = $conn->real_escape_string($_POST['perfil_url']);


// Consulta SQL para actualizar los datos
$sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, apodo = ?, pais = ?, ciudad = ?, edad = ?, altura = ?, peso = ?, piernaBuena = ?, tallaRopa = ?, tallaCalzado = ?, numeroPreferido = ?, perfil_url = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssisssssssi", $nombre, $apellidos, $apodo, $pais, $ciudad, $edad, $altura, $peso, $piernaBuena, $tallaRopa, $tallaCalzado, $numeroPreferido, $perfil_url, $usuario_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Perfil actualizado correctamente.";
} else {
    echo "No se pudo actualizar el perfil.";
}

$stmt->close();
$conn->close();

header("Location: ../views/perfilJugador.php"); // Redirecciona de nuevo al perfil
?>
