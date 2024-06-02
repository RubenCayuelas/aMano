<body data-bs-theme=<?php echo $_SESSION['theme'] ?>>

  <!-- Header -->
  <?php include('../../../view/users/fotografo/trabajos/bodyParts/header.php'); ?>

  <!-- Main -->
  <main class="main w-100 m-0">
    <section style="width: 100%; height: 30vh;">
      <?php if (isset($previewPicture[0]['foto'])) { ?>
        <div style="width: 100%; height: 100%; background-image:url('../../../assets/img/trabajos/<?php echo $trabajo['nick'] ?>/<?php echo $trabajo['nombre'] ?>/<?php echo $previewPicture[0]['foto'] ?>'); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: center;">
          <div style="height: 100%; background-color: #00000045; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <h1><?php echo $trabajo['nombre'] ?></h1>
          </div>
        </div>
      <?php } else { ?>
        <div style="width: 100%; height: 100%; ">
          <div style="height: 100%; background-color: #00000045; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <h1><?php echo $trabajo['nombre'] ?></h1>
          </div>
        </div>
      <?php } ?>
    </section>
    <section class="container-fluid mt-1 pt-4">
      <p><?php echo $trabajo['descripcion'] ?></p>
      <p>Tipo de servicio: <?php echo $trabajo['servicio'] ?></p>
      <span class="d-block text-end me-5"> Trabajo realizado para <?php echo $trabajo['cliente'] ?></span>

      <div class="d-flex flex-column flex-md-row justify-content-between pt-3">
        <div>
          <?php if ($trabajo['publico']) { ?>
            <input class="form-check-input ms-1 me-1" type="checkbox" checked role="switch" id="workStatus">
            <cite id="workStatusCite">Proyecto Público</cite>
          <?php } else { ?>
            <input class="form-check-input ms-1 me-1" type="checkbox" role="switch" id="workStatus">
            <cite id="workStatusCite">Proyecto Privado</cite>
          <?php } ?>
        </div>
        <!-- Fix Ajax solicitude doesn't work -->
        <script>
          const workStatus = document.getElementById('workStatus');
          const statusCite = document.getElementById('workStatusCite');

          workStatus.addEventListener('change', ()=>{
            isChecked = workStatus.checked;
            statusCite.innerHTML = isChecked ? 'Proyecto Público' : 'Proyecto Privado';

            // ----------------------------------------------------------------
            fetch('controlador_trabajo.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                openProyect: true,
                updateWorkStatus: true,
                trabajo_id: <?php echo json_encode($trabajo['id']); ?>,
                publico: isChecked
              })
            })
            .then(response => response.json())
            .catch(error => console.error('Error:', error));
          });
        </script>
        <button type="button" class="btn btn-outline-primary me-0 me-md-5 ps-1 pe-1" data-bs-toggle="modal" data-bs-target="#newPictures"><i class="bi bi-folder-plus"></i> Añadir Fotografías</button>
        <div class="modal fade" id="newPictures" tabindex="-1" aria-labelledby="modalNewPictures" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalNewPictures">Selecciona las fotografías</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="#" method="post" class="row g-3" enctype="multipart/form-data">
                  <div class="col-12">
                    <label for="pictures" class="form_label">Fotografías: </label>
                    <input type="file" name="pictures[]" id="pictures" multiple class="form-control">
                  </div>
                  <div class="col-12 d-flex align-items-center justify-content-end">
                    <input type="hidden" name="openProyect">
                    <input type="hidden" name="trabajo_id" value="<?php echo $trabajo['id']; ?>">
                    <button type="submit" name="newPictures" class="btn btn-secondary">Añadir</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    