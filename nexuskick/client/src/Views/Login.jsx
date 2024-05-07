import React, { useState } from 'react';
import axios from 'axios';

function Login() {
  const [inputs, setInputs] = useState({
    username: '',
    password: ''
  });

  const handleChange = e => {
    setInputs({ ...inputs, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    try {
      const res = await axios.post('http://localhost:5000/login', inputs);
      alert('Login exitoso: ' + res.data);
      // Aquí podrías establecer el estado de usuario o redirigir al usuario a la página principal
    } catch (err) {
      alert('Error en el login: ' + err.response.data);
    }
  };

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <label>
          Usuario:
          <input
            type="text"
            name="username"
            value={inputs.username}
            onChange={handleChange}
          />
        </label>
        <label>
          Contraseña:
          <input
            type="password"
            name="password"
            value={inputs.password}
            onChange={handleChange}
          />
        </label>
        <button type="submit">Iniciar Sesión</button>
      </form>
    </div>
  );
}

export default Login;
