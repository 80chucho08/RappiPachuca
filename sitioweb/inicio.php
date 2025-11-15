<?php
// Iniciar sesión si no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtener la página solicitada o usar 'bienvenida' por defecto
$pagina = isset($_GET['op']) ? strtolower($_GET['op']) : 'bienvenida';

// Incluir el encabezado/menú (ej. 'paginas/menu.php')
require_once 'paginas/menu.php';
?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


<main class="container py-4">
    <?php
    // Inclusión dinámica del contenido principal (ej. 'paginas/bienvenida.php')
    require_once 'paginas/' . $pagina . '.php';
    ?>
</main>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

<?php
// Incluir el pie de página (ej. 'paginas/piepag.php')
require_once 'paginas/piepag.php';
?>