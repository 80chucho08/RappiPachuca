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
        background-color: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 350px;
        z-index: 2;
    }

    .admin-card-table {
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 800px;
        z-index: 2;
        overflow: hidden;
    
    }
    .btn-rappi
    {
        background-color: #ffd3d3ff;
    }
</style>

<div class="admin-wrapper">
    <div class="admin-card-form">
        <div class="text-center mb-3">
            <span class="bg-light p-3 rounded-circle d-inline-block text-danger">
                <i class="bi bi-basket2"></i>
            </span>
        </div>

        <h3 class="card-title-custom">Agregar Producto</h3>

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
                <label class="form-floating mb-2">Título del Producto</label>
                <input type="text" name="title" class="form-control" required maxlength="150">
            </div>

            <div class="mb-3">
                <label class="form-floating mb-2">URL de la Imagen</label>
                <input type="text" name="image_url" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-floating mb-2">Descripción</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-floating mb-2">Costo</label>
                <input type="number" name="cost" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label class="form-floating mb-2">Número del Dueño</label>
                <input type="text" name="num_dueno" class="form-control" required maxlength="20">
            </div>

            <button class="btn btn-rappi w-100 py-2">Guardar Producto</button>
        </form>
    </div>  
        <div class="admin-card-table">
            <hr class="my-5">
            <h3 class="m-0 fw-bold" >Mis Productos</h3>
            <?php if (empty($productosSeller)): ?>
                <div class="alert alert-warning">Aún no tienes productos registrados.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover table-custom mb-0">
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
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="inicio.php?op=agregar_Producto&eliminar=<?= $prod['product_id'] ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('¿Eliminar este producto?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            <?php endif; ?>
        </div>
</div>
