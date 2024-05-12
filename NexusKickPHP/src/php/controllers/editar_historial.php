<?php
include '../config/db.php';

$historial_id = $_POST['historial_id'];
$action = $_POST['action'];

if ($action == 'update') {
    $equipo = $_POST['equipo'];
    $temporada = $_POST['temporada'];
    $resultado = $_POST['resultado'];

    $sql = "UPDATE historial_deportivo SET equipo = ?, temporada = ?, resultado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $equipo, $temporada, $resultado, $historial_id);
    $stmt->execute();

    echo "Historial actualizado.";
} elseif ($action == 'delete') {
    $sql = "DELETE FROM historial_deportivo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $historial_id);
    $stmt->execute();

    echo "Historial eliminado.";
}

header("Location: perfil.php?id=$usuario_id"); // Redirecciona de nuevo al perfil, asegúrate de pasar el `usuario_id` correctamente
?>
