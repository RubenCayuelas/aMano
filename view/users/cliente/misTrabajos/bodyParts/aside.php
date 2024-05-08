<!-- Aside -->
<aside class="aside" id="aside">
  <div class="aside-info">
    <!-- Nombre -->
    <h3 class="mt-4 ms-3 mb-4"><?php echo $_SESSION['nombre'] ?></h3>
    <hr class="border-2">
  </div>
  <nav class="aside-nav d-flex flex-column pt-5 .justify-content-center flex-shrink-0 p-3 h-100">
    <!-- Menú -->
    <ul class="nav nav-pills flex-column mb-10rem">
      <li class="nav-item mb-4">
        <a href="./controlador_miPerfil.php" class="nav-link normal_text">
          <h4 class="d-inline-flex m-0"><i class="icon-aside bi bi-people-fill me-4"></i> Mi Perfil</h4>
        </a>
      </li>
      <li class="nav-item mb-4">
        <a href="./controlador_citas.php" class="nav-link normal_text">
          <h4 class="d-inline-flex m-0"><i class="icon-aside bi bi-calendar-week me-4"></i> Mis Citas</h4>
        </a>
      </li>
      <li class="nav-item mb-4">
        <a href="./controlador_trabajos.php" class="nav-link active" aria-current="page">
          <h4 class="d-inline-flex m-0"><i class="icon-aside bi bi-camera me-4"></i> Mis Trabajos</h4>
        </a>
      </li>
    </ul>
  </nav>
</aside>