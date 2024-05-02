import React from 'react';
import Anuncio from './AnuncioComponente/Anuncio';
import './TablonAnuncios.css'; // Asegúrate de crear un archivo CSS para estilos

const TablonAnuncios = ({ anuncios }) => {
  return (
    <div className="tablon">
      {anuncios.map(anuncio => (
        <Anuncio key={anuncio.id} anuncio={anuncio} />
      ))}
    </div>
  );
};

export default TablonAnuncios;
