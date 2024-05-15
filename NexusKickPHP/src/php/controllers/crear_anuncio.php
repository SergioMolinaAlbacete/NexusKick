<?php
include '../config/db.php';
session_start();

// Asegúrate de que la conexión a la base de datos es correcta
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir o manejar el caso de que el usuario no esté logueado
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['id_usuario'];  // Accede al ID del usuario desde la sesión

// Asegúrate de que los datos del POST existan
if (isset($_POST['titulo'], $_POST['descripcion'])) {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);

    // Inserta el nuevo anuncio en la base de datos con la fecha de publicación actual
    $sql = "INSERT INTO Anuncios (usuario_id, titulo, descripcion, fecha_publicacion) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("iss", $usuario_id, $titulo, $descripcion);
        if ($stmt->execute()) {
            header("Location: ../views/busquedaJugadores.php"); // Redireccionar después de insertar
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error de preparación: " . $conn->error;
    }
} else {
    echo "Todos los campos son requeridos.";
}

$conn->close();
?>
