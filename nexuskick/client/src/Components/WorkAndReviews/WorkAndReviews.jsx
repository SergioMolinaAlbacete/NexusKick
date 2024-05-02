import React from 'react';
import './WorkAndReviews.css';  // Define el estilo para este contenedor
import PlayerWorkEducation from '../PlayerInfo/PlayerWorkEducation/PlayerWorkEducation';
import PlayerReviews from '../PlayerInfo/PlayerReviews/PlayerReviews';

const WorkAndReviews = () => {
  return (
    <div className="work-and-reviews-container">
      <PlayerWorkEducation />
      <PlayerReviews />
    </div>
  );
};

export default WorkAndReviews;
