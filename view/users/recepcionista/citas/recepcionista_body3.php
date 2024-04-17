<section class="solicitudes container-xxl mt-5">
  <link rel="stylesheet" href="../../../view/css/styles.css">
  <h2>Solicitudes</h2>
  <hr>
  <div class="row gap-3 justify-content-center" id="solicitudesContainer">
    <?php
      // for ($i=0; $i < count($solicitudes); $i++) { 
      //   echo '<div class="card col-12 ps-0 pe-0 mt-0">
      //           <div class="card-header">
      //             '.$datosClientes[$i][0]['nombre'].'
      //           </div>
      //           <div class="card-body">
      //             <blockquote class="blockquote mb-0">
      //               <p>A well-known quote, contained in a blockquote element.</p>
      //               <div class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></div>
      //             </blockquote>
      //             <div class="w-100 d-flex justify-content-end">
      //               <button type="button" class="btn btn-outline-primary me-2 ps-3 pe-3">Aceptar</button>
      //             </div>
      //           </div>
      //         </div>';
      // }
    ?>
  </div>
  <div class="col-12 mt-4 d-flex justify-content-center">
    <ul id="paginacion" class="pagination"></ul>
  </div>

<script>
    // Variables para almacenar los datos y el número de página actual
    let solicitudes = <?php echo json_encode($solicitudes); ?>;
    let datosClientes = <?php echo json_encode($datosClientes); ?>;
    let paginaActual = 1;
    let solicitudesPorPagina = 6;

    // Función para mostrar las solicitudes en la página actual
    function mostrarSolicitudes() {
        let inicio = (paginaActual - 1) * solicitudesPorPagina;
        let fin = inicio + solicitudesPorPagina;
        let html = '';

        for (let i = inicio; i < fin && i < solicitudes.length; i++) {
            html += '<div class="card col-12 ps-0 pe-0 mt-0">' +
                      '<div class="card-header">' + datosClientes[i][0]['nombre'] + '</div>' +
                      '<div class="card-body">' +
                        '<blockquote class="blockquote mb-0">' +
                          '<p>' + solicitudes[i] + '</p>' +
                          '<div class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></div>' +
                        '</blockquote>' +
                        '<div class="w-100 d-flex justify-content-end">' +
                          '<button type="button" class="btn btn-outline-primary me-2 ps-3 pe-3">Aceptar</button>' +
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
        var botonesPagina = document.querySelectorAll('.pagina');
        botonesPagina.forEach(function (boton) {
            var numPagina = parseInt(boton.getAttribute('data-pagina'));
            if (numPagina === paginaActual) {
                boton.classList.add('active');
            } else {
                boton.classList.remove('active');
            }
        });
    }

    // Mostrar las solicitudes y generar los botones de paginación al cargar la página
    mostrarSolicitudes();
    generarBotonesPaginacion();
    actualizarBotonesPaginacion();
  </script>

  <div class="mb-5"></div>
</section>
</main>
</body>