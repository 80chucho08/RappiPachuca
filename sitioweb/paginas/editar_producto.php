<?php
if (session_status() == PHP_SESSION_NONE) session_start();

// Solo sellers
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'seller') {
    header("Location: inicio.php?op=acceso");
    exit();
}

require_once "../servicioweb/clsservicios.php";
$serv = new clsservicios();

// Validar ID
if (!isset($_GET['id'])) {
    echo "ID inválido";
    exit();
}

$id = $_GET['id'];

// Obtener datos del producto
$producto = $serv->obtenerProductoPorId($id);

if (!$producto) {
    echo "Producto no encontrado";
    exit();
}

$msg = "";

// Guardar cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $num_dueno = $_POST['num_dueno'];

    $resp = $serv->actualizarProducto(
        $id,
        $title,
        $image_url,
        $description,
        $cost,
        $num_dueno
    );

    $msg = $resp['mensaje'];
}
?>

<div class="container mt-4">
    <h3>Editar Producto</h3>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST" action="inicio.php?op=editar_Producto&id=<?= $id ?>" >
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="title" class="form-control" value="<?= $producto['title'] ?>" required>
        </div>

        <div class="mb-3">
            <label>URL Imagen</label>
            <input type="text" name="image_url" class="form-control" value="<?= $producto['image_url'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control" rows="4"><?= $producto['description'] ?></textarea>
        </div>

        <div class="mb-3">
            <label>Costo</label>
            <input type="number" name="cost" class="form-control" step="0.01" value="<?= $producto['cost'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Número del dueño</label>
            <input type="text" name="num_dueno" class="form-control" value="<?= $producto['num_dueño'] ?>" required>
        </div>

        <button class="btn btn-primary w-100">Guardar Cambios</button>
    </form>
</div>