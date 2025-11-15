<?php
//menu.php
// Detecta la página actual para marcar el link activo automáticamente
$current = basename($_SERVER['PHP_SELF']);
function isActive($page, $current)
{
  return $page === $current ? 'active' : '';
}
?>
<!-- Bootstrap 5 (si ya lo cargas en tu layout, puedes quitar estas 2 líneas) -->
<!--<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" -->
<!--<link href="../bootstrap/css/bootstrap-icons.css" rel="stylesheet" -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm pf-nav">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="inicio.php">
      <span class="pf-logo d-inline-block"></span>
      <strong>Programación Web • ISC</strong>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pfNavbar"
      aria-controls="pfNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="pfNavbar">
      <ul class="navbar-nav ms-auto align-items-lg-center mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link position-relative <?= isActive('inicio.php', $current) ?>" href="inicio.php">
            <i class="bi bi-house-door me-1"></i>Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link position-relative <?= isActive('rptarticulos.php', $current) ?>" href="inicio.php?op=rptarticulos">
            <i class="bi bi-graph-up me-1"></i>Articulos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link position-relative <?= isActive('rptUsuarios.php', $current) ?>" href="inicio.php?op=rptUsuarios">
            <i class="bi bi-pencil-square me-1"></i>Admin Productos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link position-relative <?= isActive('acceso.php', $current) ?>" href="inicio.php?op=acceso">
            <i class="bi bi-person-circle me-1"></i>Mi sesión
          </a>
        </li>


        <?php
        if (isset($_SESSION['nomUsuario'])) {

          // Obtener el rol
          $rol = $_SESSION['rolNombre'] ?? 'usuario';

          // Elegir la imagen según el rol
          if ($rol === 'ADMINISTRADOR') {
            $imagen = 'imagenes/usuarios/usuAdmin.png';
          } else if ($rol === 'usuario') {
            $imagen = 'imagenes/usuarios/usuUser.png';
          } else {
            $imagen = 'imagenes/usuarios/usuNoUser.png';
          }
        ?>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 position-relative <?= isActive('cerrarsesion.php', $current) ?>"
              href="inicio.php?op=cerrarsesion">

              <!-- Imagen -->
              <span class="rounded-circle d-flex justify-content-center align-items-center bg-secondary"
                style="width:28px; height:28px; overflow:hidden;">
                <img src="<?= $imagen ?>" alt="<?= $rol ?>" style="width:100%; height:100%; object-fit:cover;">
              </span>

              <!-- Información -->
              <div class="d-flex flex-column">
                <small class="fw-semibold"><?= $_SESSION['nomUsuario'] ?></small>
                <small class="text-muted">@<?= $_SESSION['usuUsuario'] ?? 'usuario' ?> - <?= ucfirst($rol) ?></small>
              </div>

              <i class="bi bi-box-arrow-right ms-2"></i> <!-- icono de salir -->
            </a>
          </li>
        <?php
        }
        ?>


        <li class="nav-item ms-lg-2">
          <a class="btn btn-gradient fw-semibold px-3" href="contacto.php">
            ¡Comencemos! <i class="bi bi-rocket-takeoff ms-1"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  .pf-nav .nav-link {
    --underline: 0;
    transition: color .2s ease, transform .2s ease;
  }

  .pf-nav .nav-link:hover {
    transform: translateY(-1px);
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

  .pf-nav .nav-link:hover::after {
    --underline: 1;
    transform-origin: left;
  }

  .pf-nav .nav-link.active {
    color: #fff !important;
  }

  .pf-nav .nav-link.active::after {
    --underline: 1;
  }

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

  /* Logo animado */
  .pf-logo {
    width: 30px;
    height: 30px;
    border-radius: 10px;
    background: conic-gradient(from 180deg at 50% 50%, #22d3ee, #a78bfa, #34d399, #22d3ee);
    box-shadow: inset 0 0 8px rgba(255, 255, 255, .25), 0 6px 16px rgba(0, 0, 0, .35);
    animation: pfspin 12s linear infinite;
  }

  @keyframes pfspin {
    to {
      transform: rotate(360deg);
    }
  }
</style>

<!-- Bootstrap JS (si ya lo cargas en tu layout, puedes quitar esta línea) -->
<!-- <script src="../bootstrap/js/bootstrap.bundle.min.js"></script -->