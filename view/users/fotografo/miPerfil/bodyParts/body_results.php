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
                  <div class="d-flex mb-2">
                    <img class="img-fluid" src="../../../assets/img/trabajos/<?php echo $trabajo['nick']; ?>/<?php echo $trabajo['nombre']; ?>/<?php echo $previewTrabajosPictures[$i][0]['foto']; ?>" alt="ProyectPrewiew<?php echo $trabajo['nombre']; ?>-<?php echo $trabajo['id']; ?>">
                  </div>
                  <p class="mb-0 d-flex align-items-center"><?php echo $trabajo['descripcion']; ?></p>
                  <p> Fotógrafo: <?php echo $trabajo['fotografo']; ?></p>
                  <div class="blockquote-footer text-secondary-emphasis .d-flex .justify-content-end me-5 pe-5">
                    <?php if ($trabajo['publico']) { ?>
                      <cite title="hour">Proyecto Público</cite>
                    <?php } else { ?>
                      <cite title="hour">Proyecto Privado</cite>
                    <?php } ?>
                  </div>
                </blockquote>
                <div class="w-100 d-flex justify-content-end">
                  <form id="openProyect" action="./controlador_trabajo.php" method="post">
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