<?php
include '../config/db.php';

$usuario1_id = $_POST['usuario1_id']; // ID del usuario actual (logueado)
$usuario2_id = $_POST['usuario2_id']; // ID del usuario que creó el anuncio

// Comprobar si la conversación ya existe
$sql = "SELECT id FROM conversaciones WHERE (usuario1_id = '$usuario1_id' AND usuario2_id = '$usuario2_id') OR (usuario1_id = '$usuario2_id' AND usuario2_id = '$usuario1_id')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // La conversación ya existe, no es necesario crear una nueva
    $row = $result->fetch_assoc();
    echo json_encode(['conversacion_id' => $row['id']]);
} else {
    // Crear una nueva conversación
    $sql = "INSERT INTO conversaciones (usuario1_id, usuario2_id, ultima_actividad) VALUES ('$usuario1_id', '$usuario2_id', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['conversacion_id' => $conn->insert_id]);
    } else {
        echo json_encode(['error' => $conn->error]);
    }
}

$conn->close();
?>
