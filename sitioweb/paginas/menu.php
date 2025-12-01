<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function isActive($op)
{
    return ($GLOBALS['pagina'] === $op) ? 'active-link' : '';
}

// Detectar si hay usuario logueado
$usuarioLog = isset($_SESSION['id']); 
$nombreUsuario = $_SESSION['fullname'] ?? '';
$rolUsuario = $_SESSION['role'] ?? '';
?>

<style>
    /* --- ESTILOS DEL MENÚ --- */
    
    .pf-navbar {
        background: linear-gradient(135deg, #FF4D4D 0%, #FF2E2E 100%);
        padding: 0.6rem 1rem; /* Navbar más delgado y elegante */
        transition: all 0.3s ease-in-out;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
    }

    .pf-brand {
        font-weight: 800;
        font-size: 1.3rem;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .nav-link {
        font-weight: 500;
        font-size: 0.9rem;
        margin: 0 5px;
        position: relative;
        color: rgba(255,255,255,0.95) !important;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: #fff !important;
        transform: translateY(-1px);
    }

    /* Línea animada debajo de los links */
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 3px;
        bottom: 2px;
        left: 50%;
        background-color: #fff;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        transform: translateX(-50%);
        opacity: 0;
    }

    .nav-link:hover::after,
    .nav-link.active-link::after {
        width: 20px;
        opacity: 1;
    }
    
    .active-link {
        color: #fff !important;
        font-weight: 700;
    }

    /* --- ESTILO DE USUARIO COMPACTO Y ALINEADO --- */
    .user-badge {
        background: rgba(255, 255, 255, 0.2);
        /* Padding asimétrico: 4px arriba/abajo, 15px derecha (para la flecha), 4px izquierda */
        padding: 4px 15px 4px 4px !important; 
        border-radius: 50px;
        
        /* Flexbox para alinear icono y texto en una sola línea */
        display: inline-flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: flex-start !important;
        
        gap: 10px; /* Separación entre el círculo y el texto */
        
        /* Tamaño dinámico pero controlado */
        width: auto !important;
        max-width: 220px; /* Si el nombre es kilométrico, no rompe el sitio */
        height: auto;
        
        border: 1px solid rgba(255,255,255,0.3);
        transition: all 0.2s ease;
        text-decoration: none;
    }

    /* Hover en el badge */
    .user-badge:hover, .user-badge.show {
        background: #000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        color: #FF4D4D !important;
    }

    /* Círculo del Avatar */
    .user-avatar-circle {
        width: 30px;  /* Tamaño compacto */
        height: 30px;
        min-width: 30px; /* Evita que se aplaste */
        background: #000;
        color: #FF4D4D;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        transition: transform 0.3s;
    }

    .user-badge:hover .user-avatar-circle {
        background: #FF4D4D;
        color: #fff;
        transform: rotate(15deg); /* Pequeña animación divertida */
    }

    /* Texto del nombre */
    .user-name-text {
        font-size: 0.85rem; /* Tamaño de letra adecuado */
        font-weight: 700;
        white-space: nowrap; /* IMPORTANTE: Mantiene todo en una línea */
        overflow: hidden;
        text-overflow: ellipsis; /* Pone "..." si no cabe */
        line-height: 1; 
        padding-top: 2px; /* Ajuste óptico vertical */
    }

    /* --- MENÚ DESPLEGABLE --- */
    .pf-dropdown-menu {
        background-color: #000 !important;
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        margin-top: 10px !important;
        padding: 8px;
        animation: slideUpFade 0.2s ease forwards;
        min-width: 200px;
    }

    .pf-dropdown-menu .dropdown-item {
        border-radius: 8px;
        padding: 8px 15px;
        font-weight: 500;
        font-size: 0.9rem;
        color: #444 !important;
        transition: all 0.2s;
    }

    .pf-dropdown-menu .dropdown-item:hover {
        background-color: #fff;
        color: #FF4D4D !important;
        padding-left: 20px; /* Efecto desplazamiento */
    }

    .pf-dropdown-menu .dropdown-header {
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #999;
    }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Botón Login para visitantes */
    .btn-login-outline {
        border: 1px solid rgba(255,255,255,0.6);
        background: rgba(255,255,255,0.1);
        color: #fff;
        border-radius: 50px;
        padding: 5px 18px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-login-outline:hover {
        background: #000;
        color: #FF4D4D;
        transform: translateY(-2px);
    }

</style>

<nav class="navbar navbar-expand-lg navbar-dark pf-navbar shadow-sm fixed-top">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 pf-brand" href="inicio.php">
            <i class="bi bi-basket2-fill"></i>
            <span>Rappi Pachuca</span>
        </a>

        <!-- Botón Móvil -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#pfNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="pfNavbar">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link <?= isActive('bienvenida') ?>" href="inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('seccion1') ?>" href="inicio.php?op=seccion1">Sección Uno</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('seccion2') ?>" href="inicio.php?op=seccion2">Sección Dos</a>
                </li>

                <li class="nav-item ms-lg-2">
                    <div class="d-none d-lg-block border-end border-white opacity-25" style="height: 20px;"></div>
                </li>

                <?php if ($usuarioLog): ?>

                    <li class="nav-item dropdown ms-lg-3">
                        <!-- Botón de Usuario (Badge Compacto) -->
                        <a class="nav-link user-badge dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar-circle">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <!-- Texto controlado -->
                            <span class="user-name-text"><?= htmlspecialchars($nombreUsuario) ?></span>
                        </a>

                        <!-- Dropdown -->
                        <ul class="dropdown-menu dropdown-menu-end pf-dropdown-menu">
                            <li><h6 class="dropdown-header text-uppercase">Mi Cuenta</h6></li>

                            <?php if ($rolUsuario === 'admin'): ?>
                                <li><a class="dropdown-item" href="inicio.php?op=adminIndex"><i class="bi bi-speedometer2 me-2 text-warning"></i>Panel Admin</a></li>
                                <li><a class="dropdown-item" href="inicio.php?op=crear_vendedor"><i class="bi bi-person-plus-fill me-2 text-info"></i>Vendedores</a></li>
                            <?php elseif ($rolUsuario === 'seller'): ?>
                                <li><a class="dropdown-item" href="inicio.php?op=sellerIndex"><i class="bi bi-shop me-2 text-primary"></i>Panel Vendedor</a></li>
                                <li><a class="dropdown-item" href="inicio.php?op=agregar_producto"><i class="bi bi-plus-circle-fill me-2 text-success"></i>Productos</a></li>
                            <?php endif; ?>

                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger fw-bold" href="paginas/cerrar_sesion.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                        </ul>
                    </li>

                <?php else: ?>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-login-outline nav-link" href="inicio.php?op=acceso">
                            <i class="bi bi-person-circle me-1"></i> Ingresar
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>

    </div>
</nav>