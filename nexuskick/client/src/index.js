import React from 'react';
import { createRoot } from 'react-dom/client'; // Importa createRoot
import { BrowserRouter as Router } from 'react-router-dom';
import App from './App';
import { AuthProvider } from './Context/AuthContext';

const container = document.getElementById('root'); // Encuentra el contenedor donde montarás la app
const root = createRoot(container); // Crea una raíz

root.render( // Monta tu aplicación en la raíz
  <React.StrictMode>
    <Router>
      <AuthProvider>
        <App />
      </AuthProvider>
    </Router>
  </React.StrictMode>
);
