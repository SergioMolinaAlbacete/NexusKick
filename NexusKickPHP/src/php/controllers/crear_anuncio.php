<?php
include '../config/db.php';session_start();
include '../config/db.php'; // Asegúrate de que la conexión a la base de datos es correcta
$usuario_id = $_SESSION['id_usuario'];  // Accede al ID del usuario desde la sesión


// Asegúrate de que los datos del POST existan
if (isset($_POST['titulo'], $_POST['descripcion'])) {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $usuario_id = $_SESSION['id_usuario']; // Asegúrate de que el usuario está logueado

    // Inserta el nuevo anuncio en la base de datos
    $sql = "INSERT INTO Anuncios (usuario_id, titulo, descripcion) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $usuario_id, $titulo, $descripcion);
    if ($stmt->execute()) {
        header("Location: ../views/busquedaJugadores.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Todos los campos son requeridos.";
}

$conn->close();
?>
