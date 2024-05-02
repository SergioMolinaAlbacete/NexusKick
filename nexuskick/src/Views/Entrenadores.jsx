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
    },
    {
      "id": 4,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Irene Vidal",
      "edad": 36,
      "ciudad": "Málaga",
      "titulo": "Entrenadora especializada en fútbol juvenil",
      "descripcion": "Capacitada en técnicas modernas de entrenamiento, busca equipo juvenil para desarrollar talentos."
    },
    {
      "id": 5,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Jorge Alonso",
      "edad": 40,
      "ciudad": "Alicante",
      "titulo": "Técnico con enfoque en táctica ofensiva",
      "descripcion": "Busco equipo que aspire a mejorar su capacidad ofensiva y rendimiento en campo."
    },
    {
      "id": 6,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Patricia Molina",
      "edad": 47,
      "ciudad": "Gijón",
      "titulo": "Experiencia en dirección de equipos femeninos",
      "descripcion": "Con vasta experiencia en ligas femeninas, dispuesta a tomar nuevos proyectos desafiantes."
    },
    {
      "id": 7,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Luis Romero",
      "edad": 50,
      "ciudad": "Vigo",
      "titulo": "Veterano busca equipo sénior para ascenso",
      "descripcion": "Experiencia en Segunda B, busca equipo con aspiraciones de jugar en Segunda A."
    },
    {
      "id": 8,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Ana Belén Álvarez",
      "edad": 33,
      "ciudad": "Santander",
      "titulo": "Especialista en preparación física y táctica",
      "descripcion": "Preparadora física con conocimientos avanzados en tácticas de juego, busca equipo profesional."
    },
    {
      "id": 9,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Roberto García",
      "edad": 38,
      "ciudad": "Palma de Mallorca",
      "titulo": "Entrenador con habilidades en desarrollo juvenil",
      "descripcion": "Interesado en programas de desarrollo para jóvenes talentos en cualquier categoría."
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
