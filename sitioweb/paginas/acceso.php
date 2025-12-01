<?php
require_once "../servicioweb/clsservicios.php";

$serv = new clsservicios();
$error = null;

// --- LÓGICA DE LOGIN ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $respuesta = $serv->loginUsuario($username, $password);

    if ($respuesta['estado'] == 1) {
        if (session_status() == PHP_SESSION_NONE) session_start();
        $_SESSION['id'] = $respuesta['id'];
        $_SESSION['username'] = $respuesta['username'];
        $_SESSION['fullname'] = $respuesta['fullname'];
        $_SESSION['role'] = $respuesta['role'];

        $redirect_op = ($respuesta['role'] == 'admin') ? 'adminIndex' : (($respuesta['role'] == 'seller') ? 'sellerIndex' : 'bienvenida');

        // Redirección via JS para evitar conflictos de headers en inicio.php
        echo "<script>window.location.href='./inicio.php?op=" . $redirect_op . "';</script>";
        exit();
    } else {
        $error = $respuesta['mensaje'];
    }
}
?>

<style>
    /* TRUCO CSS: "Full Width Breakout" */
    .login-wrapper {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;

        /* Ajuste vertical */
        margin-top: -1.5rem; 
        
        /* Imagen de fondo OSCURECIDA con linear-gradient */
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(118, 107, 107, 0.5)), url('imagenes/imgAcceso.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;

        /* Altura */
        min-height: 85vh;

        /* Flexbox para alinear los elementos */
        display: flex;
        align-items: center;
        /* Alineamos el contenido con un poco de margen izquierdo, 
           pero permitimos que el texto de la derecha fluya */
        justify-content: flex-start; 
        padding-left: 30%;
        gap: 60px; /* Espacio entre el formulario y el texto de la derecha */
        
        flex-wrap: wrap; /* Para que baje en móviles */
    }

    /* Estilo de la tarjeta flotante (Formulario) */
    .login-card-custom {
        background: rgba(255, 255, 255, 0.1); /* Efecto cristal (Glassmorphism) */
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 40px;
        border-radius: 20px;
        text-align: center;
        color: white;
        max-width: 600px;
        width: 100%;
        margin-bottom: 30px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }

    /* Contenedor de Texto a la Derecha */
    .login-text-container {
        color: white;
        max-width: 500px;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    /* Títulos y textos */
    .login-title {
        font-weight: 800;
        color: #fffefeff;
        margin-bottom: 25px; /* Más espacio abajo del título */
        text-align: center;
    }

    /* Estilos para el texto lateral */
    .side-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        line-height: 1.1;
        color: #fffafaff;
    }

    .side-description {
        font-size: 1.2rem;
        opacity: 0.9;
        font-weight: 300;
    }

    /* Botón rojo estilo Rappi */
    .btn-rappi {
        background-color: #FF4D4D;
        color: white;
        font-weight: bold;
        padding: 12px;
        border-radius: 8px;
        border: none;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn-rappi:hover {
        background-color: #e63939;
        color: white;
    }

    /* Inputs flotantes */
    .form-floating > label {
        color: #888;
        font-size: 0.9rem;
    }
    .form-control:focus {
        border-color: #FF4D4D;
        box-shadow: 0 0 0 0.2rem rgba(255, 77, 77, 0.25);
    }

    /* Responsivo para celulares */
    @media (max-width: 992px) {
        .login-wrapper {
            justify-content: center;
            padding: 40px 20px;
            gap: 40px;
            flex-direction: column-reverse; /* Pone el texto arriba en móvil */
            text-align: center;
        }
        .login-card-custom {
            max-width: 100%;
        }
        .side-title {
            font-size: 2.5rem;
        }
    }
</style>

<!-- Wrapper de ancho completo -->
<div class="login-wrapper">

    <!-- 1. Tarjeta de Login (Izquierda) -->
    <div class="login-card-custom animate__animated animate__fadeInLeft">

        <!-- Nuevo Título en el formulario -->
        <h2 class="login-title">Iniciar Sesión</h2>

        <!-- Alerta de Error -->
        <?php if ($error): ?>
            <div class="alert alert-danger d-flex align-items-center p-2 mb-3" style="font-size: 0.9rem;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div><?= $error ?></div>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form method="POST">
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="uInput" placeholder="Usuario" required>
                <label for="uInput">Usuario</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="pInput" placeholder="Contraseña" required>
                <label for="pInput">Contraseña</label>
            </div>

            <button type="submit" class="btn btn-rappi w-100">Acceder</button>
        </form>

    </div>

    <!-- 2. Contenedor de Texto (Derecha) -->
    <div class="login-text-container animate__animated animate__fadeInRight">
        <h1 class="side-title">Colaboradores</h1>
        <p class="side-description">
            Acceso exclusivo para administradores y vendedores de la plataforma. <br>
            Gestiona tus productos y pedidos desde aquí.
        </p>
    </div>

</div>