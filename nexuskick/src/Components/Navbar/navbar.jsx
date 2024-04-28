import React, { useState } from 'react';
import { Link } from 'react-router-dom'; // Asumiendo que usas react-router para la navegación
import './Navbar.css'; // Archivo CSS para los estilos de la Navbar
import NotificationsIcon from '@mui/icons-material/Notifications';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';


const Navbar = () => {

  const [searchTerm, setSearchTerm] = useState('');

  const handleSearchChange = (e) => {
    setSearchTerm(e.target.value);
  };

  const handleSearchSubmit = (e) => {
    e.preventDefault();
    // Aquí manejarías la búsqueda, p. ej. redireccionando al usuario o filtrando resultados
    console.log(searchTerm);
  };

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
        <form className="search-form" onSubmit={handleSearchSubmit}>
          <input
            type="text"
            className="search-input"
            placeholder="Buscar..."
            value={searchTerm}
            onChange={handleSearchChange}
          />
          <button type="submit" className="search-button">
            {/* Aquí puedes añadir un ícono de búsqueda si lo deseas */}
            Buscar
          </button>
        </form>
        <div className="nav-icon">
          <Link to="/notificaciones">
            <NotificationsIcon style={{ marginRight: '20px', cursor: 'pointer' }} />

          </Link>
          <Link to="/perfil">
            <AccountCircleIcon style={{ cursor: 'pointer' }} />
          </Link>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
