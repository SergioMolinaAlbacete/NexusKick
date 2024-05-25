// php/obtenerConversaciones.php
<?php
include '../config/db.php';
session_start();

$usuario_id = $_SESSION['id_usuario']; // ID del usuario autenticado


$sql = "SELECT c.*, u1.apodo AS usuario1, u2.apodo AS usuario2
        FROM conversaciones c
        JOIN usuarios u1 ON c.usuario1_id = u1.id
        JOIN usuarios u2 ON c.usuario2_id = u2.id
        WHERE c.usuario1_id = '$usuario_id' OR c.usuario2_id = '$usuario_id'
        ORDER BY c.ultima_actividad DESC";
$result = $conn->query($sql);

$conversaciones = [];
while ($row = $result->fetch_assoc()) {
    $conversaciones[] = $row;
}

echo json_encode($conversaciones);

$conn->close();
?>
