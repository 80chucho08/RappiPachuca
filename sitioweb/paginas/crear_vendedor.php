<?php
require_once "./../servicioweb/clsservicios.php";

if (session_status() == PHP_SESSION_NONE) session_start();

$servicio = new clsservicios();
$msg = "";
$conn = null;

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='inicio.php?op=acceso';</script>";
    exit();
}

// eliminar
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $servicio->eliminarSeller($idEliminar);
    echo "<script>window.location.href='inicio.php?op=crear_vendedor';</script>";
    exit();
}

// actualizar
if (isset($_POST['btnActualizar'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];

    $servicio->actualizarSeller($id, $username, $fullname, $phone);
    echo "<script>window.location.href='inicio.php?op=crear_vendedor';</script>";
    exit();
}

// crear
if (isset($_POST['btnGuardar'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];

    $respuesta = $servicio->crearVendedor(
        $username,
        $password,
        $fullname,
        $phone
    );

    $msg = $respuesta['mensaje'];
}

$resp = $servicio->obtenerSellers();
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
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(118, 107, 107, 0.7)), url('imagenes/imgAdmin1.jpg');
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

    <!-- FORMULARIO -->
    <div class="admin-card-form">
        <div class="text-center mb-3">
            <span class="bg-light p-3 rounded-circle d-inline-block text-danger">
                <i class="bi bi-person-plus-fill fs-2"></i>
            </span>
        </div>

        <h3 class="card-title-custom">Nuevo Vendedor</h3>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info small p-2 text-center mb-3">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="btnGuardar" value="1">

            <div class="form-floating mb-2">
                <input type="text" name="username" class="form-control" placeholder="User" required maxlength="100">
                <label>Usuario</label>
            </div>

            <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control" placeholder="Pass" required>
                <label>Contraseña</label>
            </div>

            <div class="form-floating mb-2">
                <input type="text" name="fullname" class="form-control" placeholder="Name" required maxlength="150">
                <label>Nombre Completo</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" name="phone" class="form-control" placeholder="Phone" maxlength="20">
                <label>Teléfono</label>
            </div>

            <button class="btn btn-rappi w-100 py-2">Crear Vendedor</button>
        </form>
    </div>

    <!-- TABLA -->
    <div class="admin-card-table">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0 fw-bold"><i class="bi bi-list-ul me-2 text-danger"></i>Lista de Vendedores</h4>
            <span class="badge bg-dark">Total: <?= (isset($resp["resultado"]) && $resp["resultado"]) ? $resp["resultado"]->num_rows : 0 ?></span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-custom mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>

<?php
$modales = "";

if (isset($resp["estado"]) && $resp["estado"] == 1 && $resp["resultado"]->num_rows > 0):

    while ($row = $resp["resultado"]->fetch_assoc()):
?>

        <tr>
            <td>#<?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['fullname']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditar<?= $row['id'] ?>">
                    <i class="bi bi-pencil-fill"></i>
                </button>

                <a href="inicio.php?op=crear_vendedor&eliminar=<?= $row['id'] ?>"
                   class="btn btn-sm btn-outline-danger"
                   onclick="return confirm('¿Eliminar vendedor?')">
                    <i class="bi bi-trash-fill"></i>
                </a>
            </td>
        </tr>

<?php
// Guardar modal fuera del contenedor
$modales .= '

<div class="modal fade" id="modalEditar'.$row['id'].'" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form method="POST">
                <input type="hidden" name="btnActualizar" value="1">

                <div class="modal-header bg-warning">
                    <h5 class="modal-title fw-bold text-dark">Editar Vendedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" value="'.$row['id'].'">

                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Usuario</label>
                        <input type="text" name="username" class="form-control" value="'.$row['username'].'">
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Nombre Completo</label>
                        <input type="text" name="fullname" class="form-control" value="'.$row['fullname'].'">
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Teléfono</label>
                        <input type="text" name="phone" class="form-control" value="'.$row['phone'].'">
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning fw-bold">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>';

    endwhile;

else:
?>

<tr>
    <td colspan="5" class="text-center py-5 text-muted">
        No hay vendedores registrados.
    </td>
</tr>

<?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div> <!-- CIERRE DE admin-wrapper -->

<!-- Aquí imprimimos los modales FUERA del contenedor -->
<?= $modales ?>
