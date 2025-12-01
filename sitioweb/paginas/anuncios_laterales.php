<?php
require_once '../servicioweb/servicioweb.php';

$servicios = new clsservicios();
$ads = $servicios->obtenerAnuncios();
?>

<style>
    /* --- CONTENEDOR LATERAL FIJO --- */
    .ads-sidebar {
        position: fixed;
        bottom: 0;
        width: 150px; 
        z-index: 50; 
        overflow: hidden; 
        pointer-events: none; 
    }

    .ads-left { left: 0; }
    .ads-right { right: 0; }

    /* --- PISTA DE ANIMACIÓN --- */
    .ads-track {
        display: flex;
        flex-direction: column;
        gap: 20px; /* Un poco menos de espacio entre tarjetas */
        pointer-events: auto; 
        animation: scrollVertical 25s linear infinite alternate; 
    }

    @keyframes scrollVertical {
        0% { transform: translateY(0); }
        100% { transform: translateY(calc(-100% + 80vh)); } 
    }

    .ads-sidebar:hover .ads-track {
        animation-play-state: paused;
    }

    /* --- TARJETA ESTILO REFERENCIA (COMPACTA) --- */
    .ad-card-clean {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        padding: 0; 
        text-align: left; 
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden; 
        padding-bottom: 10px; /* Menos espacio abajo */
        border: 1px solid rgba(0,0,0,0.02);
    }

    .ad-card-clean:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    /* Contenedor de la imagen */
    .ad-image-container {
        padding: 6px 6px 0 6px; /* Padding reducido */
    }

    .ad-image-container img {
        width: 100%;
        height: 95px; /* Imagen menos alta */
        object-fit: cover;
        border-radius: 10px;
    }

    /* Títulos y Textos */
    .ad-title {
        font-weight: 800; 
        font-size: 0.9rem;
        color: #1a1a1a;
        margin: 8px 0 2px 0; 
        line-height: 1.2;
        padding-left: 12px; 
        padding-right: 5px;
    }

    .ad-price-group {
        display: flex;
        flex-direction: column;
        gap: 0px; 
        align-items: flex-start; /* Alineación de precios a la IZQUIERDA */
        padding-left: 12px; /* Espacio a la izquierda */
    }

    .price-original {
        color: #999;
        text-decoration: line-through;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .discount-text {
        color: #dc3545; 
        font-weight: 800;
        font-size: 0.9rem;
    }

    .price-final {
        color: #198754; 
        font-weight: 800;
        font-size: 1.1rem; 
        margin-top: 0px;
    }

    /* Responsive */
    @media (max-width: 1300px) {
        .ads-sidebar { display: none; }
        body { padding-left: 0 !important; padding-right: 0 !important; }
    }
</style>

<!-- === BARRA IZQUIERDA === -->
<div class="ads-sidebar ads-left">
    <div class="ads-track">
        <?php foreach ($ads as $ad): ?>
            <?php 
                $descuento = 20; 
                $precio = $ad['product_cost'];
                $precio_final = $precio - ($precio * ($descuento / 100));
            ?>

            <div class="ad-card-clean">
                <div class="ad-image-container">
                    <img src="imagenes/<?php echo $ad['product_image']; ?>" alt="Producto">
                </div>

                <div class="ad-title">
                    <?php echo $ad['product_title']; ?>
                </div>

                <div class="ad-price-group">
                    <span class="price-original">
                        $<?php echo number_format($precio, 2); ?>
                    </span>
                    <span class="discount-text">
                        -<?php echo $descuento; ?>%
                    </span>
                    <span class="price-final">
                        $<?php echo number_format($precio_final, 2); ?>
                    </span>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<!-- === BARRA DERECHA === -->
<div class="ads-sidebar ads-right">
    <div class="ads-track" style="animation-delay: -10s;"> 
        <?php foreach ($ads as $ad): ?>
            <?php 
                $descuento = 23; 
                $precio = $ad['product_cost'];
                $precio_final = $precio - ($precio * ($descuento / 100));
            ?>

            <div class="ad-card-clean">
                <div class="ad-image-container">
                    <img src="imagenes/<?php echo $ad['product_image']; ?>" alt="Producto">
                </div>

                <div class="ad-title">
                    <?php echo $ad['product_title']; ?>
                </div>

                <div class="ad-price-group">
                    <span class="price-original">
                        $<?php echo number_format($precio, 2); ?>
                    </span>
                    <span class="discount-text">
                        -<?php echo $descuento; ?>%
                    </span>
                    <span class="price-final">
                        $<?php echo number_format($precio_final, 2); ?>
                    </span>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>