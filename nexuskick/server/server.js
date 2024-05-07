const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const bcrypt = require('bcryptjs');
const mysql = require('mysql');
require('dotenv').config();

const app = express();
app.use(cors());
app.use(bodyParser.json());

const db = mysql.createPool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASS,
  database: process.env.DB_NAME
});

// Endpoint para login
app.post('/login', (req, res) => {
  const { username, password } = req.body;
  db.query(
    'SELECT * FROM usuarios WHERE nombre = ?',
    [username],
    (err, results) => {
      if (err) {
        return res.status(500).send('Error en el servidor');
      }
      if (results.length === 0) {
        return res.status(401).send('Usuario no encontrado');
      }

      const user = results[0];
      bcrypt.compare(password, user.password, (err, isMatch) => {
        if (err) {
          return res.status(500).send('Error al verificar la contraseña');
        }
        if (!isMatch) {
          return res.status(401).send('Contraseña incorrecta');
        }
        res.status(200).send('Login exitoso');
      });
    }
  );
});

app.post('/register', (req, res) => {
  const { username, email, password, tipo_usuario, ciudad, edad, perfil_url } = req.body;

  bcrypt.hash(password, 10, (err, hash) => {
    if (err) {
      return res.status(500).send('Error al hashear la contraseña');
    }

    const sql = 'INSERT INTO usuarios (nombre, email, password, tipo_usuario, ciudad, edad, perfil_url) VALUES (?, ?, ?, ?, ?, ?, ?)';
    db.query(sql, [username, email, hash, tipo_usuario, ciudad, edad, perfil_url], (err, results) => {
      if (err) {
        return res.status(500).send('Error en el servidor');
      }
      res.status(201).send('Usuario registrado correctamente');
    });
  });
});





const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
