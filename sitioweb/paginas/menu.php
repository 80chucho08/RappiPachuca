<?php
// menu.php
// NOTA: Para marcar el enlace activo, se debe usar la variable $pagina que viene de inicio.php
// Ejemplo: $pagina = isset($_GET['op']) ? strtolower($_GET['op']) : 'bienvenida';
// function isActive($op) { return $op === $GLOBALS['pagina'] ? 'active' : ''; }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm pf-nav">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="inicio.php">
      <span class="pf-logo d-inline-block"></span>
      <strong>[Nombre del Proyecto]</strong>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pfNavbar"
      aria-controls="pfNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="pfNavbar">
      <ul class="navbar-nav ms-auto align-items-lg-center mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link position-relative active" href="inicio.php">
            <i class="bi bi-house-door me-1"></i>Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link position-relative" href="inicio.php?op=seccion1">
            <i class="bi bi-gear me-1"></i>Sección Uno
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link position-relative" href="inicio.php?op=seccion2">
            <i class="bi bi-people me-1"></i>Sección Dos
          </a>
        </li>
        <?php
        // LÓGICA DE SESIÓN (Dejar esta estructura para manejar el estado logueado/deslogueado)
        if (isset($_SESSION['usuario_logueado'])) { 
          // Reemplaza 'usuario_logueado' por la variable de sesión que uses para verificar
          $nombreUsuario = $_SESSION['nombre'] ?? 'Usuario';
          $rolUsuario = $_SESSION['rol'] ?? 'Invitado';
        ?>
          <li class="nav-item dropdown ms-lg-2">
            <a class="nav-link d-flex align-items-center gap-2 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="rounded-circle d-flex justify-content-center align-items-center bg-secondary"
                style="width:28px; height:28px; overflow:hidden;">
                <i class="bi bi-person-circle fs-5"></i> 
              </span>
              <div class="d-flex flex-column text-start">
                <small class="fw-semibold"><?= $nombreUsuario ?></small>
                <small class="text-muted text-capitalize"><?= $rolUsuario ?></small>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="inicio.php?op=perfil">Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="inicio.php?op=cerrarsesion">Cerrar Sesión <i class="bi bi-box-arrow-right ms-1"></i></a></li>
            </ul>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item ms-lg-2">
            <a class="btn btn-gradient fw-semibold px-3" href="inicio.php?op=acceso">
              Iniciar Sesión <i class="bi bi-person-circle ms-1"></i>
            </a>
          </li>
        <?php
        }
        ?>

      </ul>
    </div>
  </div>
</nav>

<style>
  /* --- ESTILOS DE LA PLANTILLA --- */

  /* Botón gradiente */
  .btn-gradient {
    background: linear-gradient(90deg, #22d3ee, #34d399);
    color: #0b1020;
    border: none;
    border-radius: .75rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, .25);
  }

  .btn-gradient:hover {
    filter: brightness(1.07);
  }

  /* Logo */
  .pf-logo {
    width: 30px;
    height: 30px;
    border-radius: 10px;
    background: conic-gradient(from 180deg at 50% 50%, #22d3ee, #a78bfa, #34d399, #22d3ee);
    box-shadow: inset 0 0 8px rgba(255, 255, 255, .25), 0 6px 16px rgba(0, 0, 0, .35);
    /* Puedes quitar la animación si no la necesitas */
    animation: pfspin 12s linear infinite;
  }

  @keyframes pfspin {
    to {
      transform: rotate(360deg);
    }
  }

  /* Efecto Underline de navegación */
  .pf-nav .nav-link {
    --underline: 0;
    transition: color .2s ease, transform .2s ease;
  }

  .pf-nav .nav-link::after {
    content: "";
    position: absolute;
    left: .5rem;
    right: .5rem;
    bottom: .3rem;
    height: 2px;
    background: linear-gradient(90deg, #22d3ee, #a78bfa);
    transform: scaleX(var(--underline));
    transform-origin: right;
    transition: transform .25s ease;
    border-radius: 2px;
  }

  .pf-nav .nav-link:hover::after,
  .pf-nav .nav-link.active::after {
    --underline: 1;
    transform-origin: left;
  }

  /* --- FIN ESTILOS DE LA PLANTILLA --- */
</style>