import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './components/Navbar/Navbar';
import './App.css'; // Asegúrate de que exista y esté en la misma carpeta que App.jsx


function App() {
  return (
    <Router>
      <div className="App">
        <Navbar />
        
      </div>
    </Router>
  );
}


export default App;
