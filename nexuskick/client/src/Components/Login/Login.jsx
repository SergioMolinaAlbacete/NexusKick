import React, { useState } from 'react';
import { useHistory } from 'react-router-dom';
import axios from 'axios';

function Login() {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const history = useHistory();

    const handleLogin = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('http://localhost:3000/login', { username, password });
            alert('Login exitoso');
            history.push('/'); // Cambia a la ruta que desees después del login
        } catch (error) {
            alert('Error en el login: ' + error.response.data);
        }
    };

    return (
        <form onSubmit={handleLogin}>
            <label>
                Usuario:
                <input type="text" value={username} onChange={e => setUsername(e.target.value)} />
            </label>
            <label>
                Contraseña:
                <input type="password" value={password} onChange={e => setPassword(e.target.value)} />
            </label>
            <button type="submit">Iniciar Sesión</button>
        </form>
    );
}

export default Login;
