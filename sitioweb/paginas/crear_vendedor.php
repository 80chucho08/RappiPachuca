<?php
// sitioweb/paginas/admin/crear_vendedor.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Validación de rol
if ($_SESSION['role'] !== 'admin') {
    echo "<div class='alert alert-danger'>Acceso denegado. Se requiere rol de Administrador.</div>";
    exit;
}

// Lógica para procesar el formulario si se envía (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí iría la lógica para llamar al procedimiento almacenado
    // Por ahora, solo un mensaje de prueba:
    $mensaje = "Formulario de Vendedor enviado. (Llamada al SP pendiente).";
    // $nombreVendedor = $_POST['nombre_vendedor'] ?? '';
    // $serv->crearVendedor($nombreVendedor, ...);
}
?>

<h2>Crear Vendedor</h2>

<?php if (isset($mensaje)): ?>
    <div class="alert alert-info"><?= $mensaje ?></div>
<?php endif; ?>

<form action="inicio.php?op=admin/crear_vendedor" method="POST">
    <div class="mb-3">
        <label for="nombre_vendedor" class="form-label">Nombre del Vendedor</label>
        <input type="text" class="form-control" id="nombre_vendedor" name="nombre_vendedor" required>
    </div>
    <div class="mb-3">
        <label for="usuario_vendedor" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario_vendedor" name="usuario_vendedor" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Vendedor</button>
</form>