<?php
include '../config/db.php';

session_start();
$usuario_id = $_SESSION['id_usuario'];

$action = $_POST['action'];

switch ($action) {
    case 'create':
        // Recibir datos para un nuevo historial
        $equipo = $_POST['equipo'];
        $temporada = $_POST['temporada'];
        $resultado = $_POST['resultado'];
        $imagenEscudo = $_POST['imagenEscudo']; // Recibir la URL de la imagen del escudo

        // SQL para insertar un nuevo registro
        $sql = "INSERT INTO historial_deportivo (usuario_id, equipo, temporada, resultado, imagenEscudo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $usuario_id, $equipo, $temporada, $resultado, $imagenEscudo);
        $stmt->execute();
        break;
    
    case 'update':
        // Recibir datos para actualizar un registro existente
        $historial_id = $_POST['historial_id'];
        $equipo = $_POST['equipo'];
        $temporada = $_POST['temporada'];
        $resultado = $_POST['resultado'];
        $imagenEscudo = $_POST['imagenEscudo']; // Recibir la URL de la imagen del escudo actualizada

        // SQL para actualizar el registro
        $sql = "UPDATE historial_deportivo SET equipo = ?, temporada = ?, resultado = ?, imagenEscudo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $equipo, $temporada, $resultado, $imagenEscudo, $historial_id);
        $stmt->execute();
        break;
    
    case 'delete':
        // Eliminar un registro existente
        $historial_id = $_POST['historial_id'];
        
        // SQL para eliminar el registro
        $sql = "DELETE FROM historial_deportivo WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $historial_id);
        $stmt->execute();
        break;
}

$stmt->close();
$conn->close();
header("Location: ../views/perfilJugador.php"); // Redirecciona de nuevo al perfil, asegúrate de pasar el `usuario_id` correctamente
?>
