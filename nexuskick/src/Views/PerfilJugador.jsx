import React from 'react';
import PlayerProfile from '../Components/PlayerInfo/PlayerProfile/PlayerProfile';
import PlayerHistory from '../Components/PlayerInfo/PlayerHistory/PlayerHistory';
import PlayerTechnicalInfo from '../Components/PlayerInfo/PlayerTechnicalInfo/PlayerTechnicalInfo';
import PlayerWorkEducation from '../Components/PlayerInfo/PlayerWorkEducation/PlayerWorkEducation';
import PlayerReviews from '../Components/PlayerInfo/PlayerReviews/PlayerReviews';

// La información del jugador puede provenir de props, estado local, contexto, o incluso de una llamada a una API.
const PerfilJugador = () => {
  return (
    <div className="player-view">
      <PlayerProfile />
      <PlayerHistory />
      <PlayerTechnicalInfo />
      <PlayerWorkEducation />
      <PlayerReviews />
    </div>
  );
};

export default PerfilJugador;
