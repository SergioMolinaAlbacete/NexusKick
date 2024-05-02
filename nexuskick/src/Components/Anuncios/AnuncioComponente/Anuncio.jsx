import React from 'react';
import './Anuncio.css'; // Asegúrate de crear un archivo CSS para estilos

const Anuncio = ({ anuncio }) => {
  return (
    <div className="anuncio-card">
      <div className="perfil-info">
        <img src={anuncio.perfilUrl} alt="perfil" className="perfil-imagen" />
        <div className="info-texto">
          <h2>{anuncio.nombre}</h2>
          <p>{anuncio.edad} años - {anuncio.ciudad}</p>
        </div>
      </div>
      <div className="anuncio-detalle">
        <h3>{anuncio.titulo}</h3>
        <p>{anuncio.descripcion}</p>
      </div>
      <div className="anuncio-botones">
        <button>Contactar</button>
        <button>Ver Perfil</button>
      </div>
    </div>
  );
};

export default Anuncio;
