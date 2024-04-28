import React from 'react';
import PlayerProfile from './PlayerProfile';
import PlayerHistory from './PlayerHistory';
import PlayerTechnicalInfo from './PlayerTechnicalInfo';
import PlayerWorkEducation from './PlayerWorkEducation';
import PlayerReviews from './PlayerReviews';

const PlayerInfo = ({ playerData }) => {
  return (
    <div className="player-info-container">
      <PlayerProfile player={playerData.personal} />
      <PlayerHistory history={playerData.history} />
      <PlayerTechnicalInfo technicalInfo={playerData.technical} />
      <PlayerWorkEducation workEducation={playerData.workEducation} />
      <PlayerReviews reviews={playerData.reviews} />
    </div>
  );
};

export default PlayerInfo;
