import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './Components/Navbar/Navbar';
import Footer from './Components/Footer/Footer';
import Home from './Views/Home';
import Jugadores from './Views/Jugadores';
import Entrenadores from './Views/Entrenadores';
import Equipos from './Views/Equipos';
import Perfil from './Views/PerfilJugador';

function App() {
  return (
    <Router>
      <div>
        <Navbar />
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/jugadores" element={<Jugadores />} />
          <Route path="/entrenadores" element={<Entrenadores />} />
          <Route path="/equipos" element={<Equipos />} />
          <Route path="/perfil" element={<Perfil />} />
        </Routes>
        <Footer />
      </div>
    </Router>
  );
}

export default App;
