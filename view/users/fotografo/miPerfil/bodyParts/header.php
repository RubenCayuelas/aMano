<!-- Header -->
<header class="header w-100 m-0 p-0">
  <nav class="d-flex justify-content-between ps-2 pt-2 pb-2">
    <div>
      <h4 class="m-0">Fotógrafo <?php echo $fotografo[0]['nombre']; ?></h4>
    </div>
    <div class="d-flex align-items-center justify-content-between" style="width: 215px;">
      <div class="d-flex form-check form-switch p-0 pt-1">
        <i class="bi bi-sun-fill order-1 me-1"></i>
        <input class="form-check-input order-2 ms-1 me-1" type="checkbox" role="switch" <?php echo $themeState ?> id="theme">
        <i class="bi bi-moon-stars-fill order-3 ms-1"></i>
      </div>
      <a href="../../controlador_login.php?logout" class="normal_text pe-3">Cerrar Sesión</a>
    </div>
  </nav>
</header>