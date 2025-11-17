<?php
function isActive($op) {
    return ($GLOBALS['pagina'] === $op) ? 'active-link' : '';
}

$usuarioLog = isset($_SESSION['usuario_logueado']);
$nombreUsuario = $_SESSION['nombre'] ?? '';
$rolUsuario = $_SESSION['rol'] ?? '';
?>

<nav class="navbar navbar-expand-lg navbar-dark pf-navbar shadow-sm fixed-top">
    <div class="container">
        
        <a class="navbar-brand d-flex align-items-center gap-2" href="inicio.php">
            <span class="pf-logo"></span>
            <strong>Rappi Pachuca</strong>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pfNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="pfNavbar">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link <?= isActive('bienvenida') ?>" href="inicio.php">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= isActive('seccion1') ?>" href="inicio.php?op=seccion1">Sección Uno</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= isActive('seccion2') ?>" href="inicio.php?op=seccion2">Sección Dos</a>
                </li>

                <?php if ($usuarioLog): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-profile" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <?= $nombreUsuario ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end pf-dropdown">
                            <li><a class="dropdown-item" href="inicio.php?op=perfil">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="inicio.php?op=cerrarsesion">Cerrar sesión</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-pf-primary" href="inicio.php?op=acceso">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>

    </div>
</nav>
