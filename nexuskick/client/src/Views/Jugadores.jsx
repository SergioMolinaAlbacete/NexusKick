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
    },
    {
      "id": 4,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Sofía Rodríguez",
      "edad": 21,
      "ciudad": "Bilbao",
      "titulo": "Extremo rápido busca equipo",
      "descripcion": "Extremo con velocidad y buena técnica busca equipo en la primera división regional."
    },
    {
      "id": 5,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Miguel Ángel Torres",
      "edad": 18,
      "ciudad": "Granada",
      "titulo": "Mediocampista creativo disponible",
      "descripcion": "Jugador joven busca equipo con buen ambiente para desarrollo a largo plazo."
    },
    {
      "id": 6,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Elena Núñez",
      "edad": 23,
      "ciudad": "Zaragoza",
      "titulo": "Defensa central con experiencia internacional",
      "descripcion": "Experiencia en ligas internacionales, busca equipo competitivo en España."
    },
    {
      "id": 7,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Oscar Sánchez",
      "edad": 25,
      "ciudad": "Sevilla",
      "titulo": "Delantero goleador busca nuevos retos",
      "descripcion": "Delantero con buena cifra de goles cada temporada, interesado en primera o segunda división."
    },
    {
      "id": 8,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Laura Martín",
      "edad": 20,
      "ciudad": "Valencia",
      "titulo": "Joven promesa del fútbol femenino",
      "descripcion": "Busco equipo en Liga Iberdrola con un proyecto serio y ambicioso."
    },
    {
      "id": 9,
      "perfilUrl": "https://via.placeholder.com/150",
      "nombre": "Daniel Jiménez",
      "edad": 22,
      "ciudad": "Madrid",
      "titulo": "Portero con reflejos de élite",
      "descripcion": "Experiencia en categorías nacionales, busca equipo con aspiraciones de ascenso."
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
