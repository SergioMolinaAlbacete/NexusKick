<?php
// Configuración de conexión a la base de datos local
$servidor = 'localhost'; // Asumiendo que MySQL está corriendo en el mismo servidor que tu script PHP
$usuario = 'root'; // El nombre de usuario que tienes configurado en MySQL
$contraseña = ''; // La contraseña para ese usuario en MySQL
$base_de_datos = 'nexuskickdb'; // El nombre de la base de datos a la que deseas conectarte

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
