import React from 'react';
import './PlayerHistory.css'; // Asume que este archivo contiene tus estilos
// import leftArrow from '../../../Multimedia/left-arrow.png'; // Asegúrate de tener estas imágenes
// import rightArrow from '../../../Multimedia/right-arrow.png';
import escudo from '../../../Multimedia/real-madrid-escudo.webp';

const historyData = [
  // Datos de ejemplo, reemplázalos con los reales
  { equipo: 'Real Madrid FC', temporada: '17/18', resultado: '3º Puesto', escudo: 'path-to-shield1.png' },
  // ... más datos
];

const PlayerHistory = () => {
  return (
    <div className="player-history">
      <h2>Historial del jugador</h2>
      <div className="history-slider">
        {/* <button className="slide-arrow left-arrow">
          <img src={leftArrow} alt="Anterior" />
        </button> */}
        {historyData.map((item, index) => (
          <div className="history-card" key={index}>
            <img src={escudo} alt="Escudo del equipo" className="team-shield" />
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
  );
};

export default PlayerHistory;
