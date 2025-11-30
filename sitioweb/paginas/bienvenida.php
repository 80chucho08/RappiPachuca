<?php include 'anuncios_laterales.php'; ?>

<div class="pf-hero d-flex flex-column justify-content-center align-items-center text-center">

    <!-- Ubicación -->
    <div class="d-flex align-items-center gap-2 mb-3 pf-location">
        <i class="bi bi-geo-alt-fill"></i>
        <span>Pachuca</span>
    </div>

    <!-- Título -->
    <h1 class="fw-bold text-white mb-3">¿Qué se te antoja hoy?</h1>

    <!-- Barra de búsqueda -->
    <!-- <div class="col-10 col-md-6">
        <div class="input-group input-group-lg shadow-sm">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Buscar comida, tienda o servicio...">
        </div>
    </div> -->
</div>

<!-- Categorías -->
<section class="container mt-4">
    <h5 class="fw-bold mb-3">Categorías</h5>

    <div class="row g-4 text-center justify-content-center">
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



<!-- Modal Info del Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalProductoTitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-5">
                        <img id="modalProductoImagen" class="img-fluid rounded" alt="">
                    </div>

                    <div class="col-md-7">
                        <h4 id="modalProductoPrecio" class="text-success fw-bold"></h4>
                        <p id="modalProductoCategoria" class="text-muted"></p>
                        <p id="modalProductoDescripcion"></p>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button id="btnHacerPedido" class="btn btn-primary">Hacer Pedido</button>
            </div>

        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        var modalProducto = document.getElementById("modalProducto");
        var botonPedido = document.getElementById("btnHacerPedido");

        let ultimoProducto = {}; // para guardar el producto actual mostrado

        modalProducto.addEventListener("show.bs.modal", function(event) {

            var card = event.relatedTarget;

            // Guardar los datos del producto actual
            ultimoProducto = {
                titulo: card.getAttribute("data-titulo"),
                precio: card.getAttribute("data-precio"),
                categoria: card.getAttribute("data-categoria"),
                descripcion: card.getAttribute("data-descripcion"),
                telefono: card.getAttribute("data-telefono")
            };

            // Insertar en el modal
            document.getElementById("modalProductoTitulo").textContent = ultimoProducto.titulo;
            document.getElementById("modalProductoImagen").src = card.getAttribute("data-imagen");
            document.getElementById("modalProductoPrecio").textContent = "$" + ultimoProducto.precio;
            document.getElementById("modalProductoCategoria").textContent = ultimoProducto.categoria;
            document.getElementById("modalProductoDescripcion").textContent = ultimoProducto.descripcion;
        });

        // Evento del botón "Hacer Pedido"
        botonPedido.addEventListener("click", function() {

            // Número del vendedor (cámbialo por el real)
            let numero = "52" + ultimoProducto.telefono;

            // Mensaje dinámico
            let mensaje =
                "Hola, quiero hacer un pedido:%0A" +
                "👉 *" + ultimoProducto.titulo + "*%0A" +
                "💵 Precio: $" + ultimoProducto.precio + "%0A" +
                "📦 Categoría: " + ultimoProducto.categoria + "%0A%0A" +
                "¿Está disponible?";

            // Abrir WhatsApp
            let url = "https://wa.me/" + numero + "?text=" + mensaje;

            window.open(url, "_blank");
        });

    });
</script>