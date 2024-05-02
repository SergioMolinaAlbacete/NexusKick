import React from 'react';
import TablonAnuncios from '../Components/Anuncios/TablonAnuncios';

function Equipos() {
  // Datos ficticios para los anuncios de equipos
  const anunciosEquipos = [
    {
      id: 1,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Club Atlético",
      ciudad: "Barcelona",
      titulo: "Buscamos jugadores sub-18",
      descripcion: "Nuestro club busca jóvenes talentos para la categoría sub-18. Necesitamos delanteros y mediocampistas."
    },
    {
      id: 2,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Real Deportivo",
      ciudad: "Málaga",
      titulo: "Equipo senior necesita defensas",
      descripcion: "Equipo senior en expansión necesita defensas con experiencia para la próxima temporada."
    },
    {
      id: 3,
      perfilUrl: "https://via.placeholder.com/150",
      nombre: "Futbol Club Feminas",
      ciudad: "Madrid",
      titulo: "Equipo femenino busca entrenador",
      descripcion: "Buscamos un entrenador o entrenadora con experiencia en equipos femeninos para dirigir nuestro equipo en la liga local."
    }
  ];

  return (
    <div style={{ maxWidth: '1200px', margin: '0 auto' }}>
      <h1>Búsqueda de Equipos</h1>
      <TablonAnuncios anuncios={anunciosEquipos} />
    </div>
  );
}

export default Equipos;


