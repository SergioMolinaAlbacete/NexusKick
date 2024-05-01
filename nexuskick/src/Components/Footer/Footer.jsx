import React from 'react';
import './Footer.css'; // Importa el CSS para el Footer

function Footer() {
    return (
        <footer className="footer">
            <div className="footer-content">
                <p>© {new Date().getFullYear()} NexusKick. Todos los derechos reservados.</p>
                <p>Conectando entrenadores, jugadores y equipos de fútbol alrededor del mundo.</p>
            </div>
        </footer>
    );
}



export default Footer;
