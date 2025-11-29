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

    <div class="row g-4 text-center">
        <div class="col-2">
            <a href="inicio.php?op=bienvenida&cat=0" class="text-decoration-none text-dark">
                <div class="pf-cat shadow-sm">
                    <i class="bi bi-shop"></i>
                    <p class="small mt-2">Todos</p>
                </div>
            </a>
        </div>

        <div class="col-2">
            <a href="inicio.php?op=bienvenida&cat=1" class="text-decoration-none text-dark">
                <div class="pf-cat shadow-sm">
                    <i class="bi bi-basket-fill"></i>
                    <p class="small mt-2">Comida</p>
                </div>
            </a>
        </div>

        <div class="col-2">
            <a href="inicio.php?op=bienvenida&cat=2" class="text-decoration-none text-dark">
                <div class="pf-cat shadow-sm">
                    <i class="bi bi-cup-hot-fill"></i>
                    <p class="small mt-2">Bebida</p>
                </div>
            </a>
        </div>

        <div class="col-2">
            <a href="inicio.php?op=bienvenida&cat=3" class="text-decoration-none text-dark">
                <div class="pf-cat shadow-sm">
                    <i class="bi bi-cake2-fill"></i>
                    <p class="small mt-2">Postres</p>
                </div>
            </a>
        </div>

        <div class="col-2">
            <a href="inicio.php?op=bienvenida&cat=4" class="text-decoration-none text-dark">
                <div class="pf-cat shadow-sm">
                    <i class="bi bi-briefcase-fill"></i>
                    <p class="small mt-2">Servicios</p>
                </div>
            </a>
        </div>
    </div>
</section>


<!-- Recomendaciones -->
<section class="container my-4">
    <h5 class="fw-bold mb-3">Recomendaciones</h5>
    <?php include 'productos.php'; ?>
</section>