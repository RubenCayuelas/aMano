<div class="table-responsive">
    <table class="table mx-auto m-0 w-md-90">
        <thead class="table-dark">
            <tr class="text-center">
                <th scope="col" class="lt-rounded">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nick</th>
                <th scope="col">Habilidades</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaFotografos as $fotografo) : ?>
                <tr class="text-center" data-bs-toggle="collapse" href="#infoFotografo<?= $fotografo['id'] ?>" role="button" aria-expanded="false" aria-controls="infoFotografo<?= $fotografo['id'] ?>">
                    <td scope="row">
                        <img src="../../../assets/img/usersPictures/<?= $fotografo['foto'] ?>" alt="Foto de perfil del fotógrafo" class="img-fluid rounded-circle w-2rem h-2rem">
                    </td>
                    <th><?= $fotografo['nombre'] ?></th>
                    <td><?= $fotografo['nick'] ?></td>
                    <td><?= $fotografo['habilidades'] ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-0">
                        <div class="collapse" id="infoFotografo<?= $fotografo['id'] ?>">
                            <button type="button" class="btn-close float-end mt-2 me-2" aria-label="Close" data-bs-toggle="collapse" href="#infoFotografo<?= $fotografo['id'] ?>" role="button" aria-expanded="false" aria-controls="infoFotografo<?= $fotografo['id'] ?>"></button>
                            <div class="card card-body w-100 bw-0 row flex-row pt-0 ms-0">
                                <div class="col-2 d-flex align-items-center justify-content-center">
                                    <div class="imgUsuario">
                                        <img src="../../../assets/img/usersPictures/<?= $fotografo['foto'] ?>" alt="Foto de perfil del fotógrafo" class="img-fluid rounded-circle w-3_5rem h-3_5rem">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h4>Descripción:</h4>
                                    <p><?= $fotografo['descripcion'] != null ? $fotografo['descripcion'] : '<span>No se ha encontrado descripción</span>' ?></p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
