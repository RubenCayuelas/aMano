<header>
  <nav class="navbar navbar-expand-md bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand ms-3 logoHeader w-15rem" aria-current="page" href="./index.php">
        <!-- Fotografía a Mano Logo -->
        <img src="./assets/img/logo/logo+text_noBackground.png" alt="" class="img-fluid img_bn">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./controller/controlador_trabajos.php">Trabajos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./controller/controlador_fotografos.php">Fotógrafos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./controller/controlador_contacto.php">Contacto</a>
          </li>
        </ul>
        <div class="navbar-text me-4 d-flex align-items-md-center justify-content-between pt-0" style="width: 190px;">
          <div class="d-flex form-check form-switch p-0 pt-1">
            <i class="bi bi-sun-fill order-1 me-1"></i>
            <input class="form-check-input order-2 ms-1 me-1" type="checkbox" role="switch" <?php echo $themeState ?> id="theme">
            <i class="bi bi-moon-stars-fill order-3 ms-1"></i>
          </div>
          <a class="nav-link" href="./controller/controlador_login.php">Iniciar Sesión</a>
        </span>
      </div>
    </div>
  </nav>
</header>