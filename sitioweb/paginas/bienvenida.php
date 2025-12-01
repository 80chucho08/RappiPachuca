<?php include 'anuncios_laterales.php'; ?>

<style>
/* --- ESTILO TIPO “Recipes 3 / Minimalista + Moderno” --- */

/* Hero principal: Fondo rojo vibrante con curva inferior */
.pf-hero {
    padding: 100px 0 80px 0;
    background-image: linear-gradient(rgba(60, 31, 31, 0.7), rgba(209, 158, 158, 0.7)), url('imagenes/comida.jpg');
    color: white;
    text-align: center;
    border-bottom-left-radius: 50px; /* Curva más pronunciada estilo App */
    border-bottom-right-radius: 50px;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(226, 30, 30, 0.2);
    position: relative;
    z-index: 1;
}

.pf-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    line-height: 1.1;
    letter-spacing: -1px;
}

.pf-hero p {
    font-size: 1.1rem;
    opacity: 0.9;
    font-weight: 300;
}

.pf-hero .pf-location {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.25);
    padding: 8px 20px;
    border-radius: 30px;
    margin-bottom: 20px;
    font-weight: 600;
    backdrop-filter: blur(5px);
    font-size: 0.9rem;
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    text-decoration: none;
    transition: background 0.3s ease, transform 0.2s;
}

.pf-hero .pf-location:hover {
    background: rgba(255,255,255,0.4);
    transform: scale(1.05);
}

/* Secciones y contenedores */
.container {
    max-width: 1140px;
    margin: auto;
    padding: 0 15px;
}

/* Títulos de sección */
.section-title {
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 30px;
    color: #222;
    position: relative;
    display: inline-block;
}

/* Decoración sutil bajo el título */
.section-title::after {
    content: '';
    display: block;
    width: 40%;
    height: 4px;
    background: #ff4d4d;
    border-radius: 2px;
    margin-top: 5px;
}

/* Tarjetas de categoría estilo "Squircle" */
.pf-cat {
    background: #fff;
    border-radius: 25px; /* Bordes muy redondeados */
    padding: 30px 10px;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    cursor: pointer;
    border: 1px solid rgba(0,0,0,0.04);
    box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.pf-cat:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(255, 77, 77, 0.15);
    border-color: rgba(255, 77, 77, 0.3);
}

.pf-cat i {
    font-size: 2.5rem;
    color: #ff4d4d;
    margin-bottom: 10px;
    transition: transform 0.3s;
}

.pf-cat:hover i {
    transform: scale(1.1);
}

.pf-cat p {
    font-size: 0.95rem;
    font-weight: 700;
    margin: 0;
    color: #444;
}

.pf-card, .card {
    border: none !important;
    border-radius: 20px !important;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    overflow: hidden;
    background: #fff;
}

.pf-card:hover, .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}

.pf-card img, .card img {
    transition: transform 0.5s ease;
}

.pf-card:hover img, .card:hover img {
    transform: scale(1.08); /* Zoom sutil en la imagen */
}

/* Espaciado entre secciones */
.section-spacer {
    margin: 60px 0;
}

/* Modal de producto: estilo limpio */
.modal-content {
    border-radius: 25px;
    overflow: hidden;
    border: none;
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
}

.modal-header {
    background: #f8f8f8;
    border-bottom: 1px solid #eee;
    padding: 20px 30px;
}

.modal-body {
    padding: 30px;
}

.modal-footer {
    border-top: none;
    padding: 20px 30px;
    background: #fcfcfc;
}

/* Imagen del modal */
#modalProductoImagen {
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

/* Botón de pedido estilo moderno */
#btnHacerPedido {
    width: 100%;
    padding: 16px;
    border-radius: 15px;
    font-size: 1.1rem;
    font-weight: 700;
    background: #ff4d4d;
    border: none;
    color: white;
    transition: all 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

#btnHacerPedido:hover {
    background: #d81818;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(255, 77, 77, 0.3);
}

/* Ajustes responsivos */
@media (max-width: 768px) {
    .pf-hero h1 {
        font-size: 2.2rem;
    }
    .pf-hero {
        padding: 80px 0 60px 0;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }
    .pf-cat {
        padding: 20px 5px;
    }
    .pf-cat i {
        font-size: 2rem;
    }
}
</style>

<!-- HERO -->
<div class="pf-hero animate__animated animate__fadeIn">
    <div class="container">
        <!-- Enlace a Google Maps -->
        <a href="https://maps.app.goo.gl/2XbgKQZDFhRLeLzp9" target="_blank" class="pf-location mb-2">
            <i class="bi bi-geo-alt-fill text-warning"></i>
            <span>Pachuca</span>
        </a>
        <h1>¿Qué se te antoja hoy?</h1>
        <p>Descubre los mejores sabores locales entregados a tu puerta.</p>
    </div>
</div>

<!-- SECCIÓN CATEGORÍAS -->
<section class="container section-spacer">
    <div class="section-title">Explorar Categorías</div>
    
    <div class="row g-4 justify-content-center">
        <!-- Todos -->
        <div class="col-6 col-sm-4 col-md-2">
            <a href="inicio.php?op=bienvenida&cat=0" class="text-decoration-none">
                <div class="pf-cat text-center">
                    <i class="bi bi-shop"></i>
                    <p>Todos</p>
                </div>
            </a>
        </div>
        <!-- Comida -->
        <div class="col-6 col-sm-4 col-md-2">
            <a href="inicio.php?op=bienvenida&cat=1" class="text-decoration-none">
                <div class="pf-cat text-center">
                    <i class="bi bi-basket-fill"></i>
                    <p>Comida</p>
                </div>
            </a>
        </div>
        <!-- Bebida -->
        <div class="col-6 col-sm-4 col-md-2">
            <a href="inicio.php?op=bienvenida&cat=2" class="text-decoration-none">
                <div class="pf-cat text-center">
                    <i class="bi bi-cup-hot-fill"></i>
                    <p>Bebida</p>
                </div>
            </a>
        </div>
        <!-- Postres -->
        <div class="col-6 col-sm-4 col-md-2">
            <a href="inicio.php?op=bienvenida&cat=3" class="text-decoration-none">
                <div class="pf-cat text-center">
                    <i class="bi bi-cake2-fill"></i>
                    <p>Postres</p>
                </div>
            </a>
        </div>
        <!-- Servicios -->
        <div class="col-6 col-sm-4 col-md-2">
            <a href="inicio.php?op=bienvenida&cat=4" class="text-decoration-none">
                <div class="pf-cat text-center">
                    <i class="bi bi-briefcase-fill"></i>
                    <p>Servicios</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- SECCIÓN RECOMENDACIONES -->
<section class="container section-spacer">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="section-title m-0">Recomendaciones</div>
        <span class="badge bg-danger rounded-pill px-3 py-2">Populares</span>
    </div>
    
    <!-- Aquí se cargan los productos -->
    <?php include 'productos.php'; ?>
</section>

<!-- MODAL DE PRODUCTO (Funcionalidad intacta) -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalProductoTitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <img id="modalProductoImagen" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="badge bg-light text-danger border border-danger mb-2" id="modalProductoCategoria"></div>
                        <h2 id="modalProductoPrecio" class="text-success fw-bold display-6 mb-3"></h2>
                        <h6 class="text-muted fw-bold">Descripción:</h6>
                        <p id="modalProductoDescripcion" class="text-secondary"></p>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button id="btnHacerPedido" class="btn shadow-sm">
                    <i class="bi bi-whatsapp fs-5"></i> Hacer Pedido
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Lógica JS intacta -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var modalProducto = document.getElementById("modalProducto");
    var botonPedido   = document.getElementById("btnHacerPedido");
    let ultimoProducto = {};

    modalProducto.addEventListener("show.bs.modal", function(event) {
        var card = event.relatedTarget;
        ultimoProducto = {
            titulo: card.getAttribute("data-titulo"),
            precio: card.getAttribute("data-precio"),
            categoria: card.getAttribute("data-categoria"),
            descripcion: card.getAttribute("data-descripcion"),
            telefono: card.getAttribute("data-telefono")
        };
        document.getElementById("modalProductoTitulo").textContent     = ultimoProducto.titulo;
        document.getElementById("modalProductoImagen").src           = card.getAttribute("data-imagen");
        document.getElementById("modalProductoPrecio").textContent   = "$" + ultimoProducto.precio;
        document.getElementById("modalProductoCategoria").textContent = ultimoProducto.categoria;
        document.getElementById("modalProductoDescripcion").textContent = ultimoProducto.descripcion;
    });

    botonPedido.addEventListener("click", function() {
        let numero  = "52" + ultimoProducto.telefono;
        let mensaje = "Hola, quiero hacer un pedido:%0A" +
                      "- *" + ultimoProducto.titulo + "*%0A" +
                      "- Precio: $" + ultimoProducto.precio + "%0A" +
                      "- Categoría: " + ultimoProducto.categoria + "%0A%0A" +
                      "¿Está disponible?";
        let url     = "https://wa.me/" + numero + "?text=" + mensaje;
        window.open(url, "_blank");
    });
});
</script>