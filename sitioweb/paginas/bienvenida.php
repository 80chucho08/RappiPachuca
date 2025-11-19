<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Fondo general suave para que resalten las tarjetas */
        body {
            background-color: #f9f9f9;
        }

        /* ESTILO DE LA TARJETA "PRO" */
        .food-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            /* Delineado sutil */
            border-radius: 12px;
            /* Bordes modernos redondeados */
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            /* Sombra muy leve en reposo */
        }

        .food-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
            /* Sombra elegante al flotar */
            border-color: #28a745;
            /* Borde verde Rappi/Uber al seleccionar */
        }

        /* CONTENEDOR DE IMAGEN */
        .img-container {
            position: relative;
            width: 100%;
            height: 140px;
            /* Altura fija */
        }

        .img-rectangulo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ETIQUETA DE TIEMPO (FLOTANTE) */
        .time-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background-color: white;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        /* CUERPO DE LA TARJETA */
        .card-body {
            padding: 12px;
            text-align: left;
            /* El texto alineado a la izquierda es más "app" */
        }

        .food-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: #333;
            /* Cortar texto si es muy largo */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .food-desc {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 8px;
        }

        .meta-info {
            display: flex;
            align-items: center;
            font-size: 0.8rem;
            margin-bottom: 10px;
            color: #555;
        }

        .rating-star {
            color: #ffc107;
            /* Color amarillo estrella */
            margin-right: 4px;
        }

        /* PIE DE LA TARJETA (PRECIO Y BOTÓN) */
        .card-footer-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .price {
            font-weight: bold;
            color: #333;
            font-size: 1.1rem;
        }

        .btn-add {
            background-color: #e9f7ef;
            /* Fondo verde muy claro */
            color: #28a745;
            /* Texto verde */
            border: none;
            border-radius: 50%;
            /* Botón redondo */
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-add:hover {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mb-5">

        <div class="d-flex align-items-center justify-content-between mt-4 mb-4">
            <div>
                <h2 class="fw-bold text-dark m-0">Restaurantes y Platos</h2>
                <p class="text-muted small m-0">Cerca de ti • 25 resultados</p>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">

            <?php
            // Generamos precios y tiempos aleatorios para que parezca real
            for ($i = 1; $i <= 25; $i++) {
                $precio = rand(80, 250); // Precio aleatorio entre 80 y 250
                $tiempo = rand(20, 55);  // Tiempo aleatorio
                $rating = number_format(rand(35, 50) / 10, 1); // Rating 3.5 a 5.0
            ?>
                <div class="col">
                    <div class="food-card">

                        <div class="img-container">
                            <img src="./imagenes/<?php echo $i; ?>.jpg" alt="Plato <?php echo $i; ?>" class="img-rectangulo">
                            <div class="time-badge">
                                <i class="bi bi-clock"></i> <?php echo $tiempo; ?> min
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="food-title">Combo Especial <?php echo $i; ?></div>

                            <div class="food-desc">Comida Rápida • Bebidas</div>

                            <div class="meta-info">
                                <i class="bi bi-star-fill rating-star"></i>
                                <span><?php echo $rating; ?> (500+)</span>
                            </div>

                            <div class="card-footer-custom">
                                <span class="price">$<?php echo $precio; ?></span>
                                <button class="btn-add" title="Agregar al carrito">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>

        </div>

    </div>
</body>

</html>