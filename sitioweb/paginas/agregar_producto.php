<?php
if (session_status() == PHP_SESSION_NONE) session_start();

// Solo sellers pueden entrar
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'seller') {
    header("Location: inicio.php?op=acceso");
    exit();
}

require_once "../servicioweb/clsservicios.php";
$serv = new clsservicios();
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $seller_id = $_SESSION['id'];
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $num_dueno = $_POST['num_dueno'];

    $respuesta = $serv->agregarProducto(
        $seller_id,
        $category_id,
        $title,
        $image_url,
        $description,
        $cost,
        $num_dueno
    );

    $msg = $respuesta['mensaje'];
}
?>

<div class="container mt-4">

    <h3 class="mb-4">Agregar Producto</h3>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="category_id" class="form-control" required>
                <option value="1">Comida</option>
                <option value="2">Bebida</option>
                <option value="3">Postres</option>
                <option value="4">Servicios</option>
                <!-- Puedes cargar dinamicamente las categorías -->
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Título del Producto</label>
            <input type="text" name="title" class="form-control" required maxlength="150">
        </div>

        <div class="mb-3">
            <label class="form-label">URL de la Imagen</label>
            <input type="text" name="image_url" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Costo</label>
            <input type="number" name="cost" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Número del Dueño</label>
            <input type="text" name="num_dueno" class="form-control" required maxlength="20">
        </div>

        <button class="btn btn-primary w-100">Guardar Producto</button>
    </form>

</div>
