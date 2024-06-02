  <section class="row flex-wrap justify-content-between mt-3 mx-0">
    <?php 
      $i=0; 
      foreach ($listaFotos as $foto) { 
    ?>
      <div class="col-md-5 col-lg-4 mb-3 m-auto">
        <div class="card col-12 ps-0 pe-0 mt-0">
          <div class="card-body p-1">
            <blockquote class="blockquote mb-0">
              <div class="d-flex mb-2">
                <?php 
                  echo '<img class="img-fluid w-100 object-fit-cover" style="border-radius: 0.375rem;" src="../../../assets/img/trabajos/'. $trabajo['nick'] .'/'. $trabajo['nombre'] .'/'. $foto['foto'] .'" alt="Picture'. $trabajo['nombre'] .'-'. $trabajo['id'] .'">';
                ?>
              </div>
            </blockquote>
            <div class="w-100 d-flex justify-content-between">
              <form id="selectPreviewPicture<?php echo $listaFotos[$i]['id']; ?>" action="#" method="post">
                <input type="hidden" name="trabajo_id" value="<?php echo $trabajo['id']; ?>">
                <input type="hidden" name="openProyect">
                <?php if (isset($previewPicture[0]['id']) && $previewPicture[0]['id'] == $listaFotos[$i]['id']) { ?>
                  <button type="submit" name="selectPreviewPicture" value="<?php echo $listaFotos[$i]['id']; ?>" disabled class="btn btn-outline-primary ps-3 pe-3 pt-1 pb-1">Seleccionado como Preview</button>
                <?php } else { ?>
                  <button type="submit" name="selectPreviewPicture" value="<?php echo $listaFotos[$i]['id']; ?>" class="btn btn-outline-primary ps-3 pe-3 pt-1 pb-1">Seleccionar como Preview</button>
                <?php } ?>
              </form>
              <form id="deletePicture<?php echo $listaFotos[$i]['id']; ?>" action="#" method="post">
                <input type="hidden" name="trabajo_id" value="<?php echo $trabajo['id']; ?>">
                <input type="hidden" name="openProyect">
                <button type="submit" name="deletePicture" value="<?php echo $listaFotos[$i]['id']; ?>" class="btn btn-outline-danger ps-3 pe-3 pt-1 pb-1">Eliminar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php $i++; }?>
  </section>

  </main>
</body>