<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$GLOBALS['pagina'] = isset($_GET['op']) ? $_GET['op'] : 'bienvenida';
$pagina = $GLOBALS['pagina'];



// Construimos la ruta
$ruta = "paginas/{$pagina}.php";

// Validación por si no existe
if (!file_exists($ruta)) {
    $ruta = "paginas/bienvenida.php";
}

require_once 'paginas/menu.php';
?>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="estilos/main.css">

<main class="container py-4">
    <?php require_once $ruta; ?>
</main>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

<?php require_once 'paginas/piepag.php'; ?>