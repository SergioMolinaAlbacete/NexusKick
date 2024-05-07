<?php
// Aquí puedes incluir lógicas PHP si es necesario, como verificaciones de sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="../../css/header.css"> <!-- Asegúrate de que la ruta al archivo CSS es correcta -->
</head>
<body>
    <nav class="navbar">
      <div class="navbar-container">
        <a href="/inicio" class="navbar-logo">
          <img src="../../img/LogitipoParaTFC2.png" alt="Logo">
        </a>
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="/jugadores" class="nav-links">JUGADORES</a>
          </li>
          <li class="nav-item">
            <a href="/entrenadores" class="nav-links">ENTRENADORES</a>
          </li>
          <li class="nav-item">
            <a href="/equipos" class="nav-links">EQUIPOS</a>
          </li>
        </ul>
        <form class="search-form" onsubmit="handleSearchSubmit(event)">
          <input
            type="text"
            class="search-input"
            placeholder="Buscar..."
            id="searchTerm"
            name="searchTerm"
          />
          <button type="submit" class="search-button">Buscar</button>
        </form>
        <div class="nav-icon">
          <a href="/notificaciones" style="margin-right: 20px; cursor: pointer;">
            <!-- Añadir icono de notificaciones (FontAwesome usado como ejemplo) -->
            <i class="fas fa-bell"></i>
          </a>
          <a href="/perfil" style="cursor: pointer;">
            <!-- Añadir icono de perfil de usuario -->
            <i class="fas fa-user-circle"></i>
          </a>
        </div>
      </div>
    </nav>

    <script>
      function handleSearchSubmit(e) {
        e.preventDefault();
        var searchTerm = document.getElementById('searchTerm').value;
        // Aquí manejarías la búsqueda, p. ej. redireccionando al usuario o filtrando resultados
        console.log(searchTerm);
        // Podrías redirigir al usuario usando algo como:
        // window.location.href = '/buscar?term=' + encodeURIComponent(searchTerm);
      }
    </script>
</body>
</html>
