<?php
// Aquí puedes incluir lógicas PHP si es necesario, como verificaciones de sesión
?>


    <nav class="navbar">
      <div class="navbar-container">
        <a href="./inicio.php" class="navbar-logo">
          <img src="../../img/LogitipoParaTFC2.png" alt="Logo">
        </a>
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="./busquedaJugadores.php" class="nav-links">JUGADORES</a>
          </li>
          <li class="nav-item">
            <a href="./busquedaEntrenadores.php" class="nav-links">ENTRENADORES</a>
          </li>
          <li class="nav-item">
            <a href="./busquedaEquipos.php" class="nav-links">EQUIPOS</a>
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

