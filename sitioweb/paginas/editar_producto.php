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

<style>
    .admin-wrapper {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        margin-top: -1.5rem;
        padding-bottom: 3rem;
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(118, 107, 107, 0.7)), url('imagenes/imgVendedor.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 85vh;
        display: flex;
        flex-wrap: wrap; 
        justify-content: center; 
        align-items: flex-start; 
        gap: 30px;
        padding: 40px 20px;
    }

    .admin-card-form {
        background-color: rgba(255, 255, 255, 0.67);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 850px;
        height: auto;
        z-index: 10;
    }

    .btn-rappi
    {
        background-color: #fcbdbdff;
    }
</style>
<div class="admin-wrapper">
    <div class="admin-card-form">
        <h3 class="card-title-custom">Editar Producto</h3>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info"><?= $msg ?></div>
        <?php endif; ?>

        <form method="POST" action="inicio.php?op=editar_Producto&id=<?= $id ?>" >
            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="title" class="form-control" value="<?= $producto['title'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-floating mb-2">URL Imagen</label>
                <input type="text" name="image_url" class="form-control" value="<?= $producto['image_url'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-floating mb-2">Descripción</label>
                <textarea name="description" class="form-control" rows="4"><?= $producto['description'] ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-floating mb-2">Costo</label>
                <input type="number" name="cost" class="form-control" step="0.01" value="<?= $producto['cost'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-floating mb-2">Número del dueño</label>
                <input type="text" name="num_dueno" class="form-control" value="<?= $producto['num_dueño'] ?>" required>
            </div>

            <button class="btn btn-rappi w-100">Guardar Cambios</button>
        </form>
    </div>
</div>
