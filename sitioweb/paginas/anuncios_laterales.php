<?php
require_once '../servicioweb/servicioweb.php';

$servicios = new clsservicios();
$ads = $servicios->obtenerAnuncios();
?>

<!-- Contenedor Izquierdo -->
<div class="ads-left">
    <?php foreach ($ads as $ad): ?>

        <?php 
            // Generar descuento aleatorio
            $descuento = rand(10, 35);  

            // Precio original
            $precio = $ad['product_cost'];

            // Calcular precio final
            $precio_final = $precio - ($precio * ($descuento / 100));
        ?>

        <div class="ad-box">
            <img src="imagenes/<?php echo $ad['product_image']; ?>" alt="">

            <p class="ad-title"><?php echo $ad['product_title']; ?></p>

            <p class="ad-price-original" style="text-decoration: line-through; font-size:12px; color:#888;">
                $<?php echo number_format($precio, 2); ?>
            </p>

            <p class="ad-discount" style="font-size:13px; font-weight:bold; color:#e60023;">
                -<?php echo $descuento; ?>%
            </p>

            <p class="ad-price-final" style="font-size:15px; font-weight:bold; color:#008f39;">
                $<?php echo number_format($precio_final, 2); ?>
            </p>

            <hr>
        </div>

    <?php endforeach; ?>
</div>

<!-- Contenedor Derecho -->
<div class="ads-right">
    <?php foreach ($ads as $ad): ?>

        <?php 
            $descuento = rand(10, 35);
            $precio = $ad['product_cost'];
            $precio_final = $precio - ($precio * ($descuento / 100));
        ?>

        <div class="ad-box">
            <img src="imagenes/<?php echo $ad['product_image']; ?>" alt="">

            <p class="ad-title"><?php echo $ad['product_title']; ?></p>

            <p class="ad-price-original" style="text-decoration: line-through; font-size:12px; color:#888;">
                $<?php echo number_format($precio, 2); ?>
            </p>

            <p class="ad-discount" style="font-size:13px; font-weight:bold; color:#e60023;">
                -<?php echo $descuento; ?>%
            </p>

            <p class="ad-price-final" style="font-size:15px; font-weight:bold; color:#008f39;">
                $<?php echo number_format($precio_final, 2); ?>
            </p>
            <hr>
        </div>

    <?php endforeach; ?>
</div>

