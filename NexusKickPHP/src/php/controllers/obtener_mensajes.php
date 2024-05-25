<?php
include '../config/db.php'; // Asegúrate de que la conexión a la base de datos es correcta

$de_usuario_id = 1; // ID del usuario actual
$para_usuario_id = 2; // ID del otro usuario con quien está chateando

$sql = "SELECT m.*, u.apodo AS de_usuario, u2.apodo AS para_usuario
        FROM mensajes m
        JOIN usuarios u ON m.de_usuario_id = u.id
        JOIN usuarios u2 ON m.para_usuario_id = u2.id
        WHERE (m.de_usuario_id = '$de_usuario_id' AND m.para_usuario_id = '$para_usuario_id') 
           OR (m.de_usuario_id = '$para_usuario_id' AND m.para_usuario_id = '$de_usuario_id')
        ORDER BY m.fecha_envio ASC";
$result = $conn->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

foreach ($messages as $message) {
    echo "<div><strong>{$message['de_usuario']}:</strong> {$message['mensaje']} <small>{$message['fecha_envio']}</small></div>";
}

$conn->close();
?>
