<?php
require '../config/db.php';

$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

if (empty($searchTerm)) {
    echo "<script>
            alert('No se ha proporcionado un término de búsqueda.');
            window.history.back();
          </script>";
    exit;
}

// Dividir el término de búsqueda en palabras
$searchWords = explode(' ', $searchTerm);

// Construir la consulta SQL dinámica
$sql = "SELECT * FROM usuarios WHERE ";
$conditions = [];
$params = [];
$types = '';

foreach ($searchWords as $word) {
    $conditions[] = "(nombre LIKE ? OR apellidos LIKE ?)";
    $param = '%' . $word . '%';
    $params[] = $param;
    $params[] = $param;
    $types .= 'ss';
}

$sql .= implode(' AND ', $conditions);

// Preparar y ejecutar la consulta
$query = $conn->prepare($sql);
$query->bind_param($types, ...$params);
$query->execute();
$result = $query->get_result();
$results = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Búsqueda | NexusKick</title>
    <link rel="stylesheet" href="./../../css/header.css">
    <link rel="stylesheet" href="./../../css/general.css">
    <link rel="stylesheet" href="./../../css/Anuncio.css">
</head>
<body>
    <?php include './componentes/header.php'; ?>
    <div class="resultados-container">
        <h1>Resultados de Búsqueda</h1>
        <?php if (count($results) > 0): ?>
            <div class="card-container">
                <?php foreach ($results as $user): ?>
                    <div class="anuncio-card" style="margin:20px;">
                        <div class="perfil-info">
                            <img src="<?= !empty($user['perfil_url']) ? $user['perfil_url'] : '../../img/imagenPerfilPredeterminada.jpg' ?>" alt="perfil" class="perfil-imagen">
                            <div class="info-texto">
                                <h2><?= htmlspecialchars($user['nombre']) ?> <?= htmlspecialchars($user['apellidos']) ?></h2>
                                <p><?= htmlspecialchars($user['ciudad']) ?></p>
                            </div>
                        </div>
                        <div class="anuncio-botones">
                            <?php
                            // Determinar la URL del perfil según el tipo de usuario
                            $profile_url = '';
                            switch ($user['tipo_usuario']) {
                                case 'jugador':
                                    $profile_url = 'verPerfilJugador.php';
                                    break;
                                case 'entrenador':
                                    $profile_url = 'verPerfilEntrenador.php';
                                    break;
                                case 'equipo':
                                    $profile_url = 'verPerfilEquipo.php';
                                    break;
                            }
                            ?>
                            <a href="<?= $profile_url ?>?id=<?= htmlspecialchars($user['id']) ?>" class="primary-button">Ver Perfil</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center;">No se encontraron resultados para "<?= htmlspecialchars($searchTerm) ?>"</p>
        <?php endif; ?>
    </div>
</body>
</html>
