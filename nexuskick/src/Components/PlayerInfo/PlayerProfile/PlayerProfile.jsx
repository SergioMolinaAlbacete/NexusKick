import React from 'react';
import './PlayerProfile.css'; // Asume que crearás un archivo CSS para cada subcomponente
import playerImage from '../../../Multimedia/cr7.png';

const PlayerProfile = ({ player = {
  nombreCompleto: 'Cristiano Ronaldo dos Santos Aveiro',
  nombre: 'Cristiano Ronaldo',
  imagen: '', // Deberías proporcionar una URL de imagen aquí
  país: 'Portugal',
  lugarNacimiento: 'Funchal, Madeira',
  fechaNacimiento: '1985-02-05', // Formato YYYY-MM-DD
  edad: 37,
  altura: '1.87 m',
  peso: '83 kg',
  piernaBuena: 'Derecha',
  tallaRopa: 'L',
  tallaCalzado: 42, // Suponiendo que la talla es Europea
  númeroPreferido: 7
} }) => {
  return (
    <div className="player-profile">
      <div className="player-profile-column">
        <img src={player.imagen || playerImage} alt={`${player.nombre}`} className="player-image" />
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
  );
};

export default PlayerProfile;
