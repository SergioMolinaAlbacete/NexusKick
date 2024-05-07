import React, { useState } from 'react';
import axios from 'axios';

function Register() {
  const [inputs, setInputs] = useState({
    nombre: '',
    email: '',
    password: '',
    tipo_usuario: '',
    ciudad: '',
    edad: '',
    perfil_url: ''
  });

  const handleChange = e => {
    setInputs({ ...inputs, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:5000/register', inputs);
      alert('Registro exitoso!');
    } catch (error) {
      alert('Error al registrar: ' + error.response.data);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      {/* Crea campos de formulario para cada entrada requerida */}
      <input type="text" name="nombre" value={inputs.nombre} onChange={handleChange} placeholder="Nombre" />
      <input type="email" name="email" value={inputs.email} onChange={handleChange} placeholder="Email" />
      <input type="password" name="password" value={inputs.password} onChange={handleChange} placeholder="Contraseña" />
      <input type="text" name="tipo_usuario" value={inputs.tipo_usuario} onChange={handleChange} placeholder="Tipo de usuario (jugador, entrenador, equipo)" />
      <input type="text" name="ciudad" value={inputs.ciudad} onChange={handleChange} placeholder="Ciudad" />
      <input type="number" name="edad" value={inputs.edad} onChange={handleChange} placeholder="Edad" />
      <input type="text" name="perfil_url" value={inputs.perfil_url} onChange={handleChange} placeholder="URL del Perfil" />
      <button type="submit">Registrar</button>
    </form>
  );
}

export default Register;
