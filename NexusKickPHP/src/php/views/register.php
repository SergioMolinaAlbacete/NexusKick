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

    // Escapar la entrada del usuario
    $name = $conn->real_escape_string($_POST['name']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Definir la URL de la imagen
    $url_image = "../../img/shop/en_forma_de_dibujos_animados (1).jpg";

    // Verifica si ya existe un usuario con el mismo correo electrónico
    $checkEmail = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();
    if ($result->num_rows > 0) {
        // Si ya existe un usuario con ese correo, muestra un mensaje de alerta
        echo "<script>alert('Ya existe un usuario registrado con ese correo electrónico.'); window.location.href='registro.php';</script>";
        $checkEmail->close();
    } else {
        // Si el correo no está en uso, continúa con el registro
        if ($_POST['password'] != $_POST['passwordC']) {
            $_SESSION['mensaje_errorPassword1'] = "Las contraseñas no coinciden";
        } else {
            // Encriptar la contraseña antes de almacenarla
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $idRol = 4;
            $coins = 100;

            // Definir la URL de la imagen
            $url_image = "../../img/shop/en_forma_de_dibujos_animados (1).jpg";

            // Preparar la sentencia SQL para evitar inyecciones SQL
            $stmt = $conn->prepare("INSERT INTO users (name, surname, email, password, id_roles, coins, url_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssiss", $name, $surname, $email, $passwordHash, $idRol, $coins, $url_image); // Cambiado ssiiiss a ssiss


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
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="../../css/LoginRegister.css">
    <link rel="stylesheet" href="../../css/popup.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../favicon/favicon-16x16.png">
    <link rel="manifest" href="../../favicon/site.webmanifest">
    <link rel="mask-icon" href="../../favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald:wght@500&family=Poppins&display=swap"
        rel="stylesheet">


</head>
<?php include '../controllers/popups.php'; ?>
<body id="body">

    <header>
        <div class="top-bar">
            <span class="icon" id="contLogo"><img src="../../img/logo/logoD.png"></span>
            <div class="google-login-button"><a href="login.php">Iniciar sesión</a></div>
        </div>
    </header>


    <div class="container">
        <div class="form-container">
            <form action="register.php" method="POST">
                <h2>Crear una nueva cuenta</h2>
                <div class="input-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Churumbel" required />
                </div>
                <div class="input-group">
                    <label for="surname">Apellidos</label>
                    <input type="text" id="surname" name="surname" placeholder="Perez Lechuga" required />
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="soyUnGitano@example.com" required />
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required />
                </div>
                <div class="input-group">
                    <label for="passwordC">Confirmar contraseña</label>
                    <input type="password" id="passwordC" name="passwordC" required />
                </div>
                <div class="input-group">
                    <input type="submit" value="REGISTRARSE" class="google-login-button" />
                </div>
                <div class="buttons-container">
                    <div class="google-login-button">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px"
                            class="google-icon" viewBox="0 0 48 48" height="1em" width="1em"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill="#FFC107"
                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
                                c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
                                c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
                                C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
                                c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                            <path fill="#1976D2"
                                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
                                c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                        </svg>
                        <span>Registrarse con Google</span>
                    </div>
            </form>
        </div>
    </div>
    <script src="https://c.webfontfree.com/c.js?f=DrukWideWeb-Super" type="text/javascript"></script>

    <script src="../../js/three.min.js"></script>
    <script src="../../js/vanta.cells.min.js"></script>
    <script>
        VANTA.CELLS({
            el: "#body",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            color1: 0x305e78,
            color2: 0x202578,
            size: 0.60,
            speed: 0.90
        })
    </script>



</body>

</html>