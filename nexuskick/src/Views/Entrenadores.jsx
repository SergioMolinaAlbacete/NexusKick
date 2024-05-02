import React from 'react';
import TablonAnuncios from '../Components/Anuncios/TablonAnuncios';

function Entrenadores() {
  // Datos ficticios para los anuncios de entrenadores
  const anunciosEntrenadores = [
    {
      id: 1,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Ana Martínez",
      edad: 34,
      ciudad: "Sevilla",
      titulo: "Entrenadora con experiencia en juveniles",
      descripcion: "Busco equipo juvenil para entrenar la próxima temporada. Especializada en tácticas defensivas."
    },
    {
      id: 2,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Carlos Fernández",
      edad: 45,
      ciudad: "Valencia",
      titulo: "Entrenador de porteros",
      descripcion: "Experiencia de más de 20 años entrenando porteros. Busco club en Valencia."
    },
    {
      id: 3,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Lucía Gómez",
      edad: 29,
      ciudad: "Madrid",
      titulo: "Preparadora física",
      descripcion: "Especialista en preparación física y recuperación de lesiones. Disponible para equipos de todas las edades."
    }
  ];

  return (
    <div style={{ maxWidth: '1200px', margin: '0 auto' }}>
      <h1>Búsqueda de Entrenadores</h1>
      <TablonAnuncios anuncios={anunciosEntrenadores} />
    </div>
  );
}

export default Entrenadores;
