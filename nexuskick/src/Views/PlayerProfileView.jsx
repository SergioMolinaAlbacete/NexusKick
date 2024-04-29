import React from 'react';
import PlayerProfile from '../Components/PlayerInfo/PlayerProfile/PlayerProfile';
import PlayerHistory from '../Components/PlayerInfo/PlayerHistory/PlayerHistory';
import PlayerTechnicalInfo from '../Components/PlayerInfo/PlayerTechnicalInfo/PlayerTechnicalInfo';
import PlayerWorkEducation from '../Components/PlayerInfo/PlayerWorkEducation/PlayerWorkEducation';
import PlayerReviews from '../Components/PlayerInfo/PlayerReviews/PlayerReviews';

// La información del jugador puede provenir de props, estado local, contexto, o incluso de una llamada a una API.
const PlayerProfileView = ({ playerData }) => {
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

export default PlayerProfileView;
