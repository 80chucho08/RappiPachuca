<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function isActive($op)
{
    return ($GLOBALS['pagina'] === $op) ? 'active-link' : '';
}

// Detectar si hay usuario logueado
$usuarioLog = isset($_SESSION['id']); // Cambié a 'id' según acceso.php
$nombreUsuario = $_SESSION['fullname'] ?? '';
$rolUsuario = $_SESSION['role'] ?? '';
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
                            <?= htmlspecialchars($nombreUsuario) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end pf-dropdown">

                            <?php if ($rolUsuario === 'admin'): ?>
                                <li><a class="dropdown-item" href="inicio.php?op=adminIndex">Panel Admin</a></li>

                                <li><a class="dropdown-item" href="inicio.php?op=crear_vendedor">Crear Vendedor</a></li>
                            <?php elseif ($rolUsuario === 'seller'): ?>
                                <li><a class="dropdown-item" href="inicio.php?op=sellerIndex">Panel Vendedor</a></li>

                                <li><a class="dropdown-item" href="inicio.php?op=agregar_producto">Agregar Producto</a></li>
                            <?php endif; ?>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="paginas/cerrar_sesion.php">Cerrar sesión</a></li>
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