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
    },
    {
      "id": 4,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Nova Team",
      "ciudad": "Murcia",
      "titulo": "Equipo en expansión busca talentos",
      "descripcion": "Nuestro equipo está buscando jugadores para todas las posiciones. Interesados en Segunda Regional."
    },
    {
      "id": 5,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Unión Deportiva",
      "ciudad": "Córdoba",
      "titulo": "Buscamos entrenador para nueva temporada",
      "descripcion": "Necesitamos un entrenador con experiencia en juveniles para liderar nuestro proyecto deportivo."
    },
    {
      "id": 6,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "FC Innovación",
      "ciudad": "Toledo",
      "titulo": "Equipo innovador busca portero",
      "descripcion": "Buscamos un portero con buen manejo de balón y experiencia en juego de pies."
    },
    {
      "id": 7,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Spartan Soccer Club",
      "ciudad": "Lérida",
      "titulo": "Buscamos jóvenes promesas",
      "descripcion": "Si eres joven y tienes potencial, queremos verte en nuestro equipo. Pruebas abiertas para sub-20."
    },
    {
      "id": 8,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Dynamo Futbol Club",
      "ciudad": "Tarragona",
      "titulo": "Equipo busca delanteros y defensas",
      "descripcion": "Reforzamos nuestra plantilla con delanteros y defensas para la próxima temporada en Tercera División."
    },
    {
      "id": 9,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Atlético Estudio",
      "ciudad": "Burgos",
      "titulo": "Equipo con enfoque en la táctica busca jugadores",
      "descripcion": "Fútbol basado en tácticas avanzadas busca jugadores técnicos. Pruebas este mes."
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


