<?php
// Asegúrate de que no haya salida antes de la redirección
ob_start();
include '../config/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['loggedin']) && isset($_COOKIE['user_login'])) {
        $email = $_COOKIE['user_login'];
        // Aquí debes agregar el proceso de autenticación basado en el email
        // ... tu código de autenticación ...
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        // ... cualquier otra información que necesites en la sesión ...
    }

    // Asegúrate de que la conexión se ha establecido correctamente
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Escapar la entrada del usuario para seguridad
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $tipo_usuario = $conn->real_escape_string($_POST['tipo_usuario']);
    $edad = $conn->real_escape_string($_POST['edad']);

    // Definir la URL de la imagen
    $url_image = "../../img/shop/en_forma_de_dibujos_animados (1).jpg";

    // Verifica si ya existe un usuario con el mismo correo electrónico
    $checkEmail = $conn->prepare("SELECT email FROM Usuarios WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('Ya existe un usuario registrado con ese correo electrónico.'); window.location.href='registro.php';</script>";
        $checkEmail->close();
    } else {
        // Encriptar la contraseña antes de almacenarla
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la sentencia SQL para evitar inyecciones SQL
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, tipo_usuario, edad) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $nombre, $email, $passwordHash, $tipo_usuario, $edad);
        if ($stmt->execute()) {
            // Aquí puedes incluir el código para enviar un correo electrónico de confirmación
            // Redirige al usuario a login.php

            //Para crear la ficha tecnica en caso que sea jugador
            if ($tipo_usuario == 'jugador') {
                $last_id = $conn->insert_id; // ID del último usuario insertado
                $stmt_ficha = $conn->prepare("INSERT INTO ficha_tecnica (usuario_id) VALUES (?)");
                $stmt_ficha->bind_param("i", $last_id);
                $stmt_ficha->execute();
                $stmt_ficha->close();
            }
            header('Location: login.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }



        if ($stmt->execute()) {
            $mail = new PHPMailer(true); // Pasar `true` habilita excepciones
            try {
                // Configuración del servidor
                $mail->isSMTP(); // Usar SMTP
                $mail->Host = 'smtp.gmail.com'; // Servidores SMTP
                $mail->SMTPAuth = true; // Habilitar autenticación SMTP
                $mail->Username = 'draftyeig@gmail.com'; // SMTP usuario
                $mail->Password = 'jrulwscfviupaxby'; // SMTP contraseña
                $mail->SMTPSecure = 'ssl'; // Habilitar TLS o SSL
                $mail->Port = 465; // Puerto TCP para conectarse

                // Destinatarios
                $mail->setFrom('draftyeig@gmail.com', 'Drafty');
                $mail->addAddress($email, $name); // Agregar un destinatario, el correo del usuario registrado

                // Contenido
                $mail->isHTML(true); // Establecer formato de correo electrónico a HTML
                $mail->Subject = 'Bienvenido a Nuestro Sitio Web';
                $mail->Body = '
                            <html>
                            <head>
                                <style>
                                    .image-container {
                                        margin-top: 20px;
                                        text-align: center;
                                    }
                                    .image-container img {
                                        max-width: 100%;
                                        height: auto;
                                        border-radius: 5px;
                                        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                                    }
                                </style>
                                </head>
                                <body>
                                    <div class="container">
                                        <h1 style="color: #2196F3, width:10px">¡Bienvenido a Nuestro Sitio Web, ' . $name . '!</h1>
                                        <p>Gracias por registrarte en nuestra página web.</p>
                                        <p>Para cualquier consulta, no dudes en contactarnos a través de nuestro correo electrónico: <a href="mailto:Draftyeig@gmail.com">Draftyeig@gmail.com</a></p>
                                        <p>¡Esperamos que tengas una excelente experiencia con nosotros!</p>
                                        <p>Atentamente,<br>El Equipo de Drafty</p>
                                        <div class="image-container">
                                            <img src="' . $url_image . '" alt="Drafty Logo" title="Drafty Logo">
                                        </div>
                                    </div>
                                </body>
                                </html>
                        ';

                $mail->send();
                //echo 'El mensaje ha sido enviado';
            } catch (Exception $e) {
                // Si quieres manejar el error de envío, puedes hacerlo aquí
                echo 'El mensaje no pudo ser enviado. Error de Mailer: ', $mail->ErrorInfo;
            }
            // Redirige al usuario a login.php
            header('Location: login.php');
            exit; // Asegúrate de salir del script después de la redirección
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
$conn->close();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro | NexusKick</title>
    <link rel="stylesheet" href="./../../css/register.css">

</head>

<body id="body">

    <form action="register.php" method="POST">
        <h2>Crear una nueva cuenta</h2>
        <div class="input-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="nombre" placeholder="Nombre completo" required />
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="correo@example.com" required />
        </div>
        <div class="input-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required />
        </div>
        <div class="input-group">
            <label for="tipo_usuario">Tipo de Usuario</label>
            <select id="tipo_usuario" name="tipo_usuario" required>
                <option value="jugador">Jugador</option>
                <option value="entrenador">Entrenador</option>
                <option value="equipo">Equipo</option>
            </select>
        </div>
        <div class="input-group">
            <label for="edad">Edad / Antiguedad del club</label>
            <input type="number" id="edad" name="edad" placeholder="Edad" />
        </div>

        <div class="input-group">
            <input type="submit" value="REGISTRARSE" class="google-login-button" />
        </div>
        <div class="input-group">
            <p>Si ya tienes una cuenta <a href="login.php" class="google-login-button">INICIAR SESIÓN </a></p>

        </div>
    </form>

    <script src="../../css/three.min.js"></script>
    <script src="../../css/vanta.waves.min.js"></script>
    <script>
        VANTA.WAVES({
            el: "#body",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x198754,
            shininess: 0.00,
            waveHeight: 23.50,
            waveSpeed: 0.65,
            zoom: 0.91
        })
    </script>


</body>

</html>