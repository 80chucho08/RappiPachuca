<?php
// piepag.php
// Este archivo contiene el pie de página de la aplicación.
?>
<footer class="bg-dark text-light position-relative mt-5 pt-5">
  <div class="position-absolute top-0 start-0 w-100" style="transform: translateY(-100%); overflow:hidden; height:80px;">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-100 h-100">
      <path d="M0,0 C300,100 900,0 1200,100 L1200,120 L0,120 Z" fill="rgba(34,211,238,.18)">
        <animate attributeName="d" dur="12s" repeatCount="indefinite"
          values="M0,0 C300,100 900,0 1200,100 L1200,120 L0,120 Z; M0,0 C250,80 950,40 1200,90 L1200,120 L0,120 Z; M0,0 C300,100 900,0 1200,100 L1200,120 L0,120 Z" />
      </path>
      <path d="M0,10 C260,90 940,20 1200,95 L1200,120 L0,120 Z" fill="rgba(167,139,250,.15)">
        <animate attributeName="d" dur="10s" repeatCount="indefinite"
          values="M0,10 C260,90 940,20 1200,95 L1200,120 L0,120 Z; M0,10 C220,70 980,50 1200,85 L1200,120 L0,120 Z; M0,10 C260,90 940,20 1200,95 L1200,120 L0,120 Z" />
      </path>
    </svg>
  </div>

  <div class="container">
    <div class="row g-4">
      
      <div class="col-12 col-md-6 col-lg-3">
        <h5 class="fw-bold">Acerca de [Proyecto]</h5>
        <p class="text-secondary mb-3">
          Descripción corta del proyecto, su misión principal o un resumen.
        </p>
        <div class="d-flex gap-2">
          <a class="btn btn-outline-light btn-sm rounded-3" href="#" title="Red 1"><i class="bi bi-github"></i></a>
          <a class="btn btn-outline-light btn-sm rounded-3" href="#" title="Red 2"><i class="bi bi-youtube"></i></a>
          <a class="btn btn-outline-light btn-sm rounded-3" href="#" title="Red 3"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <h5 class="fw-bold">Enlaces Rápidos</h5>
        <ul class="list-unstyled">
          <li class="mb-1"><a class="link-light link-opacity-75-hover text-decoration-none" href="inicio.php">Inicio</a></li>
          <li class="mb-1"><a class="link-light link-opacity-75-hover text-decoration-none" href="inicio.php?op=servicios">Servicios</a></li>
          <li class="mb-1"><a class="link-light link-opacity-75-hover text-decoration-none" href="inicio.php?op=contacto">Contacto</a></li>
          <li class="mb-1"><a class="link-light link-opacity-75-hover text-decoration-none" href="#" id="pfGoTopLink">Volver arriba</a></li>
        </ul>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <h5 class="fw-bold">Información</h5>
        <ul class="list-unstyled text-secondary mb-0">
          <li>Dirección de la empresa/institución</li>
          <li>Email: [correo_generico]</li>
          <li>Tel: [telefono_generico]</li>
        </ul>
      </div>


    <hr class="border-secondary-subtle my-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center pb-4">
      <span class="text-secondary small">© <?php echo date('Y'); ?> [Nombre del Proyecto]. Todos los derechos reservados.</span>
      <div class="d-flex gap-3 small mt-2 mt-md-0">
        <a href="#" class="link-light link-opacity-75-hover text-decoration-none">Aviso de Privacidad</a>
        <a href="#" class="link-light link-opacity-75-hover text-decoration-none">Términos de Uso</a>
      </div>
    </div>
  </div>

  <button id="pfTopBtn" class="btn btn-light rounded-4 shadow position-fixed" type="button"
    style="right: 16px; bottom: 16px; transform: translateY(120%); transition:.25s ease;">
    <i class="bi bi-arrow-up"></i>
  </button>
</footer>

<style>
  /* --- Estilos necesarios para los componentes del footer --- */
  .btn-gradient{
    background: linear-gradient(90deg, #22d3ee, #34d399);
    color:#0b1020; border: none;
  }
  .btn-gradient:hover{ filter: brightness(1.07); }

  /* Lógica de visibilidad del botón */
  #pfTopBtn.show { transform: translateY(0) !important; }

  /* Efecto hover suave (opcional, pero se mantuvo) */
  .card, .btn, .nav-link { transition: transform .2s ease, box-shadow .2s ease; }
  .card:hover { transform: translateY(-2px); box-shadow: 0 1rem 2rem rgba(0,0,0,.15) !important; }
</style>

<script>
  // Script de ejemplo para el boletín
  function pfNewsletterThanks(){
    alert('¡Gracias! (Aquí iría la lógica de envío al servidor)');
  }
  
  // Script para el botón "Volver arriba"
  (function(){
    const topBtn = document.getElementById('pfTopBtn');
    const goTopLink = document.getElementById('pfGoTopLink');

    const onScroll = () => {
      // Muestra el botón cuando el usuario ha bajado 280px
      if (window.scrollY > 280) topBtn.classList.add('show');
      else topBtn.classList.remove('show');
    };
    
    // Eventos
    window.addEventListener('scroll', onScroll);
    topBtn.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));
    goTopLink?.addEventListener('click', (e)=>{ e.preventDefault(); window.scrollTo({top:0, behavior:'smooth'}); });
    onScroll(); // Llamar al inicio para verificar la posición inicial
  })();
</script>