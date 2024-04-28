import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Navbar from './Components/Navbar.jsx';
import './App.css'; // Asegúrate de que exista y esté en la misma carpeta que App.jsx

function App() {
  return (
    <Router>
      <div className="App">
        <Navbar />
        <Switch>
          {/* Aquí van tus rutas, por ejemplo: */}
          <Route path="/jugadores">
            {/* Componente de Jugadores */}
          </Route>
          {/* Asegúrate de agregar las rutas para entrenadores y equipos */}
        </Switch>
      </div>
    </Router>
  );
}

export default App;
