<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] !== 'admin') {
    echo "<div class='alert alert-danger'>Acceso denegado</div>";
    exit;
}
?>

<h2>Panel de Administrador</h2>
<p>Bienvenido, <?php echo $_SESSION['fullname']; ?>.</p>

<a href="inicio.php?op=crear_vendedor" class="btn btn-primary">Crear Vendedor</a>