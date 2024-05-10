<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>anuncios</title>
    <link rel="stylesheet" href="./../../css/general.css">
    <link rel="stylesheet" href="./../../css/header.css">
    <link rel="stylesheet" href="./../../css/perfil.css">

</head>

<body>
    <?php
    include './componentes/header.php';
    ?>
    <h1>Perfil </h1>

    <!-- Bloque informacion personal -->
    <div class="player-profile">
        <div class="player-profile-column">
            <img src="" alt="" class="player-image" />
            <h1 class="player-nickname">{player.nombre}</h1> {/* Apodo del jugador */}
        </div>
        <div class="player-info">
            <h2>Información Personal</h2>
            <p><span class="info-label">Nombre Completo:</span> {player.nombreCompleto}</p>
            <p><span class="info-label">País:</span> {player.país}</p>
            <p><span class="info-label">Lugar de Nacimiento:</span> {player.lugarNacimiento}</p>
            <p><span class="info-label">Fecha de Nacimiento:</span> {player.fechaNacimiento}</p>
            <p><span class="info-label">Edad:</span> {player.edad}</p>
            <p><span class="info-label">Altura:</span> {player.altura}</p>
            <p><span class="info-label">Peso:</span> {player.peso}</p>
            <p><span class="info-label">Pierna Buena:</span> {player.piernaBuena}</p>
            <p><span class="info-label">Talla de Ropa:</span> {player.tallaRopa}</p>
            <p><span class="info-label">Talla de Calzado:</span> {player.tallaCalzado}</p>
            <p><span class="info-label">Número Preferido:</span> {player.númeroPreferido}</p>
        </div>
    </div>

    <!-- Bloque Historial -->
    <div class="player-history">
        <h2>Historial del jugador</h2>
        <div class="history-slider">
         <button class="slide-arrow left-arrow">
                <img src="" alt="Anterior" />
            </button>

            <div class="history-card" key={index}>
                <img src="" alt="Escudo del equipo" class="team-shield" />
                <h3>{item.equipo}</h3>
                <p>Temporada: {item.temporada}</p>
                <p>Resultado: {item.resultado}</p>
            </div>

            <button class="slide-arrow right-arrow">
                <img src=""alt="Siguiente" />
            </button>
        </div>
    </div>

    <!-- Bloque Ficha Tecnica -->
    <div class="player-technical-info">
        <h2>Ficha Técnica</h2>
        <div class="technical-details">
            <div class="column">
                <p>Posición Habitual: {technicalInfo.position.primary} (Secundaria: {technicalInfo.position.secondary})</p>
                <p>Estilo de Juego: {technicalInfo.playStyle}</p>
            </div>
            <div class="column">
                <div class="skills">
                    <h3>Habilidades Técnicas</h3>
                    <p>Pases: {technicalInfo.skills.passing}</p>
                    <p>Tiros: {technicalInfo.skills.shooting}</p>
                    <p>Velocidad: {technicalInfo.skills.pace}</p>
                    <p>Regate: {technicalInfo.skills.dribbling}</p>
                    <p>Defensa: {technicalInfo.skills.defending}</p>
                </div>
                <p>Notas Adicionales: {technicalInfo.additionalNotes}</p>
            </div>
        </div>
    </div>

    <!-- Bloque Situacion -->
    <div class="work-info">
        <h2>Situación Laboral y/o Estudio</h2>
        <table>
            <tbody>
                <tr>
                    <td>Actividad</td>
                    <td>Ciclo superior DAW</td>
                </tr>
                <tr>
                    <td>Lugar</td>
                    <td>EIG Business School</td>
                </tr>
                <tr>
                    <td>Horario</td>
                    <td>08:15 - 14:45</td>
                </tr>
            </tbody>
        </table>
    </div>



    <!-- Bloque Reseñas -->
    <div class="reviews">
        <h2>Reseñas</h2>
        <p>El mejor de la Historia⭐⭐⭐⭐⭐</p>
        <p>⭐⭐⭐⭐</p>
        {/* Añade más reseñas según sea necesario */}
    </div>
</body>

</html>