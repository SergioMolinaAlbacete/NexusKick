import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import { useAuth } from './Context/AuthContext';
import Navbar from './Components/Navbar/Navbar';
import Footer from './Components/Footer/Footer';
import Home from './Views/Home';
import Jugadores from './Views/Jugadores';
import Entrenadores from './Views/Entrenadores';
import Equipos from './Views/Equipos';
import Perfil from './Views/PerfilJugador';
import Login from './Views/Login';
import Register from './Views/Register'; // Asegúrate de tener este componente

function App() {
  const { user } = useAuth();
  
  return (
    <div>
      <Navbar />
      <Routes>
        <Route path="/login" element={!user ? <Login /> : <Navigate replace to="/" />} />
        <Route path="/register" element={!user ? <Register /> : <Navigate replace to="/" />} />
        <Route path="/" element={user ? <Home /> : <Navigate replace to="/register" />} />
        <Route path="/jugadores" element={user ? <Jugadores /> : <Navigate replace to="/register" />} />
        <Route path="/entrenadores" element={user ? <Entrenadores /> : <Navigate replace to="/register" />} />
        <Route path="/equipos" element={user ? <Equipos /> : <Navigate replace to="/register" />} />
        <Route path="/perfil" element={user ? <Perfil /> : <Navigate replace to="/register" />} />
      </Routes>
      <Footer />
    </div>
  );
}

export default App;
