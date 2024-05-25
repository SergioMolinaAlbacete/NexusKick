<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $de_usuario_id = $_SESSION['id_usuario']; // ID del usuario actual (logueado)
    $conversacion_id = $_POST['conversacion_id'];
    $mensaje = $conn->real_escape_string($_POST['mensaje']); // Sanitización del input

    if (!empty($mensaje)) {
        $sql = "INSERT INTO mensajes (conversacion_id, de_usuario_id, mensaje, fecha_envio) 
                VALUES ('$conversacion_id', '$de_usuario_id', '$mensaje', NOW())";
        if ($conn->query($sql) === TRUE) {
            echo "Mensaje enviado";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "El mensaje no puede estar vacío";
    }
} else {
    echo "Método de solicitud no permitido";
}

$conn->close();
?>
