<?php
// sitioweb/paginas/seller/agregar_producto.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Validación de rol
if ($_SESSION['role'] !== 'seller') {
    echo "<div class='alert alert-danger'>Acceso denegado. Se requiere rol de Vendedor.</div>";
    exit;
}

// Lógica para procesar el formulario si se envía (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí iría la lógica para llamar al procedimiento almacenado
    // Por ahora, solo un mensaje de prueba:
    $mensaje = "Formulario de Producto enviado. (Llamada al SP pendiente).";
    // $nombreProducto = $_POST['nombre_producto'] ?? '';
    // $idVendedor = $_SESSION['id'];
    // $serv->agregarProducto($idVendedor, $nombreProducto, ...);
}
?>

<h2>Agregar Producto</h2>

<?php if (isset($mensaje)): ?>
    <div class="alert alert-info"><?= $mensaje ?></div>
<?php endif; ?>

<form action="inicio.php?op=seller/agregar_producto" method="POST">
    <div class="mb-3">
        <label for="nombre_producto" class="form-label">Nombre del Producto</label>
        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
    </div>
    <div class="mb-3">
        <label for="precio_producto" class="form-label">Precio</label>
        <input type="number" step="0.01" class="form-control" id="precio_producto" name="precio_producto" required>
    </div>
    <button type="submit" class="btn btn-success">Añadir Producto</button>
</form>