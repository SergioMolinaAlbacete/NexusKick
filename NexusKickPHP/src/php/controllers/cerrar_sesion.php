<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, también se debe borrar la cookie de sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();

// Redirigir al usuario a la página de inicio de sesión o a la página principal
header("Location: ../../php/views/login.php"); // Cambia esto a la página a la que quieres redirigir después de cerrar sesión
exit;
?>
