<?php
// Incluir clsservicios para poder llamar al servicio
require_once '../servicioweb/servicioweb.php';

$servicios = new clsservicios();

$cat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

// Cargar productos por categoría
$productos = $servicios->obtenerProductosPorCategoria($cat);
?>

<div class="row g-3">
    <?php if (!empty($productos)) : ?>
        <?php foreach ($productos as $prod): ?>

            <div class="col-6 col-md-3">

                <!-- CARD con datos para el modal -->
                <div class="card shadow-sm h-100 pf-card"
                     data-bs-toggle="modal"
                     data-bs-target="#modalProducto"
                     data-titulo="<?php echo $prod['title']; ?>"
                     data-imagen="imagenes/<?php echo $prod['image_url']; ?>"
                     data-precio="<?php echo $prod['cost']; ?>"
                     data-categoria="<?php echo $prod['category_name'] ?? 'Sin categoría'; ?>"
                     data-descripcion="<?php echo $prod['description']; ?>"
                     data-telefono="<?php echo $prod['num_dueño']; ?>"
                     style="cursor: pointer;"
                >
                    
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

