<?php
include '../config/db.php';

$conversacion_id = $_GET['conversacion_id'];

$sql = "SELECT m.*, u.apodo AS de_usuario
        FROM mensajes m
        JOIN usuarios u ON m.de_usuario_id = u.id
        WHERE m.conversacion_id = '$conversacion_id'
        ORDER BY m.fecha_envio ASC";
$result = $conn->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);

$conn->close();
?>
