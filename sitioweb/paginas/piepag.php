<footer class="pf-footer mt-5">
    <div class="container pt-5 pb-4">
        <div class="row g-4 justify-content-between">
            
            <!-- Columna 1: Marca y Descripción -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-white fw-bold mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-basket2-fill text-danger fs-4"></i> Rappi Pachuca
                </h5>
                <p class="text-secondary small" style="line-height: 1.8;">
                    Plataforma creada como práctica profesional para gestionar pedidos y repartos de manera eficiente. Conectamos lo mejor de Pachuca contigo.
                </p>
                
                <!-- Redes Sociales -->
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

            <!-- Columna 2: Enlaces Rápidos -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h6 class="text-white fw-bold text-uppercase ls-1 mb-4 small opacity-75">Navegación</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="inicio.php" class="footer-link">Inicio</a></li>
                    <li><a href="inicio.php?op=servicios" class="footer-link">Servicios</a></li>
                    <li><a href="inicio.php?op=contacto" class="footer-link">Contacto</a></li>
                    <li><a href="inicio.php?op=acceso" class="footer-link">Acceso Colaboradores</a></li>
                </ul>
            </div>

            <!-- Columna 3: Información de Contacto -->
            <div class="col-lg-4 col-md-6">
                <h6 class="text-white fw-bold text-uppercase ls-1 mb-4 small opacity-75">Contáctanos</h6>
                <ul class="list-unstyled d-flex flex-column gap-3">
                    <li class="d-flex align-items-start gap-3 text-secondary small">
                        <div class="icon-circle-small"><i class="bi bi-geo-alt-fill"></i></div>
                        <span style="margin-top: 2px;">Centro de Pachuca, Hidalgo, México.</span>
                    </li>
                    <li class="d-flex align-items-center gap-3 text-secondary small">
                        <div class="icon-circle-small"><i class="bi bi-envelope-fill"></i></div>
                        <a href="mailto:contacto@rappipachuca.com" class="text-secondary text-decoration-none hover-white">contacto@rappipachuca.com</a>
                    </li>
                    <li class="d-flex align-items-center gap-3 text-secondary small">
                        <div class="icon-circle-small"><i class="bi bi-whatsapp"></i></div>
                        <span class="hover-white">771-000-0000</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="border-secondary opacity-10 my-5">

        <!-- Barra Inferior -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-secondary">
            <p class="mb-2 mb-md-0 opacity-75">
                &copy; <?= date('Y') ?> <strong>Rappi Pachuca</strong>. Todos los derechos reservados.
            </p>
            <div class="d-flex gap-4">
                <a href="#" class="footer-link-bottom">Privacidad</a>
                <a href="#" class="footer-link-bottom">Términos</a>
                <a href="#" class="footer-link-bottom">Cookies</a>
            </div>
        </div>
    </div>
</footer>

<style>
    /* --- ESTILOS DEL FOOTER --- */
    .pf-footer {
        background-color: #111111; /* Fondo oscuro premium */
        color: #b0b0b0;
        position: relative;
        z-index: 10;
        font-family: 'Segoe UI', sans-serif;
    }

    .ls-1 { letter-spacing: 1px; }

    /* Iconos Sociales */
    .social-icon {
        width: 38px;
        height: 38px;
        background: rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 1px solid transparent;
    }

    .social-icon:hover {
        background: #ff4d4d; /* Color Rappi al hover */
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 77, 77, 0.3);
    }

    /* Enlaces de Navegación */
    .footer-link {
        color: #999;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        font-size: 0.95rem;
    }

    .footer-link:hover {
        color: #ff4d4d;
        transform: translateX(6px); /* Efecto de desplazamiento a la derecha */
    }

    /* Iconos de contacto pequeños */
    .icon-circle-small {
        width: 25px;
        height: 25px;
        background: rgba(255, 77, 77, 0.1);
        color: #ff4d4d;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .hover-white { transition: color 0.2s; }
    .hover-white:hover { color: #fff !important; }

    /* Links inferiores (Privacidad, etc.) */
    .footer-link-bottom {
        color: #555;
        text-decoration: none;
        transition: 0.3s;
        font-weight: 500;
    }

    .footer-link-bottom:hover {
        color: #ccc;
    }
</style>