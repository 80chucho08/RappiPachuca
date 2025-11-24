<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] !== 'seller') {
    echo "<div class='alert alert-danger'>Acceso denegado</div>";
    exit;
}
?>

<h2>Panel de Vendedor</h2>
<p>Bienvenido, <?php echo $_SESSION['fullname']; ?>.</p>

<a href="inicio.php?op=agregar_producto" class="btn btn-success">Agregar Producto</a>