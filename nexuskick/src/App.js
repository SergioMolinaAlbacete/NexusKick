import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './components/Navbar/Navbar';
import './App.css'; // Asegúrate de que exista y esté en la misma carpeta que App.jsx
import PlayerProfileView from './Views/PlayerProfileView';



const App = () => {
  // Asume que tienes algún método para obtener los datos del jugador (state, props, context, API, etc.)
  const playerData = {/* ... datos del jugador ... */};

  return (
    <Router>
      <Routes>
        <Route path="/player/:id" element={<PlayerProfileView playerData={playerData} />} />
        {/* ... otras rutas */}
      </Routes>
    </Router>
  );
};


export default App;
