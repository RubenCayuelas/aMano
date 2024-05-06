<section id="solicitudes" class="solicitudes container-xxl mt-5">
  <link rel="stylesheet" href="../../../view/css/styles.css">
  <h2>Solicitudes</h2>
  <hr>

  <?php include_once('../../../view/layout/loading.html'); ?>
  <script src="../../../model/js/loading/loading_recepcionista_solicitudeForm.js"></script>

  <div class="row gap-3 justify-content-center" id="solicitudesContainer">
    <?php
      if (count($solicitudes) == 0) {
        echo '<div class="no_results" style="height: 20vh;">
                <p class="text-center">No hay solicitudes pendientes</p>
              </div>';
      }
    ?>
  </div>
  <div class="col-12 mt-4 d-flex justify-content-center">
    <ul id="paginacion" class="pagination"></ul>
  </div>

<script>
    // Variables para almacenar los datos y el número de página actual
    let solicitudes = <?php echo json_encode($solicitudes); ?>;
    let datosClientes = <?php echo json_encode($datosClientes); ?>;
    let datosServicios = <?php echo json_encode($datosServicios); ?>;
    let datosFotografos = <?php echo json_encode($datosFotografos); ?>;
    
    let paginaActual = 1;
    let solicitudesPorPagina = 6;

      // Función para mostrar las solicitudes en la página actual
      function mostrarSolicitudes() {
        let inicio = (paginaActual - 1) * solicitudesPorPagina;
        let fin = inicio + solicitudesPorPagina;
        let html = '';
        function espDate (fecha) {
          let partes = fecha.split("-");
          // Crear una nueva fecha con el formato dd/mm/yyyy
          let nuevaFecha = partes[2] + "/" + partes[1] + "/" + partes[0];
          return nuevaFecha;
        }

        for (let i = inicio; i < fin && i < solicitudes.length; i++) {
            html += '<div class="card col-12 ps-0 pe-0 mt-0">' +
                      '<div class="card-header">'+ datosServicios[i][0].nombre + ' - <cite title="hour">'+  espDate(solicitudes[i].fecha) +'</cite></div>' +
                      '<div class="card-body">' +
                        '<blockquote class="blockquote mb-0">' +
                          '<div class="d-flex mb-2">' +
                            '<img class="img-fluid w-2_5rem h-2_5rem me-3" src="../../../assets/img/usersPictures/'+ datosClientes[i][0]['foto'] +'" alt="UserPicture '+ datosClientes[i][0]['nombre'] +'">' + 
                            '<p class="mb-0 d-flex align-items-center">' + datosClientes[i][0]['nombre'] + '</p>' +
                          '</div>' +
                          '<p> Fotógrafo: ' + datosFotografos[i][0].nombre + '</p>' +
                          '<div class="blockquote-footer text-secondary-emphasis .d-flex .justify-content-end me-5 pe-5">' +
                            '<cite title="hour">'+  espDate(solicitudes[i].fecha) +' - '+ solicitudes[i].hora.split(':')[0] +':'+ solicitudes[i].hora.split(':')[1] +'h</cite>' +
                          '</div>' +
                        '</blockquote>' +
                        '<div class="w-100 d-flex justify-content-end">' +
                          '<form id="acceptForm" action="controlador_citas.php#solicitudes" method="post">' +
                            '<input type="hidden" name="id" value="'+ solicitudes[i].id +'">' +
                            '<button type="submit" name="sessionSolicitudeAccept" class="btn btn-outline-primary me-2 ps-3 pe-3 pt-1 pb-1">Aceptar</button>' +
                          '</form>' +
                          '<form id="rejectForm" action="controlador_citas.php#solicitudes" method="post">' +
                            '<input type="hidden" name="id" value="'+ solicitudes[i].id +'">' +
                            '<button type="submit" name="sessionSolicitudeReject" class="btn btn-outline-danger me-2 ps-3 pe-3 pt-1 pb-1">Rechazar</button>' +
                          '</form>' +
                        '</div>' +
                      '</div>' +
                    '</div>';
        }
        document.getElementById('solicitudesContainer').innerHTML = html;
        actualizarBotonesPaginacion();
    }

    // Función para generar los botones de paginación
    function generarBotonesPaginacion() {
        let totalPaginas = Math.ceil(solicitudes.length / solicitudesPorPagina);
        let nav = '';

        for (let i = 1; i <= totalPaginas; i++) {
          nav += '<li class="page-item"><button class="page-link pagina" data-pagina="' + i + '">' + i + '</button></li>';
        }

        document.getElementById('paginacion').innerHTML = nav;

        // Agregar event listener a cada botón de página
        let botonesPagina = document.querySelectorAll('.pagina');
        botonesPagina.forEach(function (boton) {
            boton.addEventListener('click', function () {
                paginaActual = parseInt(this.getAttribute('data-pagina'));
                mostrarSolicitudes();
            });
        });
    }

    // Función para actualizar la clase 'active' en los botones de paginación
    function actualizarBotonesPaginacion() {
      let botonesPagina = document.querySelectorAll('.pagina');
      botonesPagina.forEach(function (boton) {
        let numPagina = parseInt(boton.getAttribute('data-pagina'));
        if (numPagina === paginaActual) {
          boton.classList.add('active');
        } else {
          boton.classList.remove('active');
        }
      });
    }

    // Mostrar las solicitudes y generar los botones de paginación al cargar la página
    if (solicitudes.length != 0) {
      mostrarSolicitudes();
    }
    if (solicitudes.length > solicitudesPorPagina) {
      generarBotonesPaginacion();
      actualizarBotonesPaginacion();
    }
  </script>

</section>
</main>
</body>