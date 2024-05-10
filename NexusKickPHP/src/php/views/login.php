<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../config/db.php';

    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = $_POST['password'];

    // Preparar la consulta SQL para verificar el correo y obtener datos del usuario
    $stmt = $conn->prepare("SELECT id, nombre, email, password, tipo_usuario FROM Usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        if (password_verify($contraseña, $usuario['password'])) {
            // Si la contraseña es correcta, configurar los datos de la sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre'];
            $_SESSION['email_usuario'] = $usuario['email'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            // Redireccionar según el tipo de usuario
            switch ($usuario['tipo_usuario']) {
                case 'jugador':
                    header('Location: perfilJugador.php');
                    break;
                case 'entrenador':
                    header('Location: perfilEntrenador.php');
                    break;
                case 'equipo':
                    header('Location: perfilEquipo.php');
                    break;
                default:
                    header('Location: home.php');
                    break;
            }
            exit;
        } else {
            $_SESSION['mensaje_errorPassword'] = "La contraseña es incorrecta";
        }
    } else {
        $_SESSION['mensaje_usuarioNoExiste'] = "El usuario no existe";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="./../../css/login.css">
</head>

<body id="body">

    <header>
        <!-- Tu código de cabecera aquí -->
    </header>
    <div class="container">
        <div class="form-container">
            <form action="login.php" method="POST">
                <h2>Iniciar sesión</h2>
                <div class="input-group">
                    <label for="email">Correo</label>
                    <input type="text" id="email" name="email" placeholder="Introduce tu correo" required />
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required />
                </div>
                <div class="input-group">
                    <input type="submit" value="ENTRAR" class="google-login-button" />
                </div>
                <div class="input-group">
                    <p>Si no tienes una cuenta <a href="login.php" class="google-login-button">REGISTRATE </a></p>
                </div>
            </form>
        </div>
    </div>

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