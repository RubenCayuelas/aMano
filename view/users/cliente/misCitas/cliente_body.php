<body data-bs-theme="<?php echo $_SESSION['theme'] ?>">

  <!-- Aside -->
  <?php include('../../../view/users/cliente/misCitas/bodyParts/aside.php'); ?>

  <!-- Header -->
  <?php include('../../../view/users/cliente/misCitas/bodyParts/header.php'); ?>

  <!-- Main -->
  <main class="main">

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js">// Add jQuery</script>
    <script>
      // Fill the table with column headings
      function day_title(day_name) {
        document.write("<div class='c-cal__col'>" + day_name + "</div>");
      }
      // Fills the month table with the numbers of the days
      function fill_table(month, month_length, indexMonth) {
        day = 1;
        // Begin the new month table
        document.write("<div class='c-main c-main-" + indexMonth + "'>");

        // Column headings
        document.write("<div class='c-cal__row'>");
        day_title("Lun");
        day_title("Mar");
        day_title("Mie");
        day_title("Jue");
        day_title("Vie");
        day_title("Sab");
        day_title("Dom");
        document.write("</div>");

        // Pad cells before first day of month
        document.write("<div class='c-cal__row'>");
        for (let i = 1; i < start_day; i++) {
          // For some reason some Mondays return the value 8 and the range is 1..7 xd?
          if (i <= start_day && start_day != 8) {
            document.write("<div class='c-cal__cel'></div>");
          }
        }

        // Fill the first week of days
        for (let i = start_day; i <= 7; i++) {
          document.write(
            "<div data-day='" + year + "-" + indexMonth + "-0" + day + "'class='c-cal__cel'><p>" + day + "</p></div>"
          );
          day++;
        }
        document.write("</div>");

        // Fill the remaining weeks
        while (day <= month_length) {
          document.write("<div class='c-cal__row'>");
          for (var i = 1; i <= 7 && day <= month_length; i++) {
            if (day >= 1 && day <= 9) {
              document.write("<div data-day='" + year + "-" + indexMonth + "-0" + day + "'class='c-cal__cel'><p>" + day + "</p></div>");
            } else {
              document.write("<div data-day='" + year + "-" + indexMonth + "-" + day + "'class='c-cal__cel'><p>" + day + "</p></div>");
            }
            day++;
          }
          // The first day of the next month
          start_day = i;
          document.write("</div>");
        }

        document.write("</div>");
      }

      // Month names array creation
      let monthText = [];
      for (let i = 0; i < 12; i++) {
        let monthName = new Intl.DateTimeFormat('es-ES', {
          month: 'long'
        }).format(new Date(2022, i, 1));
        monthText.push(monthName.charAt(0).toUpperCase() + monthName.slice(1));
      }
    </script>

    <nav>
      <div class="wrapper">
        <div class="d-flex wrapper-up">
          <div class="c-monthyear">
            <div class="c-month">
              <span id="prev" class="prev fa fa-angle-left" aria-hidden="true"></span>
              <div id="c-paginator">
                <?php
                for ($i = 0; $i < 12; $i++) {
                  echo '<span class="c-paginator__month">' . strftime('%B', mktime(0, 0, 0, $i + 1, 1)) . '</span>' . "\n";
                }
                ?>
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
          <?php if (!isset($_POST['addCita'])) { ?>
            <button type="button" id="openAddCita" class="btn btn-outline-primary me-2 ps-1 pe-1" data-bs-toggle="modal" data-bs-target="#addCita">Añadir Cita</button>
          <?php } else { ?>
            <button type="button" id="openAddCita" class="btn btn-outline-primary me-2 ps-1 pe-1" data-bs-toggle="modal" data-bs-target="#addCita2">Añadir Cita</button>
          <?php } ?>
        </div>
      </div>
    </nav>
    
    <?php if (!isset($_POST['addCita'])) { ?>
      <!-- Añadir cita -->
      <div class="modal fade" id="addCita" tabindex="-1" aria-labelledby="modalAddCitaCliente" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalAddCitaCliente">Añadir Cita</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
              <form action="#" method="post" class="row mt-3">
                <!-- Date -->
                <div class="col-7">
                  <label for="date" class="form_label">Fecha:<span class="text-danger">*</span> </label>
                  <input type="date" name="date" id="date" required class="form-control">
                </div>
                <!-- Time -->
                <div class="col-5">
                  <label for="time" class="form_label">Hora:<span class="text-danger">*</span> </label>
                  <input type="time" name="time" id="time" required class="form-control" min="08:00" max="18:00">
                </div>
                <!-- Estudio -->
                <div class="col-12">
                  <label for="estudio" class="form_label">Estudio:<span class="text-danger">*</span> </label>
                  <select name="estudio" id="estudio" required class="form-select">';
                    <?php
                      foreach ($listaEstudios as $estudio) {
                        echo '<option value="'. $estudio['id'] .'">'. $estudio['direccion'] .'</option>';
                      }
                    ?>
                  </select>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-end">
                  <button type="submit" name="addCita" value="" class="btn btn-secondary">Siguiente <i class="bi bi-arrow-bar-right"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <!-- Añadir cita segundo paso -->
      <div class="modal fade" id="addCita2" tabindex="-1" aria-labelledby="modalAddCitaCliente" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalAddCitaCliente">Añadir Cita</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
              <form action="#" method="post" class="row mt-3">
                <!-- Date -->
                <input type="hidden" name="date" value="<?php echo $_POST['date']; ?>">
                <!-- Time -->
                <input type="hidden" name="time" value="<?php echo $_POST['time']; ?>">
                <!-- Estudio -->
                <input type="hidden" name="estudio" value="<?php echo $_POST['estudio']; ?>">
                <!-- Servicio -->
                <div class="col-6">
                  <label for="servicio" class="form_label">Servicio:<span class="text-danger">*</span> </label>
                  <select type="text" name="servicio" id="servicio" required class="form-select">';
                    <?php
                      foreach ($listaServicios as $servicio) {
                        echo '<option value="'. $servicio['id'] .'">'. $servicio['nombre'] .'</option>';
                      }
                    ?>
                  </select>
                </div>
                <!-- Fotografo -->
                <div class="col-12">
                  <label for="fotografo" class="form_label">Fotografo:<span class="text-danger">*</span> </label>
                  <select type="text" name="fotografo" id="fotografo" required class="form-select">';
                    <?php
                      foreach ($listaFotografos as $fotografo) {
                        echo '<option value="'. $fotografo['id'] .'">'. $fotografo['nombre'] .'</option>';
                      }
                    ?>
                  </select>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-end">
                  <button type="submit" name="addCita2" value="" class="btn btn-secondary">Enviar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          document.getElementById('openAddCita').click();
        });
      </script>
    <?php } ?>

    <div class="wrapper">
      <div class="c-calendar">
        <div class="c-calendar__style c-aside">
          <!-- <a class="c-add o-btn js-event__add" href="javascript:;">Crear Evento <span class="fa fa-plus"></span></a> -->
          <a type="button" class="c-add o-btn" data-bs-toggle="modal" data-bs-target="#addCita">Crear Cita <span class="fa fa-plus"></span></a>
          <div class="c-aside__day">
            <span class="c-aside__num"></span> <span class="c-aside__month"></span>
          </div>
          <div class="c-aside__eventList"></div>
        </div>
        <div class="c-cal__container c-calendar__style">
          <script>
            // Create the calendars view for the months

            // Current year
            year = <?php echo $año ?>;
            $('.c-paginator__year').text(year);

            // First day of the week of the new year
            let today = new Date("Enero 1, " + year);

            // First day of the week for the first month of the year
            let start_day = <?php echo $firstWeekDay; ?>;

            <?php
            // Generate the JS script
            for ($i = 0; $i < 12; $i++) {
              $monthNumber = $i + 1;
              if ($monthNumber < 10) {
                $monthNumber = '0' . $monthNumber;
              }
              echo 'fill_table("' . date('F', mktime(0, 0, 0, $i + 1, 1))  . '", ' . days_in_month($i + 1, $año) . ', "' . $monthNumber . '");';
            }
            ?>
          </script>
        </div>
      </div>
    </div>
    <script>
      // Global variables 
      const monthEl = $(".c-main");
      const dataCel = $(".c-cal__cel");
      const todayBtn = $(".c-today__btn");
      let dateObj = new Date();
      let month = "<?php echo $month ?>";
      let day = "<?php echo $day ?>";
      let year = <?php echo $año ?>;
      let indexMonth = <?php echo isset($_GET['year']) ?
                          ($_GET['year'] < date('Y') ?
                            (isset($_GET['prev']) ? 12 : 01) : (isset($_GET['next']) ? 01 : 12)
                          ) : $month; ?>;
      let inputDate = $(this).data();
      today = <?php echo date('Y') ?> + "-" + month + "-" + day;


      // ------ Set events/session cites -------
      function createEvents(events) {
        events.forEach(function(event) {
          let date = $('*[data-day=' + event.dataDay + ']');

          // Verificar si ya hay eventos asignados a este día
          let currentEvents = date.attr("data-events");
          let currentDescriptions = JSON.parse(date.attr("data-descriptions") || '[]'); // Obtener el array o inicializarlo como un array vacío
          let currentHours = date.attr("data-hours");

          if (currentEvents) {
            // Si ya hay eventos, agregar el nuevo evento a la lista
            currentEvents += ', ' + event.dataName;
            currentHours += ', ' + event.hour;
          } else {
            // Si no hay eventos, establecer el nuevo evento como el único evento
            currentEvents = event.dataName;
            currentHours = event.hour;
          }
          // Agregar la descripción del evento al array
          currentDescriptions.push(event.description);

          // Asignar los atributos y clases correspondientes
          date.attr("data-events", currentEvents);
          date.attr("data-descriptions", JSON.stringify(currentDescriptions)); // Convertir el array a JSON antes de almacenarlo en el atributo
          date.attr("data-hours", currentHours);
          date.addClass("event");
        });
      }

      // Array of events
      let events = [
        <?php
        foreach ($listaCitas as $cita) {
          echo "{ 
              dataDay: '" . $cita['fecha'] . "',
              dataName: '" . $cita['servicio'] . "',
              hour: '" . date("H:i", strtotime($cita['hora'])) . "',
              description: { 
                \"id\": " . $cita['id'] . " ,
                \"cliente\": \"$cita[cliente]\" ,
                \"cliente_picture\": \"$cita[cliente_picture]\" ,
                \"fotografo\": \"$cita[fotografo]\"
              }
            },";
        }
        ?>
      ];
      // Call the function createEvents whith the array of events
      createEvents(events);


      // ------ Caendar Controls ------- 

      // Button of the current day
      todayBtn.on("click", function() {
        window.location.href = window.location.href.includes("?year=") ? window.location.href.replace(/\?year=.*/, " ") : window.location.href;
      });

      // Higlight the cel of current day and load the events data of the current day
      dataCel.each(function() {
        if ($(this).data("day") === today) {
          $(this).addClass("isToday");
          fillEventSidebar($(this));
        }
      });

      // Select the cel of the day that the user clicks and load the events data of the selected day
      dataCel.on("click", function() {
        let thisDay = $(this).attr("data-day").slice(8);
        let thisMonth = $(this).attr("data-day").slice(5, 7);

        fillEventSidebar($(this));

        $(".c-aside__num").text(thisDay);
        $(".c-aside__month").text(monthText[thisMonth - 1]);

        dataCel.removeClass("isSelected");
        $(this).addClass("isSelected");
      });

      // Fill sidebar with the event info
      function fillEventSidebar(self) {
        $(".c-aside__event").remove();
        $(".c-aside__eventList > ").remove();

        // Obtain the events associated with the selected day
        let eventNames = self.attr("data-events");
        let eventDescriptions = self.attr("data-descriptions");
        let eventHours = self.attr("data-hours");
        let eventDay = self.attr("data-day");
        if (eventNames) {

          // Divide the names of the events in an array
          let eventsNames = eventNames.split(', ');
          let eventsDescriptions = JSON.parse(eventDescriptions);
          let eventsHours = eventHours.split(', ');

          // Draw the event info in the sidebar and create a modal with the event data
          for (let i = 0; i < eventsNames.length; i++) {
            // Ver datos de la cita
            let text = "<p class='c-aside__event' data-bs-toggle='modal' data-bs-target='#seeCita"+eventsDescriptions[i].id+"'>" + eventsNames[i] +"<span> • "+ eventsHours[i] +"h</span></p>" +
                  "<div class='modal fade' id='seeCita"+eventsDescriptions[i].id+"' tabindex='-1' aria-labelledby='seeCita"+eventsDescriptions[i].id+"' style='display: none;' aria-hidden='true'>" +
                    "<div class='modal-dialog modal-dialog-centered modal-dialog-scrollable'>" +
                      "<div class='modal-content'>" +
                        "<div class='modal-header'>" +
                          "<h1 class='modal-title fs-5' id='modalSeeCita"+eventsDescriptions[i].id+"'>"+ eventsNames[i] +" - "+ eventsHours[i] +"h</h1>" +
                          "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>" +
                        "</div>" +
                        "<div class='modal-body row g-3'>" +
                          '<blockquote class="blockquote mb-0">' +
                            '<div>' +
                              '<p>Cliente: </p>' +
                            '</div>' +
                            '<div class="d-flex ms-3 mb-2">' +
                              '<img class="img-fluid rounded-circle w-2_5rem h-2_5rem me-3" src="../../../assets/img/usersPictures/'+ eventsDescriptions[i].cliente_picture +'" alt="UserPicture '+ eventsDescriptions[i].cliente +'">' + 
                              '<p class="mb-0 d-flex align-items-center">'+ eventsDescriptions[i].cliente + '</p>' +
                            '</div>' +
                            '<div>' +
                              '<p class="mb-1">Fotógrafo: </p>' +
                            '</div>' +
                            '<div class="d-flex ms-3 mb-2">' +
                              '<p>'+ eventsDescriptions[i].fotografo + '</p>' +
                            '</div>' +
                            '<div class="blockquote-footer text-secondary-emphasis .d-flex .justify-content-end ms-3 me-5 pe-5">' +
                              '<cite title="hour">'+ eventsHours[i] +'h - '+ eventsNames[i] +'</cite>' +
                            '</div>' +
                          '</blockquote>';
                          if (eventDay > today) {
                    text += '<div class="w-100 d-flex justify-content-end">' +
                              '<form id="rejectForm" action="#" method="post">' +
                                '<input type="hidden" name="id" value="'+ eventsDescriptions[i].id +'">' +
                                '<button type="submit" name="sessionSolicitudeReject" class="btn btn-outline-danger me-2 ps-3 pe-3 pt-1 pb-1">Rechazar</button>' +
                              '</form>' +
                            '</div>';
                          }
                text += "</div>" +
                      "</div>" +
                    "</div>" +
                  "</div>";
            $(".c-aside__eventList").append(text);
          }
        }
      };

      // Functions for move the months Next and Previous
      function moveNext(fakeClick, indexNext) {
        for (let i = 0; i < fakeClick; i++) {
          $(".c-main").css({
            left: "-=100%"
          });
          $(".c-paginator__month").css({
            left: "-=100%"
          });
          switch (true) {
            case indexNext:
              indexMonth += 1;
              break;
          }
        }
      }
      function movePrev(fakeClick, indexPrev) {
        for (let i = 0; i < fakeClick; i++) {
          $(".c-main").css({
            left: "+=100%"
          });
          $(".c-paginator__month").css({
            left: "+=100%"
          });
          switch (true) {
            case indexPrev:
              indexMonth -= 1;
              break;
          }
        }
      }

      // Months paginator
      function buttonsPaginator(buttonId, mainClass, monthClass, next, prev) {
        switch (true) {
          case next:
            $(buttonId).on("click", function() {
              if (indexMonth >= 2) {
                $(mainClass).css({
                  left: "+=100%"
                });
                $(monthClass).css({
                  left: "+=100%"
                });
                indexMonth -= 1;
              } else {
                // Redirect to the past year
                if (window.location.href.includes("?year=")) {
                  window.location.href = window.location.href.replace(/\?year=.*/, "?year=" + (year - 1) + "&prev")
                } else {
                  window.location.href += "?year=" + (year - 1) + "&prev";
                }
              }
              return indexMonth;
            });
            break;
          case prev:
            $(buttonId).on("click", function() {
              if (indexMonth <= 11) {
                $(mainClass).css({
                  left: "-=100%"
                });
                $(monthClass).css({
                  left: "-=100%"
                });
                indexMonth += 1;
              } else {
                // Redirect to the next year
                if (window.location.href.includes("?year=")) {
                  window.location.href = window.location.href.replace(/\?year=.*/, "?year=" + (year + 1) + "&next");
                } else {
                  window.location.href += "?year=" + (year + 1) + "&next";
                }
              }
              return indexMonth;
            });
            break;
        }
      }

      // Create the paginator buttons
      buttonsPaginator("#next", monthEl, ".c-paginator__month", false, true);
      buttonsPaginator("#prev", monthEl, ".c-paginator__month", true, false);

      // Launch function to set the current month
      moveNext(indexMonth - 1, false);

      // Fill the sidebar with current day for the first time
      $(".c-aside__num").text(day);
      $(".c-aside__month").text(monthText[month - 1]);
    </script>