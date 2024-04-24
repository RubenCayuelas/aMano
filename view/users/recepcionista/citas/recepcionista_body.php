<body data-bs-theme="<?php echo $_SESSION['theme'] ?>">

  <!-- Aside -->
  <?php include('../../../view/users/recepcionista/citas/bodyParts/aside.php'); ?>

  <!-- Header -->
  <?php include('../../../view/users/recepcionista/citas/bodyParts/header.php'); ?>

  <!-- Main -->
  <main class="main">
    
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js">// Add jQuery</script>

    <!-- <script src="../../../model/js/recepcionista_calendar/script_prev.js">// Script prev</script> -->
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
          // 🔴 For some reason some Mondays return the value 8 and the range is 1..7 xd?
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
      
      // Month names array
      let monthText = [];
      for (let i = 0; i < 12; i++) {
        let monthName = new Intl.DateTimeFormat('es-ES', { month: 'long' }).format(new Date(2022, i, 1));
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
              for($i = 0; $i < 12; $i++) {
                  $monthNumber = $i + 1;
                  if($monthNumber < 10) {
                      $monthNumber = '0' . $monthNumber;
                  }
                  echo 'fill_table("' . date('F', mktime(0, 0, 0, $i+1, 1))  . '", ' . days_in_month($i + 1, $año) . ', "' . $monthNumber . '");';
              }
            ?>
          </script>
        </div>
      </div>

      <div class="c-event__creator c-calendar__style js-event__creator">
        <a href="javascript:;" class="o-btn js-event__close">Cerrar <span class="fa fa-close"></span></a>
        <form id="addEvent">
          <input placeholder="Event name" type="text" name="name">
          <input type="date" name="date">
          <textarea placeholder="Notes" name="notes" cols="30" rows="10"></textarea>
          <select name="tags">
            <option value="event">event</option>
            <!-- <option value="important">important</option>
            <option value="birthday">birthday</option>
            <option value="festivity">festivity</option> -->
          </select>
        </form>
        <br>
        <a href="javascript:;" class="o-btn js-event__save">SAVE <span class="fa fa-save"></span></a>
      </div>
    </div>
    <script>
      // Global variables 
      const monthEl = $(".c-main");
      const dataCel = $(".c-cal__cel");
      const todayBtn = $(".c-today__btn");
      const addBtn = $(".js-event__add");
      const saveBtn = $(".js-event__save");
      const closeBtn = $(".js-event__close");
      const winCreator = $(".js-event__creator");
      let dateObj = new Date();
      let month = "<?php echo $month ?>";
      let day = "<?php echo $day ?>";
      let year = <?php echo $año ?>;
      let indexMonth = <?php echo isset($_GET['year']) ? ($_GET['year'] > date('Y') ? 01 : ($_GET['year'] == date('Y') && isset($_GET['next']) ? 01 : 12)) : $month; ?>;
      let inputDate = $(this).data();
      today = <?php echo date('Y') ?> + "-" + month + "-" + day;


      // 🟡 ------ Set events -------
      function createEvents(dataDay, dataName, dataNotes, classTag) {
        let date = $('*[data-day=' + dataDay + ']');
        date.attr("data-name", dataName);
        date.attr("data-notes", dataNotes);
        date.addClass("event");
        date.addClass("event--" + classTag);
      }

      // 🔴 Guardar eventos en el localstorage 
      // 🔴 Make sure you can have multiple events at the same day
      // createEvents(today, 'YEAH!', 'Today is your day', 'important');
      // createEvents(today, 'MERRY CHRISTMAS', 'A lot of gift!!!!', 'festivity');
      // createEvents(today, "LUCA'S BIRTHDAY", 'Another gifts...?', 'birthday');
      // createEvents('2024-03-03', "MY LADY'S BIRTHDAY", 'A lot of money to spent!!!!', 'birthday');


      // 🟡 ------ Controls ------- 

      // Button of the current day
      todayBtn.on("click", function() {
        window.location.href = window.location.href.includes("?year=") ? window.location.href.replace(/\?year=.*/, " ") : window.location.href;
      });

      // Higlight the cel of current day
      dataCel.each(function () {
        if ($(this).data("day") === today) {
          $(this).addClass("isToday");
          fillEventSidebar($(this));
        }
      });

      // Window event creator
      addBtn.on("click", function() {
        winCreator.addClass("isVisible");
        $("body").addClass("overlay");
        dataCel.each(function() {
          if ($(this).hasClass("isSelected")) {
            today = $(this).data("day");
            document.querySelector('input[type="date"]').value = today;
          } else {
            document.querySelector('input[type="date"]').value = today;
          }
        });
      });
      closeBtn.on("click", function() {
        winCreator.removeClass("isVisible");
        $("body").removeClass("overlay");
      });
      saveBtn.on("click", function() {
        let inputName = $("input[name=name]").val();
        let inputDate = $("input[name=date]").val();
        let inputNotes = $("textarea[name=notes]").val();
        let inputTag = $("select[name=tags]")
          .find(":selected")
          .text();

        dataCel.each(function() {
          if ($(this).data("day") === inputDate) {
            if (inputName != null) {
              $(this).attr("data-name", inputName);
            }
            if (inputNotes != null) {
              $(this).attr("data-notes", inputNotes);
            }
            $(this).addClass("event");
            if (inputTag != null) {
              $(this).addClass("event--" + inputTag);
            }
            fillEventSidebar($(this));
          }
        });

        winCreator.removeClass("isVisible");
        $("body").removeClass("overlay");
        $("#addEvent")[0].reset();
      });

      // 🟡 Fill sidebar event info
      // 🔴 Change the names of the events
      function fillEventSidebar(self) {
        $(".c-aside__event").remove();
        let thisName = self.attr("data-name");
        let thisNotes = self.attr("data-notes");
        let thisImportant = self.hasClass("event--important");
        let thisBirthday = self.hasClass("event--birthday");
        let thisFestivity = self.hasClass("event--festivity");
        let thisEvent = self.hasClass("event");

        switch (true) {
          case thisImportant:
            $(".c-aside__eventList").append(
              "<p class='c-aside__event c-aside__event--important'>" +
              thisName +
              " <span> • " +
              thisNotes +
              "</span></p>"
            );
            break;
          case thisBirthday:
            $(".c-aside__eventList").append(
              "<p class='c-aside__event c-aside__event--birthday'>" +
              thisName +
              " <span> • " +
              thisNotes +
              "</span></p>"
            );
            break;
          case thisFestivity:
            $(".c-aside__eventList").append(
              "<p class='c-aside__event c-aside__event--festivity'>" +
              thisName +
              " <span> • " +
              thisNotes +
              "</span></p>"
            );
            break;
          case thisEvent:
            $(".c-aside__eventList").append(
              "<p class='c-aside__event'>" +
              thisName +
              " <span> • " +
              thisNotes +
              "</span></p>"
            );
            break;
        }
      };
      dataCel.on("click", function() {
        let thisEl = $(this);
        let thisDay = $(this)
          .attr("data-day")
          .slice(8);
        let thisMonth = $(this)
          .attr("data-day")
          .slice(5, 7);

        fillEventSidebar($(this));

        $(".c-aside__num").text(thisDay);
        $(".c-aside__month").text(monthText[thisMonth - 1]);

        dataCel.removeClass("isSelected");
        thisEl.addClass("isSelected");

      });

      // 🔴 Function for move the months
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
                // window.location.href.includes("?year=") ? window.location.href = window.location.href.replace(/\?year=.*/, "?year="+(year-1)) : window.location.href+="?year="+(year-1);
                if (window.location.href.includes("?year=")) {
                  window.location.href = window.location.href.replace(/\?year=.*/, "?year=" + (year - 1) + "&prev")
                } else {
                  window.location.href += "?year=" + (year - 1);
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
                // window.location.href.includes("?year=") ? window.location.href = window.location.href.replace(/\?year=.*/, "?year="+(year+1)+"&next") : window.location.href+="?year="+(year+1);
                if (window.location.href.includes("?year=")) {
                  window.location.href = window.location.href.replace(/\?year=.*/, "?year=" + (year + 1) + "&next");
                } else {
                  window.location.href += "?year=" + (year + 1);
                }
              }
              return indexMonth;
            });
            break;
        }
      }

      buttonsPaginator("#next", monthEl, ".c-paginator__month", false, true);
      buttonsPaginator("#prev", monthEl, ".c-paginator__month", true, false);

      // Launch function to set the current month
      moveNext(indexMonth - 1, false);

      // Fill the sidebar with current day
      $(".c-aside__num").text(day);
      $(".c-aside__month").text(monthText[month - 1]);
    </script>

