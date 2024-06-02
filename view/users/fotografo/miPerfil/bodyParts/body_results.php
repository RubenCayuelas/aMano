      <div class="row flex-wrap justify-content-between">
        <?php 
          $i=0; 
          foreach ($listaTrabajos as $trabajo) { 
        ?>
          <div class="col-md-5 col-lg-4 mb-3 m-auto">
            <div class="card col-12 ps-0 pe-0 mt-0">
              <div class="card-header"><?php echo $trabajo['nombre']; ?> - <cite title="hour"><?php echo $trabajo['servicio']; ?></cite></div>
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <div class="d-flex mb-2" style="height: 10rem;">
                    <?php 
                      if (!empty($previewTrabajosPictures[$i][0]['foto'])) {
                        echo '<img class="img-fluid w-100 object-fit-cover" src="../../../assets/img/trabajos/'. $trabajo['nick'] .'/'. $trabajo['nombre'] .'/'. $previewTrabajosPictures[$i][0]['foto'] .'" alt="ProyectPrewiew'. $trabajo['nombre'] .'-'. $trabajo['id'] .'">';
                      } else {
                        echo '<img class="img-fluid w-100 object-fit-contain proyectImg" src="../../../assets/img/trabajos/defaut_proyect.png" alt="ProyectPrewiew_default">';
                      }
                    ?>
                  </div>
                  <p class="mb-0 d-flex align-items-center"><?php echo $trabajo['descripcion']; ?></p>
                  <p> Cliente: <?php echo $trabajo['cliente']; ?></p>
                  <div class="blockquote-footer text-secondary-emphasis .d-flex .justify-content-end me-5 pe-5">
                    <?php if ($trabajo['publico']) { ?>
                      <cite title="hour">Proyecto Público</cite>
                    <?php } else { ?>
                      <cite title="hour">Proyecto Privado</cite>
                    <?php } ?>
                  </div>
                </blockquote>
                <div class="w-100 d-flex justify-content-end">
                  <form id="openProyect<?php echo $trabajo['id']; ?>" action="./controlador_trabajo.php" method="post">
                    <input type="hidden" name="trabajo_id" value="<?php echo $trabajo['id']; ?>">
                    <button type="submit" name="openProyect" class="btn btn-outline-primary me-2 ps-3 pe-3 pt-1 pb-1">Ver</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; }?>
      </div>
    </section>
  </main>
</body>