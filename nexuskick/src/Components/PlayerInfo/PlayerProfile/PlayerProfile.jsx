import React from 'react';
import './PlayerProfile.css'; // Asume que crearás un archivo CSS para cada subcomponente

const PlayerProfile = ({ player }) => {
  return (
    <div className="player-profile">
      <img src={player.image} alt={`${player.name}`} className="player-image" />
      <div className="personal-info">
        <h1>{player.name}</h1>
        <p>País de Nacimiento: {player.country}</p>
        {/* Añadir más campos de información personal aquí */}
      </div>
    </div>
  );
};

export default PlayerProfile;
