import React from 'react';
import './PlayerTechnicalInfo.css';  // Asegúrate de incluir los estilos adecuados

const PlayerTechnicalInfo = () => {
  const technicalInfo = {
    position: {
      primary: "Centrocampista",
      secondary: "Delantero"
    },
    playStyle: "Ofensivo, Control del balón",
    skills: {
      passing: "Alto",
      shooting: "Medio",
      pace: "Alto",
      dribbling: "Alto",
      defending: "Bajo"
    },
    additionalNotes: "Jugador clave en jugadas de contrataque y situaciones de uno contra uno."
  };

  return (
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
  );
};

export default PlayerTechnicalInfo;
