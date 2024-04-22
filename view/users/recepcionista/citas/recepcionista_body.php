<body data-bs-theme="<?php echo $_SESSION['theme'] ?>">

  <!-- Aside -->
  <?php include('../../../view/users/recepcionista/citas/bodyParts/aside.php'); ?>

  <!-- Header -->
  <?php include('../../../view/users/recepcionista/citas/bodyParts/header.php'); ?>

  <!-- Main -->
  <main class="main">
    
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js">// Add jQuery</script>

    <script src="../../../model/js/recepcionista_calendar/script_prev.js">// Script prev</script>

    <nav>
      <div class="wrapper">
        <div class="d-flex wrapper-up">
          <div class="c-monthyear">
            <div class="c-month">
              <span id="prev" class="prev fa fa-angle-left" aria-hidden="true"></span>
              <div id="c-paginator">
                <span class="c-paginator__month">Enero</span>
                <span class="c-paginator__month">Febrero</span>
                <span class="c-paginator__month">Marzo</span>
                <span class="c-paginator__month">Abril</span>
                <span class="c-paginator__month">Mayo</span>
                <span class="c-paginator__month">Junio</span>
                <span class="c-paginator__month">Julio</span>
                <span class="c-paginator__month">Agosto</span>
                <span class="c-paginator__month">Septiembre</span>
                <span class="c-paginator__month">Octubre</span>
                <span class="c-paginator__month">Noviembre</span>
                <span class="c-paginator__month">Diciembre</span>
                <!-- <script>
                  // 🔴 Why this keep puting the last position of the array the first of the month ???!!!!
                  monthText.forEach( month => {
                    document.write("<span class='c-paginator__month'>"+month+"</span>");
                  });
                </script> -->
              </div>
              <span id="next" class="next fa fa-angle-right" aria-hidden="true"></span>
            </div>
            <span class="c-paginator__year"></span>
          </div>
          <div class="c-sort d-flex flex-wrap align-content-center">
            <a class="o-btn c-today__btn" href="javascript:;">Hoy</a>
          </div>
        </div>
        <div class="add_button">
          <button type="button" class="btn btn-outline-primary me-2 ps-1 pe-1" data-bs-toggle="modal" data-bs-target="#newCliente">Añadir Cita</button>
        </div>
      </div>
    </nav>

    <!-- Modal for add a new session -->
    <div class="modal fade" id="newCliente" tabindex="-1" aria-labelledby="modalNewCliente" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalNewCliente">Añadir una nueva cita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="#" method="post" class="row g-3" enctype="multipart/form-data">
                  <!-- fecha -->
                  <div class="col-12">
                    <label for="nombre" class="form_label">Nombre:<span class="text-danger">*</span> </label>
                    <input type="text" name="nombre" id="nombre" required class="form-control">
                  </div>
                  <!-- cliente -->
                  <div class="col-md-6">
                    <label for="tlf" class="form_label">Tlf:<span class="text-danger">*</span> </label>
                    <input type="tlf" name="tlf" id="tlf" required class="form-control">
                  </div>
                  <!-- tipo de cita -->
                  <div class="col-md-6">
                    <label for="tlf2" class="form_label">Tlf2: </label>
                    <input type="tlf" name="tlf2" id="tlf2" required class="form-control">
                  </div>
                  <div class="col-12 d-flex align-items-center justify-content-end">
                    <button type="submit" name="newCliente" class="btn btn-secondary">Crear</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    <div class="wrapper">
      <div class="c-calendar">
        <div class="c-calendar__style c-aside">
          <a class="c-add o-btn js-event__add" href="javascript:;">Crear Evento <span class="fa fa-plus"></span></a>
          <div class="c-aside__day">
            <span class="c-aside__num"></span> <span class="c-aside__month"></span>
          </div>
          <div class="c-aside__eventList">
          </div>
        </div>
        <div class="c-cal__container c-calendar__style">
          