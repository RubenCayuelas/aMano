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

      <div class="d-flex form-check form-switch p-0 pt-1">
        
        <?php if ($trabajo['publico']) { ?>
          <input class="form-check-input ms-1 me-1" type="checkbox" checked role="switch" id="workStatus">
          <cite id="workStatusCite">Proyecto Público</cite>
        <?php } else { ?>
          <input class="form-check-input ms-1 me-1" type="checkbox" role="switch" id="workStatus">
          <cite id="workStatusCite">Proyecto Privado</cite>
        <?php } ?>
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
                trabajo_id: <?php echo $trabajo['id']; ?>,
                publico: isChecked
              })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.mensaje);
            })
            .catch(error => console.error('Error:', error));
          });
        </script>
        
      </div>

    </section>
    