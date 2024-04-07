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
      <div class="wrapper wrapper-up">
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
        <div class="c-sort">
          <a class="o-btn c-today__btn" href="javascript:;">Hoy</a>
        </div>
      </div>
    </nav>
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
          