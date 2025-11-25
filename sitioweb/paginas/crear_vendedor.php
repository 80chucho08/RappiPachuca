<?php
require_once "./../servicioweb/clsservicios.php";

if (session_status() == PHP_SESSION_NONE) session_start();

$servicio = new clsservicios();
$msg = "";
$conn = null; // Inicializar variable para la conexión de mysqli


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: inicio.php?op=acceso");
    exit();
}

// --- 2. Manejo de Acciones (Crear, Actualizar, Eliminar) ---

// Si viene eliminar (GET)
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $respuesta = $servicio->eliminarSeller($idEliminar);
    // Puedes verificar $respuesta['estado'] si quieres mostrar un mensaje de éxito/error
    header("Location: inicio.php?op=crear_vendedor");
    exit();
}

// Si viene actualizar (POST btnActualizar)
if (isset($_POST['btnActualizar'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];

    $respuesta = $servicio->actualizarSeller($id, $username, $fullname, $phone);
    // Puedes verificar $respuesta['estado'] si quieres mostrar un mensaje de éxito/error
    header("Location: inicio.php?op=crear_vendedor");
    exit();
}

// Si viene guardar (POST desde el formulario de creación)
if (isset($_POST['btnGuardar'])) {
    // Los campos vienen del formulario del segundo bloque
    $username = $_POST['username'];
    $password = $_POST['password']; // Asegúrate de que este campo exista en el formulario
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

// --- 3. Obtener vendedores para la tabla ---
$resp = $servicio->obtenerSellers();

?>

<div class="container mt-4">

    <h3 class="mb-4">Crear Nuevo Vendedor</h3>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="btnGuardar" value="1">

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="username" class="form-control" required maxlength="100">
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre Completo</label>
            <input type="text" name="fullname" class="form-control" required maxlength="150">
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" maxlength="20">
        </div>

        <button class="btn btn-primary w-100">Crear Vendedor</button>
    </form>


    <hr>

    <h3>Lista de Vendedores</h3>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Verificar si la respuesta fue exitosa y si hay resultados
            if (isset($resp["estado"]) && $resp["estado"] == 1 && $resp["resultado"] && $resp["resultado"]->num_rows > 0):

                // El <tr>, el modal y el contenido DEBEN IR DENTRO del bucle
                while ($row = $resp["resultado"]->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['fullname']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditar<?= htmlspecialchars($row['id']) ?>">
                                Editar
                            </button>

                            <a href="inicio.php?op=crear_vendedor&eliminar=<?= htmlspecialchars($row['id']) ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar vendedor?')">
                                Eliminar
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEditar<?= htmlspecialchars($row['id']) ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form method="POST">
                                    <input type="hidden" name="btnActualizar" value="1">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar vendedor</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

                                        <label>Usuario</label>
                                        <input type="text" name="username" class="form-control mb-2"
                                            value="<?= htmlspecialchars($row['username']) ?>">

                                        <label>Nombre completo</label>
                                        <input type="text" name="fullname" class="form-control mb-2"
                                            value="<?= htmlspecialchars($row['fullname']) ?>">

                                        <label>Teléfono</label>
                                        <input type="text" name="phone" class="form-control mb-2"
                                            value="<?= htmlspecialchars($row['phone']) ?>">

                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="btnActualizar" class="btn btn-success">Actualizar</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                <?php } // Fin del while 
                ?>

            <?php else: // Si no hay vendedores 
            ?>
                <tr>
                    <td colspan="5">No hay vendedores registrados</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>

</div>