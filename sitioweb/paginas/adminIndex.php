<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Validación de seguridad
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Redirección segura via JS
    echo "<script>window.location.href='inicio.php?op=acceso';</script>";
    exit();
}
?>

<style>
    .dashboard-wrapper {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        
        /* Ajustes para llenar la pantalla entre header y footer */
        margin-top: -1.5rem; 
        padding-bottom: 3rem;

        /* Imagen de fondo Admin (Misma que en cerrar_vendedor) */
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(118, 107, 107, 0.7)), url('imagenes/imgAdmin1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;

        min-height: 85vh;
        
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    /* Tarjeta de Bienvenida */
    .welcome-card {
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

    .user-avatar {
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: #000000ff;
        font-size: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    /* Grilla de Acciones Rápidas */
    .actions-grid {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .action-btn {
        background-color: white;
        color: #000000ff;
        text-decoration: none;
        padding: 20px 30px;
        border-radius: 15px;
        font-weight: bold;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
        min-width: 200px;
    }

    .action-btn i {
        font-size: 2rem;
        color: #f76a6aff; /* Rojo tipo admin */
    }

    .action-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 10px rgba(0,0,0,0.4);
        background-color: #fff;
        color: #f76a6aff;
    }
    .fw-bold
    {
        color: #711717ff;
    }
</style>

<div class="dashboard-wrapper">

    <!-- Tarjeta de Bienvenida con efecto cristal -->
    <div class="welcome-card animate__animated animate__fadeInDown">
        <div class="user-avatar">
            <i class="bi bi-person-workspace"></i>
        </div>
        <h1 class="fw-bold">Panel de Administrador</h1>
        <p class="fs-5 opacity-75">
            Bienvenido de nuevo, <strong><?php echo $_SESSION['fullname']; ?></strong>.
        </p>
        <hr style="border-color: rgba(255,255,255,0.3);">
        <p class="small mb-0">Selecciona una acción para comenzar</p>
    </div>

    <!-- Acciones Rápidas -->
    <div class="actions-grid animate__animated animate__fadeInUp">
        
        <!-- Botón para ir a Crear Vendedor -->
        <a href="inicio.php?op=crear_vendedor" class="action-btn">
            <div class="bg-light rounded-circle p-2">
                <i class="bi bi-people-fill"></i>
            </div>
            <span>Gestionar Vendedores</span>
        </a>

    </div>

</div>