<?php
session_start();
// Verificar si el usuario ha iniciado sesión
$is_logged_in = isset($_SESSION['id_usuario']);

// Obtener tipo de usuario y su ID
$tipo_usuario = $is_logged_in ? $_SESSION['tipo_usuario'] : '';
$usuario_id = $is_logged_in ? $_SESSION['id_usuario'] : '';

// Definir la URL del perfil basado en el tipo de usuario
if ($tipo_usuario === 'jugador') {
  $perfil_url = "./perfilJugador.php";
} elseif ($tipo_usuario === 'entrenador') {
  $perfil_url = "./perfilEntrenador.php";
} elseif ($tipo_usuario === 'equipo') {
  $perfil_url = "./perfilEquipo.php";
} else {
  // Redirigir a una página de perfil genérica o de error
  $perfil_url = "./inicio.php";
}
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
      <input type="text" class="search-input" placeholder="Buscar..." id="searchTerm" name="searchTerm" />
      <button type="submit" class="search-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
      </button>
    </form>
    <div class="nav-icon">
      <a href="#" style="margin-right: 20px; cursor: pointer;">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 256 256">
          <path fill="#ffffff" d="M132 24A100.11 100.11 0 0 0 32 124v84a16 16 0 0 0 16 16h84a100 100 0 0 0 0-200M88 140a12 12 0 1 1 12-12a12 12 0 0 1-12 12m44 0a12 12 0 1 1 12-12a12 12 0 0 1-12 12m44 0a12 12 0 1 1 12-12a12 12 0 0 1-12 12" />
        </svg>
      </a>
      <a href="<?= $perfil_url ?>" style="cursor: pointer;">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
          <path fill="#ffffff" fill-rule="evenodd" d="M10 4h4c3.771 0 5.657 0 6.828 1.172C22 6.343 22 8.229 22 12c0 3.771 0 5.657-1.172 6.828C19.657 20 17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172C2 17.657 2 15.771 2 12c0-3.771 0-5.657 1.172-6.828C4.343 4 6.229 4 10 4m3.25 5a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75m1 3a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75m1 3a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1-.75-.75M11 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8c4 0 4-.895 4-2s-1.79-2-4-2s-4 .895-4 2s0 2 4 2" clip-rule="evenodd" />
        </svg>
      </a>
      <a href="./../controllers/cerrar_sesion.php" style="cursor: pointer; margin-left: 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20"><path fill="#ffffff" d="m19 10l-6-5v3H6v4h7v3zM3 3h8V1H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H3z"/></svg>
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