<?php
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../config/db.php'; // Incluir el archivo para la conexión a la base de datos.
    
    $email = $_POST['email'];
    $contraseña = $_POST['password'];

    // echo "Email: $email, Contraseña: $contraseña";

    // Preparar la sentencia SQL para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $stmt1 = $conn->prepare("SELECT * FROM users WHERE id_roles = ?");
    $stmt1->bind_param("s", $roles);
    $stmt1->execute();
    $resultado1 = $stmt1->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
      if (password_verify($contraseña, $usuario['password'])) {
        // Iniciar sesión y redirigir al usuario
        $_SESSION['loggedin'] = true;
        $_SESSION['id_users'] = $usuario['id_users'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['id_users'] = $usuario['id_users'];
        $rol = $usuario['id_roles'];
        // Aquí puedes guardar más datos del usuario si es necesario
        if ($rol == 1) {
          header('Location: propuesta.php');
        }
        elseif (!empty($usuario['id_schools'])) {
          header('Location: centroeducativo.php'); // Redireccionar a la página de centro educativo
        } else {
          header('Location: home.php'); // Redireccionar a la página principal
        }
      } else {
        $_SESSION['mensaje_errorPassword']="La contraseña es incorrecta";
      }
    } else {
      $_SESSION['mensaje_usuarioNoExiste']="El usuario no existe";
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
  <link rel="stylesheet" href="../../css/LoginRegister.css" />
  <link rel="stylesheet" href="../../css/popup.css" />
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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald:wght@500&family=Poppins&display=swap" rel="stylesheet">

</head>
<?php include '../controllers/popups.php'; ?>
<body id="body">
  <header>
    <div class="top-bar">
      <span class="icon" id="contLogo"><img src="../../img/logo/logoD.png"></a></span>
      <div class="google-login-button"><a href="register.php">Registrarse</a></div>
    </div>
  </header>
  <div class="container">
    <div class="form-container">
      <form action="login.php" method="POST">
        <h2>Iniciar sesión</h2>
        <div class="input-group">
          <label for="email">Correo</label>
          <input type="text" id="email" name="email" placeholder="Introduce tu correo" />
        </div>
        <div class="input-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" />
        </div>
        <div class="input-abajo">
          <div class="input-radio">
            <!-- <input type="checkbox" /><label for="" class="he">Recordar contraseña</label> -->
            <label class="cyberpunk-checkbox-label">
              <input type="checkbox" class="cyberpunk-checkbox" name="remember">
              Recordar contraseña</label>
          </div>
          <div class="input-group">
            <a href="recuperarPass.php" class="he">He olvidado mi contraseña</a>
          </div>
          <div class="input-group">
            <input type="submit" class="google-login-button" value="ENTRAR">
          </div>
          <div class="buttons-container">
            <div class="google-login-button">
              <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" class="google-icon" viewBox="0 0 48 48" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
        c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
        c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
        C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
        c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
        c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
              </svg>
              <span>Iniciar sesión con Google</span>
            </div>
          </div>
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