<?php
include '../config/db.php';  // Asegúrate de que este archivo contiene la conexión a la base de datos

session_start();
$usuario_id = $_SESSION['id_usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];

// Asegurarse de que se recibió una acción a través del método POST
if (!isset($_POST['action'])) {
    // Redireccionar a una página de error o manejar la falta de acción de alguna manera
    header("Location: ../views/error.php");
    exit;
}

$action = $_POST['action'];

switch ($action) {
    case 'create':
        // Recibir datos para un nuevo registro
        $actividad = $_POST['actividad'];
        $lugar = $_POST['lugar'];
        $horario = $_POST['horario'];

        // SQL para insertar un nuevo registro en la tabla situacion_academica_laboral
        $sql = "INSERT INTO situacion_academica_laboral (usuario_id, actividad, lugar, horario) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isss", $usuario_id, $actividad, $lugar, $horario);
            if ($stmt->execute()) {
                // Redireccionar según el tipo de usuario
                redirectBasedOnUserType($tipo_usuario, $usuario_id);
            } else {
                // Manejar el error de ejecución aquí
                header("Location: ../views/error.php");
            }
            $stmt->close();
        } else {
            // Manejar el error de preparación aquí
            header("Location: ../views/error.php");
        }
        break;
    
    case 'update':
        // Recibir datos para actualizar un registro existente
        $situacion_id = $_POST['situacion_id'];
        $actividad = $_POST['actividad'];
        $lugar = $_POST['lugar'];
        $horario = $_POST['horario'];

        // SQL para actualizar el registro en la tabla situacion_academica_laboral
        $sql = "UPDATE situacion_academica_laboral SET actividad = ?, lugar = ?, horario = ? WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssi", $actividad, $lugar, $horario, $situacion_id);
            if ($stmt->execute()) {
                // Redireccionar según el tipo de usuario
                redirectBasedOnUserType($tipo_usuario, $usuario_id);
            } else {
                // Manejar el error de ejecución aquí
                header("Location: ../views/error.php");
            }
            $stmt->close();
        } else {
            // Manejar el error de preparación aquí
            header("Location: ../views/error.php");
        }
        break;
    
    case 'delete':
        // Recibir ID del registro a eliminar
        $situacion_id = $_POST['situacion_id'];

        // SQL para eliminar el registro de la tabla situacion_academica_laboral
        $sql = "DELETE FROM situacion_academica_laboral WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $situacion_id);
            if ($stmt->execute()) {
                // Redireccionar según el tipo de usuario
                redirectBasedOnUserType($tipo_usuario, $usuario_id);
            } else {
                // Manejar el error de ejecución aquí
                header("Location: ../views/error.php");
            }
            $stmt->close();
        } else {
            // Manejar el error de preparación aquí
            header("Location: ../views/error.php");
        }
        break;
}

$conn->close();

function redirectBasedOnUserType($tipo_usuario, $usuario_id) {
    switch ($tipo_usuario) {
        case 'jugador':
            header("Location: ../views/perfilJugador.php?id=$usuario_id");
            break;
        case 'entrenador':
            header("Location: ../views/perfilEntrenador.php?id=$usuario_id");
            break;
        case 'equipo':
            header("Location: ../views/perfilEquipo.php?id=$usuario_id");
            break;
        default:
            header("Location: ../index.php");
            break;
    }
    exit;
}
?>
