<?php
session_start();
include '../config/db.php'; // Asegúrate de que la conexión a la base de datos es correcta

$usuario_id = $_SESSION['id_usuario'];  // Accede al ID del usuario desde la sesión

// Recuperar y limpiar datos de entrada
$posicion_habitual = $conn->real_escape_string($_POST['posicion_habitual']);
$posicion_secundaria = $conn->real_escape_string($_POST['posicion_secundaria']);
$estilo_de_juego = $conn->real_escape_string($_POST['estilo_de_juego']);
$notas_adicionales = $conn->real_escape_string($_POST['notas_adicionales']);
$pases = (int) $_POST['pases'];
$tiros = (int) $_POST['tiros'];
$velocidad = (int) $_POST['velocidad'];
$regate = (int) $_POST['regate'];
$defensa = (int) $_POST['defensa'];

// Consulta SQL para actualizar los datos en la tabla ficha_tecnica
$sql = "UPDATE ficha_tecnica SET 
    posicion_habitual = ?, 
    posicion_secundaria = ?, 
    estilo_de_juego = ?, 
    notas_adicionales = ?, 
    pases = ?, 
    tiros = ?, 
    velocidad = ?, 
    regate = ?, 
    defensa = ? 
WHERE usuario_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssiiiiii", $posicion_habitual, $posicion_secundaria, $estilo_de_juego, $notas_adicionales, $pases, $tiros, $velocidad, $regate, $defensa, $usuario_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Ficha técnica actualizada correctamente.";
} else {
    echo "No se pudo actualizar la ficha técnica.";
}

$stmt->close();
$conn->close();

header("Location: ../views/perfilJugador.php"); // Redirecciona de nuevo al perfil del jugador
?>
