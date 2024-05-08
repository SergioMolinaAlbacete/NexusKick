<?php
include '../config/db.php';

$sql = "SELECT Anuncios.titulo, Anuncios.descripcion, Anuncios.fecha_publicacion, Usuarios.nombre, Usuarios.edad, Usuarios.ciudad, Usuarios.perfil_url 
FROM Anuncios 
JOIN Usuarios ON Anuncios.usuario_id = Usuarios.id
WHERE Usuarios.tipo_usuario = 'jugador';
";
$result = $conn->query($sql);

$anuncios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $anuncios[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<?php
include './componentes/headGeneral.php';
?>

<body>
    <?php
    include './componentes/header.php';
    ?>
    <h1>Búsqueda Jugadores</h1>
    <div class='tablon'>
        <div class="card-container">
            <?php foreach ($anuncios as $anuncio) : ?>
                <div class="anuncio-card">
                    <div class="perfil-info">
                        <img src="<?= htmlspecialchars($anuncio['perfil_url']) ?>" alt="perfil" class="perfil-imagen">
                        <div class="info-texto">
                            <h2><?= $anuncio['nombre'] ?></h2>
                            <p><?= $anuncio['edad'] ?> años - <?= $anuncio['ciudad'] ?></p>
                        </div>
                    </div>
                    <div class="anuncio-detalle">
                        <h3><?= $anuncio['titulo'] ?></h3>
                        <p><?= $anuncio['descripcion'] ?></p>
                    </div>
                    <div class="anuncio-botones">
                        <div class="button-borders">
                            <button class="primary-button">Contactar</button>
                            <button class="primary-button">Ver Perfil</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>