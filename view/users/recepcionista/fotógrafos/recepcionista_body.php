<body data-bs-theme="<?php echo $_SESSION['theme'] ?>">

  <!-- Aside -->
  <?php include('../../../view/users/recepcionista/fotógrafos/bodyParts/aside.php'); ?>

  <!-- Header -->
  <?php include('../../../view/users/recepcionista/fotógrafos/bodyParts/header.php'); ?>

  <!-- Main -->
  <main class="main">
    <!-- Menú con la barrra de búsqueda -->
    <nav class="container-fluid mt-5">
      <div class="row mb-3 pt-2">
        <div class="d-flex flex-column flex-md-row justify-content-between">
          <div class="col-sm col-12 d-md-block d-flex justify-content-center">
            <h2 class="h1 pt-md-0 pb-md-0 pt-3 pb-3">Fotógrafos</h2>
            <hr class="w-30">
          </div>
          <div class="col-md-8 col-12 d-flex align-items-center justify-content-md-end justify-content-center">
            <!-- <button type="button" class="btn btn-outline-primary me-2 ps-1 pe-1" data-bs-toggle="modal" data-bs-target="#newFotógrafos">Añadir Fotógrafos</button> -->
            <form action="#" method="post" class="d-flex align-items-center">
              <input type="search" name="search" id="search" class="form-control" placeholder="Buscar Fotógrafos">
              <button type="submit" name="busqueda" class="btn btn-outline-primary ms-1 p-2 pb-0">
                <span class="material-symbols-outlined">search</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      
    </nav>
    <section class="container-fluid">
