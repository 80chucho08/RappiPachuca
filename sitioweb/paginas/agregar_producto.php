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
$productosSeller = $serv->obtenerProductosPorSeller($_SESSION['id']);


if (isset($_GET['eliminar'])) {
    $resp = $serv->eliminarProducto($_GET['eliminar']);
    $msg = $resp['mensaje'];

    // Recargar lista
    $productosSeller = $serv->obtenerProductosPorSeller($_SESSION['id']);
}
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



    <hr class="my-5">

    <h3>Mis Productos</h3>

    <?php if (empty($productosSeller)): ?>
        <div class="alert alert-warning">Aún no tienes productos registrados.</div>
    <?php else: ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Costo</th>
                    <th>Número</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productosSeller as $prod): ?>
                    <tr>
                        <td>
                            <img src="./imagenes/<?= $prod['image_url'] ?>" width="60" height="60" class="rounded">
                        </td>
                        <td><?= $prod['title'] ?></td>
                        <td>$<?= number_format($prod['cost'], 2) ?></td>
                        <td><?= $prod['num_dueno'] ?></td>
                        <td><?= $prod['created_at'] ?></td>
                        <td>
                            <a href="inicio.php?op=editar_Producto&id=<?= $prod['product_id'] ?>"
                                class="btn btn-sm btn-warning">
                                Editar
                            </a>
                            <a href="inicio.php?op=agregar_Producto&eliminar=<?= $prod['product_id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar este producto?')">
                                Eliminar
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


</div>