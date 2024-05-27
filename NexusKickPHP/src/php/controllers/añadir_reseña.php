<?php
session_start();
include '../config/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $de_usuario_id = $_POST['de_usuario_id'];
    $para_usuario_id = $_POST['para_usuario_id'];
    $reseña = $_POST['reseña'];
    $puntuacion = $_POST['puntuacion'];
    $fecha = date('Y-m-d H:i:s');

    $sql = "INSERT INTO reseñas (de_usuario_id, para_usuario_id, reseña, puntuacion, fecha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iisss', $de_usuario_id, $para_usuario_id, $reseña, $puntuacion, $fecha);

    if ($stmt->execute()) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
