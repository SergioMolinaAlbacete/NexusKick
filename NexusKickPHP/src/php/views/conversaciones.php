<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

include '../config/db.php';

$id_usuario = $_SESSION['id_usuario'];

// Obtener conversaciones del usuario
$stmt = $conn->prepare("
    SELECT c.id, u1.nombre AS usuario1, u2.nombre AS usuario2, c.ultima_actividad 
    FROM conversaciones c
    JOIN usuarios u1 ON c.usuario1_id = u1.id
    JOIN usuarios u2 ON c.usuario2_id = u2.id
    WHERE c.usuario1_id = ? OR c.usuario2_id = ?
    ORDER BY c.ultima_actividad DESC
");
$stmt->bind_param("ii", $id_usuario, $id_usuario);
$stmt->execute();
$conversaciones = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conversaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Tus Conversaciones</h1>
    <div class="conversations">
        <?php foreach ($conversaciones as $conversacion): ?>
            <div class="conversation">
                <a href="conversacion.php?id=<?= $conversacion['id'] ?>">
                    <?php
                    $contact_name = ($conversacion['usuario1'] === $_SESSION['nombre_usuario']) ? $conversacion['usuario2'] : $conversacion['usuario1'];
                    echo htmlspecialchars($contact_name);
                    ?>
                </a>
                <span><?= $conversacion['ultima_actividad'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
