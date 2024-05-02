import React from 'react';
import TablonAnuncios from '../Components/Anuncios/TablonAnuncios';

function Jugadores() {
  // Datos ficticios para los anuncios de jugadores
  const anunciosJugadores = [
    {
      id: 1,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Juan Pérez",
      edad: 24,
      ciudad: "Madrid",
      titulo: "Busco equipo amateur",
      descripcion: "Jugador con experiencia en ligas locales buscando equipo para entrenar y competir."
    },
    {
      id: 2,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Laura Gómez",
      edad: 19,
      ciudad: "Barcelona",
      titulo: "Portera juvenil disponible",
      descripcion: "Portera juvenil con 4 años de experiencia en categorías inferiores, disponible para pruebas."
    },
    {
      id: 3,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Carlos Ruiz",
      edad: 22,
      ciudad: "Valencia",
      titulo: "Delantero busca equipo senior",
      descripcion: "Delantero con buen récord de goles busca equipo en liga senior. Contacto para más info."
    }
  ];

  return (
    <div style={{ maxWidth: '1200px', margin: '0 auto' }}>
      <h1>Busqueda de Jugadores</h1>
      <TablonAnuncios anuncios={anunciosJugadores} />
    </div>
  );
}

export default Jugadores;
