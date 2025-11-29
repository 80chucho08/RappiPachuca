<?php
// Incluir clsservicios para poder llamar al servicio
require_once '../servicioweb/servicioweb.php';

// try {
//     $ws = new SoapClient(null, array(
//         'location' => 'http://localhost:8080/progweb/1erseg/RappiPachuca/servicioweb/servicioweb.php',
//         'uri'      => 'http://localhost:8080/'
//     ));

//     $productos = $ws->vwProducts();

// } catch (SoapFault $e) {
//     echo "<p class='text-danger'>Error al cargar productos: " . $e->getMessage() . "</p>";
//     $productos = [];
// }
$servicios = new clsservicios();

$cat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
// Ahora $servicios es un objeto válido y la llamada funcionará:
$productos = $servicios->obtenerProductosPorCategoria($cat);

?>

<div class="row g-3">
    <?php if (!empty($productos)) : ?>
        <?php foreach ($productos as $prod): ?>
            <div class="col-6 col-md-3">
                <div class="card shadow-sm h-100">
                    <img src="imagenes/<?php echo $prod['image_url']; ?>" 
                         class="card-img-top" 
                         style="height: 150px; object-fit: cover;">

                    <div class="card-body">
                        <h6 class="card-title fw-bold"><?php echo $prod['title']; ?></h6>
                        <p class="text-muted small"><?php echo $prod['description']; ?></p>
                        <p class="fw-bold text-success">$<?php echo $prod['cost']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted small">No hay productos disponibles...</p>
    <?php endif; ?>
</div>

