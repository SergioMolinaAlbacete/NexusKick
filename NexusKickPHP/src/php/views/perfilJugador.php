<!DOCTYPE html>
<html lang="en">

<?php
include './componentes/headGeneral.php';
?>

<body>
    <?php
    include './componentes/header.php';
    ?>
    <h1>Perfil </h1>

    <!-- Bloque informacion personal -->
    <div className="player-profile">
        <div className="player-profile-column">
            <img src={player.imagen} alt={`${player.nombre}`} className="player-image" />
            <h1 className="player-nickname">{player.nombre}</h1> {/* Apodo del jugador */}
        </div>
        <div className="player-info">
            <h2>Información Personal</h2>
            <p><span className="info-label">Nombre Completo:</span> {player.nombreCompleto}</p>
            <p><span className="info-label">País:</span> {player.país}</p>
            <p><span className="info-label">Lugar de Nacimiento:</span> {player.lugarNacimiento}</p>
            <p><span className="info-label">Fecha de Nacimiento:</span> {player.fechaNacimiento}</p>
            <p><span className="info-label">Edad:</span> {player.edad}</p>
            <p><span className="info-label">Altura:</span> {player.altura}</p>
            <p><span className="info-label">Peso:</span> {player.peso}</p>
            <p><span className="info-label">Pierna Buena:</span> {player.piernaBuena}</p>
            <p><span className="info-label">Talla de Ropa:</span> {player.tallaRopa}</p>
            <p><span className="info-label">Talla de Calzado:</span> {player.tallaCalzado}</p>
            <p><span className="info-label">Número Preferido:</span> {player.númeroPreferido}</p>
        </div>
    </div>

    <!-- Bloque Historial -->
    <div className="player-history">
        <h2>Historial del jugador</h2>
        <div className="history-slider">
            {/* <button className="slide-arrow left-arrow">
                <img src={leftArrow} alt="Anterior" />
            </button> */}
            {historyData.map((item, index) => (
            <div className="history-card" key={index}>
                <img src="../Multimedia/real-madrid-escudo.webp" alt="Escudo del equipo" className="team-shield" />
                <h3>{item.equipo}</h3>
                <p>Temporada: {item.temporada}</p>
                <p>Resultado: {item.resultado}</p>
            </div>
            ))}
            {/* <button className="slide-arrow right-arrow">
                <img src={rightArrow} alt="Siguiente" />
            </button> */}
        </div>
    </div>

    <!-- Bloque Ficha Tecnica -->
    <div className="player-technical-info">
        <h2>Ficha Técnica</h2>
        <div className="technical-details">
            <div className="column">
                <p>Posición Habitual: {technicalInfo.position.primary} (Secundaria: {technicalInfo.position.secondary})</p>
                <p>Estilo de Juego: {technicalInfo.playStyle}</p>
            </div>
            <div className="column">
                <div className="skills">
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
    <div className="work-info">
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
    <div className="reviews">
        <h2>Reseñas</h2>
        <p>El mejor de la Historia⭐⭐⭐⭐⭐</p>
        <p>⭐⭐⭐⭐</p>
        {/* Añade más reseñas según sea necesario */}
    </div>
</body>

</html>