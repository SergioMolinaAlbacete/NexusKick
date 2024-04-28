import React from 'react';
import PlayerProfile from './PlayerProfile';
import PlayerHistory from './PlayerHistory';
import PlayerTechnicalInfo from './PlayerTechnicalInfo';
import PlayerWorkEducation from './PlayerWorkEducation';
import PlayerReviews from './PlayerReviews';
import './PlayerView.css'; // Asume que este archivo contiene los estilos específicos para la vista

// La información del jugador puede provenir de props, estado local, contexto, o incluso de una llamada a una API.
const PlayerView = ({ playerData }) => {
  return (
    <div className="player-view">
      <PlayerProfile player={playerData.profile} />
      <PlayerHistory history={playerData.history} />
      <PlayerTechnicalInfo technicalInfo={playerData.technical} />
      <PlayerWorkEducation workEducation={playerData.workEducation} />
      <PlayerReviews reviews={playerData.reviews} />
    </div>
  );
};

export default PlayerView;
