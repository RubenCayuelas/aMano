<body data-bs-theme=<?php echo $_SESSION['theme'] ?>>

  <!-- Aside -->
  <?php include('../../../view/users/cliente/miPerfil/bodyParts/aside.php'); ?>

  <!-- Header -->
  <?php include('../../../view/users/cliente/miPerfil/bodyParts/header.php'); ?>

  <!-- Main -->
  <main class="main">
    <section class="container-fluid">
      <div class="container mt-5 pt-4">
        <div class="row mb-3">
          <div class="col d-flex flex-sm-nowrap flex-wrap ">
            <div class="profile_picture m-auto m-sm-auto" data-bs-toggle="modal" data-bs-target="#profilePicture">
              <img class="img-fluid w-15rem h-15rem" src="../../../assets/img/usersPictures/<?php echo $cliente['foto'] ?>" alt="@<?php echo $cliente['nick'] ?>">
              <div class="edit_picture_button position-absolute color-bg-default rounded-2 color-fg-default px-2 py-1 left-0 ml-2 mb-2 border" style="top: 18rem;">
                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-pencil">
                  <path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path>
                </svg>
                Editar
              </div>
            </div>
            <!-- Picture Form modal -->
            <div class="modal fade" id="profilePicture" tabindex="-1" aria-labelledby="modalProfilePicture" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header pb-2 pt-2">
                    <h1 class="modal-title fs-5" id="modalProfilePicture">Cambiar foto de perfil: </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body row g-3">
                    <form action="#" method="post" enctype="multipart/form-data">
                      <!-- Picture -->
                      <div class="col-10 m-auto">
                        <input type="file" name="img" id="img" required class="form-control">
                      </div>
                      <div class="col-12 d-flex mt-3">
                        <div class="col-9 d-flex align-items-center justify-content-end pe-3">
                          <button type="submit" name="elimPicture" class="btn btn-sm btn-outline-danger">Eliminar Foto</button>
                        </div>

                        <div class="col-2 d-flex align-items-center justify-content-end">
                          <button type="submit" name="changePicture" class="btn btn-sm btn-secondary">Guardar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="m-auto m-sm-auto profile_form">
              <form action="#" method="post">
                <!-- Name -->
                <label for="name">Nombre: </label>
                <input type="text" name="name" id="name" required class="form-control" value="<?php echo $cliente['nombre'] ?>">

                <!-- Nick -->
                <label for="nick">Nick: </label>
                <input type="text" name="nick" id="nick" required class="form-control" value="<?php echo $cliente['nick'] ?>">

                <div class="col-12 column-gap-1 d-flex justify-content-between">
                  <!-- Tlf -->
                  <div class="col-6 d-flex flex-column">
                    <label for="tlf">Tlf: </label>
                    <input type="text" name="tlf" id="tlf" required class="form-control" value="<?php echo $cliente['tlf'] ?>">
                  </div>
                  <!-- Tlf2 -->
                  <div class="col-6 pe-1 d-flex flex-column">
                    <label for="tlf2">Tlf2: </label>
                    <input type="text" name="tlf2" id="tlf2" class="form-control" value="<?php echo $cliente['tlf2'] ?>">
                  </div>
                </div>

                <div class="col-12 d-flex">
                  <!-- Password -->
                  <div class="col-10 d-flex align-items-center justify-content-end">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded mt-4 me-4" data-bs-toggle="modal" data-bs-target="#modPass">Cambiar Contraseña</button>
                  </div>

                  <!-- Send -->
                  <div class="col-2 d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded mt-4">Guardar</button>
                  </div>
                </div>
              </form>
              <div class="modal fade" id="modPass" tabindex="-1" aria-labelledby="modalModPass" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalModPass">Cambiar Contraseña</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row g-3">
                      <form class="d-flex" action="#" method="post" enctype="multipart/form-data">
                        <!-- Contraseña -->
                        <div class="col-9">
                          <label for="pass" class="form_label">Contraseña:<span class="text-danger">*</span> </label>
                          <input type="password" name="pass" id="pass" required class="form-control">
                        </div>
                        <div class="col-3 d-flex align-items-center justify-content-end mt-4">
                          <button type="submit" name="modPass" class="btn btn-secondary">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <hr>
    