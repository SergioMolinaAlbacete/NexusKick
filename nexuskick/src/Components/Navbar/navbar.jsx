import React from 'react';
import { Link } from 'react-router-dom'; // Asumiendo que usas react-router para la navegación
import './Navbar.css'; // Archivo CSS para los estilos de la Navbar

const Navbar = () => {
  return (
    <nav className="navbar">
      <div className="navbar-container">
        <Link to="/" className="navbar-logo">
          NexusKick
        </Link>
        <ul className="nav-menu">
          <li className="nav-item">
            <Link to="/jugadores" className="nav-links">
              JUGADORES
            </Link>
          </li>
          <li className="nav-item">
            <Link to="/entrenadores" className="nav-links">
              ENTRENADORES
            </Link>
          </li>
          <li className="nav-item">
            <Link to="/equipos" className="nav-links">
              EQUIPOS
            </Link>
          </li>
        </ul>
        <div className="nav-icon">
          <Link to="/notificaciones">
            {/* Icono de notificación, puedes usar un SVG o una librería como FontAwesome */}
          </Link>
          <Link to="/perfil">
            {/* Icono de perfil, también puede ser un SVG o un ícono de alguna librería */}
          </Link>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
