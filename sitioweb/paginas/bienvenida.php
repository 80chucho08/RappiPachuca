<div class="pf-hero d-flex flex-column justify-content-center align-items-center text-center">

    <!-- Ubicación -->
    <div class="d-flex align-items-center gap-2 mb-3 pf-location">
        <i class="bi bi-geo-alt-fill"></i>
        <span>Pachuca</span>
    </div>

    <!-- Título -->
    <h1 class="fw-bold text-white mb-3">¿Qué se te antoja hoy?</h1>

    <!-- Barra de búsqueda -->
    <div class="col-10 col-md-6">
        <div class="input-group input-group-lg shadow-sm">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Buscar comida, tienda o servicio...">
        </div>
    </div>
</div>

<!-- Categorías -->
<section class="container mt-4">
    <h5 class="fw-bold mb-3">Categorías</h5>

    <div class="row g-3 text-center">

        <div class="col-3">
            <div class="pf-cat shadow-sm">
                <i class="bi bi-bag-fill"></i>
                <p class="small mt-2">Comida</p>
            </div>
        </div>

        <div class="col-3">
            <div class="pf-cat shadow-sm">
                <i class="bi bi-cup-hot-fill"></i>
                <p class="small mt-2">Café</p>
            </div>
        </div>

        <div class="col-3">
            <div class="pf-cat shadow-sm">
                <i class="bi bi-shop"></i>
                <p class="small mt-2">Tiendas</p>
            </div>
        </div>

        <div class="col-3">
            <div class="pf-cat shadow-sm">
                <i class="bi bi-bicycle"></i>
                <p class="small mt-2">Envíos</p>
            </div>
        </div>

    </div>
</section>

<!-- Bloque pendiente para tarjetas de restaurantes -->
<section class="container my-4">
    <h5 class="fw-bold mb-3">Recomendaciones</h5>
    <?php include 'productos.php'; ?>
</section>