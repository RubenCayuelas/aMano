<?php
  // Clients per page
  $clientsPerPage = 20;

  // Total of pages
  $totalPages = ceil(count($listaClientes) / $clientsPerPage);
 
  if ($totalPages != 1) {
    // Actual page number
    $actualPage = isset($_GET['pag']) ? $_GET['pag'] : 1;

    // Calculate the initial index of the first record on the current page
    $initialIndex = ($actualPage - 1) * $clientsPerPage;
    
    // List of the clients in the current page
    $clientsInPage = array_slice($listaClientes, $initialIndex, $clientsPerPage);
  } else {
    $clientsInPage = $listaClientes;
  }

  echo '
      <div class="table-responsive">
        <table class="table mx-auto m-0 w-md-90">
          <thead class="table-dark">
            <tr class="text-center">
              <th scope="col" class="lt-rounded">Foto</th>
              <th scope="col">Nombre</th>
              <th scope="col">Nick</th>
              <th scope="col" class="rt-rounded">Tlf</th>
            </tr>
          </thead>
        <tbody>
                ';
    foreach ($clientsInPage as $cliente) {
      echo '
                <tr class="text-center" data-bs-toggle="collapse" href="#infoUsuario' . $cliente['id'] . '" role="button" aria-expanded="false" aria-controls="infoUsuario' . $cliente['id'] . '">
                    <td scope="row">
                      <img src="../../../assets/img/usersPictures/'. $cliente['foto'] .'" alt="Foto de perfil del usuario" class="img-fluid rounded-circle w-2rem h-2rem">
                    </td>
                    <th>' . $cliente['nombre'] . '</th>
                    <td>' . $cliente['nick'] . '</td>
                    <td>' . $cliente['tlf'] . '</td>
                    <!--
                    <td class="w-10">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded" data-bs-toggle="modal" data-bs-target="#modCliente' . $cliente['id'] . '">Editar</button>
                    </td>
                    <td class="w-10">
                        <form action="#" method="post">
                            <button type="submit" name="elimClientes" class="btn btn-outline-danger" style="padding: 0px 10px 5px 10px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    -->
                </tr>
                <tr>
                    <td colspan="4" class="p-0">
                        <div class="collapse" id="infoUsuario' . $cliente['id'] . '">
                            <button type="button" class="btn-close float-end mt-2 me-2" aria-label="Close" data-bs-toggle="collapse" href="#infoUsuario' . $cliente['id'] . '" role="button" aria-expanded="false" aria-controls="infoUsuario' . $cliente['id'] . '"></button>
                            <div class="card card-body w-100 bw-0 row flex-row pt-0 ms-0">
                                <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                    <div class="imgUsuario">
                                    <img src="../../../assets/img/usersPictures/' . $cliente['foto'] . '" alt="Foto de perfil del usuario" class="img-fluid rounded-circle w-3_5rem h-3_5rem">
                                </div>
                                </div>
                                <div class="col-sm-3 col-6 d-sm-block d-flex flex-column align-items-center">
                                    <h4>Nombre:</h4>
                                    <h5 class="ms-1">' . $cliente['nombre'] . '</h5>
                                    <p>Nick: ' . $cliente['nick'] . '</p>
                                </div>
                                <div class="col-sm-3 col-6 d-sm-block d-flex flex-column align-items-center">
                                    <h4>Teléfono/s</h4>
                                    <p class="m-0 ms-1"><i class="bi bi-telephone-fill"></i> ' . $cliente['tlf'] . '</p>';
                                    if ($cliente['tlf2'] != '') {
                                      echo '<p class="m-0 ms-1"><i class="bi bi-telephone-fill"></i> ' . $cliente['tlf2'] . '</p>';
                                    }
      echo                     '</div>
                                <div class="col-sm-3 d-flex justify-content-around align-items-center flex-wrap">
                                    <div>
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded" data-bs-toggle="modal" data-bs-target="#modCliente' . $cliente['id'] . '">Editar</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded" data-bs-toggle="modal" data-bs-target="#addCita' . $cliente['id'] . '">Añadir Cita</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                
              <div class="modal fade" id="modCliente' . $cliente['id'] . '" tabindex="-1" aria-labelledby="modalModCliente' . $cliente['id'] . '" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="modalModCliente' . $cliente['id'] . '">Editar Cliente</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body row g-3">
                              <form action="#" method="post">
                                  <!-- Nombre -->
                                  <div class="col-6">
                                      <label for="nombre" class="form_label">Nombre:<span class="text-danger">*</span> </label>
                                      <input type="text" name="nombre" id="nombre' . $cliente['id'] . '" required class="form-control" value="' . $cliente['nombre'] . '">
                                  </div>
                                  <!-- Nick -->
                                  <div class="col-6">
                                      <label for="nick" class="form_label">Nick:<span class="text-danger">*</span> </label>
                                      <input type="text" name="nick" id="nick' . $cliente['id'] . '" required class="form-control" value="' . $cliente['nick'] . '">
                                  </div>
                                  <!-- Tlf -->
                                  <div class="col-6">
                                      <label for="tlf" class="form_label">Tlf:<span class="text-danger">*</span> </label>
                                      <input type="text" name="tlf" id="tlf' . $cliente['id'] . '" required class="form-control" value="' . $cliente['tlf'] . '">
                                  </div>
                                  <!-- Tlf2 -->
                                  <div class="col-6">
                                      <label for="tlf2" class="form_label">Tlf2: </label>
                                      <input type="text" name="tlf2" id="tlf2' . $cliente['id'] . '" class="form-control" value="' . $cliente['tlf2'] . '">
                                  </div>
                                  <!-- Cambiar contraseña -->
                                  <div class="col-12 d-flex align-items-center justify-content-center">
                                      <button type="button" class="btn btn-sm btn-outline-secondary rounded mt-4" data-bs-toggle="modal" data-bs-target="#modPass' . $cliente['id'] . '">Cambiar Contraseña</button>
                                  </div>
                                  <div class="col-12 d-flex align-items-center justify-content-end">
                                      <button type="submit" name="modCliente" value="' . $cliente['id'] . '" class="btn btn-secondary">Enviar</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal fade" id="modPass' . $cliente['id'] . '" tabindex="-1" aria-labelledby="modalModPass' . $cliente['id'] . '" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="modalModPass' . $cliente['id'] . '">Cambiar Contraseña</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body row g-3">
                              <form action="#" method="post" enctype="multipart/form-data">
                                  <!-- Contraseña -->
                                  <div class="col-10">
                                      <label for="pass' . $cliente['id'] . '" class="form_label">Contraseña:<span class="text-danger">*</span> </label>
                                      <input type="password" name="pass" id="pass' . $cliente['id'] . '" required class="form-control">
                                  </div>
                                  <div class="col-2 d-flex align-items-center justify-content-end mt-2_5rem">
                                      <button type="submit" name="modPass" value="' . $cliente['id'] . '" class="btn btn-secondary">Enviar</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal fade" id="addCita' . $cliente['id'] . '" tabindex="-1" aria-labelledby="modalAddCitaCliente' . $cliente['id'] . '" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="modalAddCitaCliente' . $cliente['id'] . '">Añadir Cita</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body row g-3">
                              <form action="#" method="post">
                                  <!-- Date -->
                                  <div class="col-7">
                                      <label for="date' . $cliente['id'] . '" class="form_label">Fecha:<span class="text-danger">*</span> </label>
                                      <input type="date" name="date" id="date' . $cliente['id'] . '" required class="form-control">
                                  </div>
                                  <!-- Time -->
                                  <div class="col-5">
                                      <label for="time' . $cliente['id'] . '" class="form_label">Hora:<span class="text-danger">*</span> </label>
                                      <input type="time" name="time" id="time' . $cliente['id'] . '" required class="form-control">
                                  </div>
                                  <!-- Fotógrafo -->
                                  <div class="col-6">
                                      <label for="fotografo' . $cliente['id'] . '" class="form_label">Fotógrafo:<span class="text-danger">*</span> </label>
                                      <select name="fotografo" id="fotografo' . $cliente['id'] . '" required class="form-select">';
                                        foreach ($listaFotografos as $fotografo) {
                                          echo '<option value="'. $fotografo['id'] .'">'. $fotografo['nombre'] .'</option>';
                                        }
      echo                            '</select>
                                  </div>
                                  <!-- Servicio -->
                                  <div class="col-6">
                                      <label for="servicio' . $cliente['id'] . '" class="form_label">Servicio:<span class="text-danger">*</span> </label>
                                      <select type="text" name="servicio" id="servicio' . $cliente['id'] . '" required class="form-select">';
                                        foreach ($listaServicios as $servicio) {
                                          echo '<option value="'. $servicio['id'] .'">'. $servicio['nombre'] .'</option>';
                                        }
      echo                            '</select>
                                  </div>
                                  <div class="col-12 d-flex align-items-center justify-content-end">
                                      <button type="submit" name="addCita" value="' . $cliente['id'] . '" class="btn btn-secondary">Enviar</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
            ';
    }
  echo '  
            </tbody>
          </table>
        </div>';

  // Navigation
  echo '<nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">';
    // Show the numbers of pages
    if ($totalPages != 1) {
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item mt-4 mb-3 ' . ($i == $actualPage ? 'active' : '') . '"><a class="page-link" href="?pag=' . $i . '">' . $i . '</a></li>';
        }
    }
  echo '</ul>
      </nav>';
?>

    </section>
  </main>
</body>
