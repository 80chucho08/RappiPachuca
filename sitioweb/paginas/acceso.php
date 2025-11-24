<?php

require_once "../servicioweb/clsservicios.php";

$serv = new clsservicios();

// Si el formulario se envió (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $respuesta = $serv->loginUsuario($username, $password);

    if ($respuesta['estado'] == 1) {

        // Guardar datos de sesión
        $_SESSION['id'] = $respuesta['id'];
        $_SESSION['username'] = $respuesta['username'];
        $_SESSION['fullname'] = $respuesta['fullname'];
        $_SESSION['role'] = $respuesta['role'];

        // Redirigir siempre al inicio
        header("Location: ./inicio.php");
        exit();
    } else {
        $error = $respuesta['mensaje']; // Guardamos mensaje de error
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Iniciar Sesión</h4>

                        <!-- Mostrar alerta de error si existe -->
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger py-2">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button class="btn btn-primary w-100">Acceder</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>