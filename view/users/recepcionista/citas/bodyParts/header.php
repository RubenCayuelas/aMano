<header class="header">
  <nav class="d-flex justify-content-between ps-2 pt-2 pb-2">
    <div>
      <h3 class="m-0"><i id="desplegar-aside" class="bi bi-list"></i></h3>
      <a id="desplegar-aside2" class="normal_text" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        <h3><i class="bi bi-list"></i></h3>
      </a>
    </div>
    <div class="d-flex align-items-center justify-content-between" style="width: 215px;">
      <div class="d-flex form-check form-switch p-0 pt-1">
        <i class="bi bi-sun-fill order-1 me-1"></i>
        <input class="form-check-input order-2 ms-1 me-1 p-0" type="checkbox" role="switch" <?php echo $themeState ?> id="theme">
        <i class="bi bi-moon-stars-fill order-3 ms-1"></i>
      </div>
      <a href="../../controlador_login.php?logout" class="normal_text pe-3">Cerrar Sesión</a>
    </div>
  </nav>

  <!-- Menú desplegable (Mismos datos que en Aside) -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" data-bs-toggle="collapse" role="button" aria-expanded="false">
    <div class="offcanvas-header pb-0">
      <h3 class="offcanvas-title" id="offcanvasExampleLabel"><?php echo $_SESSION['nombre']?></h3>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr class="border-2">
    <div class="offcanvas-body">
      <nav class="aside-nav d-flex flex-column pt-5 .justify-content-center flex-shrink-0 p-3 h-100">
        <!-- Menú -->
        <ul class="nav nav-pills flex-column mb-10rem">
          <li class="nav-item mb-4">
            <a href="./controlador_clientes.php" class="nav-link normal_text" >
              <h4 class="d-inline-flex m-0"><i class="icon-aside bi bi-people-fill me-4"></i> Clientes</h4>
            </a>
          </li>
          <li class="nav-item mb-4">
            <a href="./controlador_citas.php" class="nav-link active" aria-current="page">
              <h4 class="d-inline-flex m-0"><i class="icon-aside bi bi-calendar-week me-4"></i> Citas</h4>
            </a>
          </li>
          <li class="nav-item mb-4">
            <a href="./controlador_fotografos.php" class="nav-link normal_text">
              <h4 class="d-inline-flex m-0"><i class="icon-aside bi bi-camera me-4"></i> Fotógrafos</h4>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>