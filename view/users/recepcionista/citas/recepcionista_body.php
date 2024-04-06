<body data-bs-theme="<?php echo $_SESSION['theme'] ?>">

  <!-- Aside -->
  <?php include('../../../view/users/recepcionista/citas/bodyParts/aside.php'); ?>

  <!-- Header -->
  <?php include('../../../view/users/recepcionista/citas/bodyParts/header.php'); ?>

  <!-- Main -->
  <main class="main">

    <style>
      @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 300;
        src: url(https://fonts.gstatic.com/s/lato/v24/S6u_w4BMUTPHjxsI9w2_Gwfo.ttf) format('truetype');
      }

      @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 900;
        src: url(https://fonts.gstatic.com/s/lato/v24/S6u_w4BMUTPHjxsI3wi_Gwfo.ttf) format('truetype');
      }

      @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 300;
        src: url(https://fonts.gstatic.com/s/lato/v24/S6u9w4BMUTPHh7USSwiPHA.ttf) format('truetype');
      }

      @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 900;
        src: url(https://fonts.gstatic.com/s/lato/v24/S6u9w4BMUTPHh50XSwiPHA.ttf) format('truetype');
      }

      .txt__normal {
        font-family: "Lato", sans-serif;
        font-weight: 400;
      }

      .txt__normal--it {
        font-family: "Lato", sans-serif;
        font-weight: 400;
        font-style: italic;
      }

      .txt__bold {
        font-family: "Lato", sans-serif;
        font-weight: 900;
      }

      .txt__bold--it {
        font-family: "Lato", sans-serif;
        font-weight: 900;
        font-style: italic;
      }

      .txt__awesome {
        font: normal normal normal 14px/1 FontAwesome;
      }

      /* VARIABLES ================================================*/
      /* RESPONSIVE ================================================*/
      /* ===========================================================*/
      main {
        position: realative;
        height: 100%;
      }

      main.overlay:before {
        position: fixed;
        content: "";
        display: block;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 100;
      }

      main {
        height: 100%;
        background: #003567;
        color: #ffffff;
        font-size: 13px;
        font-family: "Lato", sans-serif;
        font-weight: 400;
      }

      .wrapper {
        position: relative;
        max-width: 1280px;
        width: 100%;
        height: 100%;
        margin: 0 auto;
      }
      .wrapper-up {
        justify-content: left!important;
      }
      .c-sort {
        @media screen and (min-width: 375px) {
          margin-left: 5%;
        }
      }

      a {
        color: inherit;
        text-decoration: none;
      }

      /* UTILITY ===========================================================*/
      .u-border-box {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
      }

      .u-transition {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .u-transition.long {
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .u-transition.elastic {
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        -webkit-transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }

      .resetDefaultApparence {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0px;
        padding: 0;
        border-width: 0;
        resize: none;
      }

      .resetDefaultApparence::-ms-expand {
        display: none;
      }

      /* STYLE ===========================================================*/
      main nav {
        position: fixed;
        height: 80px;
        width: 100%;
        z-index: 50;
        background: #003567;
      }

      main nav>.wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 1%;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        color: #ffffff;
        letter-spacing: 2px;
        font-size: 13px;
        @media screen and (min-width: 768px) {
          padding: 0 20px;
        }
      }

      main nav>.wrapper a {
        color: #ffffff;
        text-decoration: none;
        margin-left: 10px;
      }

      .c-monthyear {
        display: flex;
      }

      .c-month {
        position: relative;
        height: 80px;
        line-height: 80px;
      }

      .c-month #c-paginator {
        position: relative;
        width: 200px;
        display: block;
        height: 80px;
        line-height: 80px;
        text-align: center;
        overflow: hidden;
      }

      .c-month #c-paginator .c-paginator__month {
        position: absolute;
        width: 200px;
        top: 0;
        bottom: 0;
        right: 0;
        text-transform: uppercase;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(1) {
        left: 0;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(2) {
        left: 200px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(3) {
        left: 400px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(4) {
        left: 600px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(5) {
        left: 800px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(6) {
        left: 1000px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(7) {
        left: 1200px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(8) {
        left: 1400px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(9) {
        left: 1600px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(10) {
        left: 1800px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(11) {
        left: 2000px;
      }

      .c-month #c-paginator .c-paginator__month:nth-child(12) {
        left: 2200px;
      }

      .c-month .prev,
      .c-month .next {
        position: absolute;
        display: block;
        top: 50%;
        width: 30px;
        height: 30px;
        padding: 9px 12px;
        background-color: #004b8f;
        cursor: pointer;
        z-index: 10;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        transform: translatey(-50%);
        -webkit-transform: translatey(-50%);
        border-radius: 50%;
        -webkit-border-radius: 50%;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .c-month .prev.long,
      .c-month .next.long {
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .c-month .prev.elastic,
      .c-month .next.elastic {
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        -webkit-transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }

      .c-month .prev {
        left: 0;
      }

      .c-month .prev:hover {
        padding: 9px 10px;
        background-color: #0055a4;
      }

      .c-month .next {
        right: 0;
      }

      .c-month .next:hover {
        padding: 9px 14px;
        background-color: #0055a4;
      }

      .c-paginator__year {
        height: 80px;
        line-height: 80px;
        padding: 0 10px;
        @media screen and (min-width: 375px) {
          padding: 0 20px;
        }
      }

      .o-btn {
        display: inline-block;
        padding: 0 10px;
        line-height: 30px;
        height: 30px;
        background-color: #004b8f;
        text-transform: uppercase;
        letter-spacing: 2px;
        border-radius: 15px;
        -webkit-border-radius: 15px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .o-btn.long {
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .o-btn.elastic {
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        -webkit-transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }

      .o-btn span {
        margin-left: 10px;
      }

      .o-btn:hover {
        background-color: #0055a4;
      }

      .c-calendar {
        padding-top: 80px;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        @media screen and (min-width: 768px) {
          flex-direction: row;
        }
      }

      .c-calendar__style {
        background-color: #00407b;
        margin: 20px;
        padding: 10px;
        box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.18);
        -webkit-box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.18);
        border-radius: 6px;
        -webkit-border-radius: 6px;
      }

      .c-cal__container {
        position: relative;
        height: 0;
        padding-bottom: 75%;
        overflow: hidden;
        @media screen and (min-width: 768px) {
          padding-bottom: 75%;
          width: calc(100% - 300px);
        }
      }

      .c-main {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
      }

      .c-main-01 {
        left: 0;
      }

      .c-main-02 {
        left: 100%;
      }

      .c-main-03 {
        left: 200%;
      }

      .c-main-04 {
        left: 300%;
      }

      .c-main-05 {
        left: 400%;
      }

      .c-main-06 {
        left: 500%;
      }

      .c-main-07 {
        left: 600%;
      }

      .c-main-08 {
        left: 700%;
      }

      .c-main-09 {
        left: 800%;
      }

      .c-main-10 {
        left: 900%;
      }

      .c-main-11 {
        left: 1000%;
      }

      .c-main-12 {
        left: 1100%;
      }

      .c-cal__row {
        display: flex;
        justify-content: flex-start;
      }

      .c-cal__col {
        width: calc(100% / 7);
        text-align: center;
        height: 50px;
        line-height: 50px;
        letter-spacing: 2px;
        text-transform: uppercase;
      }

      .c-cal__cel {
        position: relative;
        width: calc(100% / 7);
        text-align: center;
        cursor: pointer;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .c-cal__cel p {
        position: absolute;
        margin: 0;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 40px;
        line-height: 40px;
        background: #004585;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        border-radius: 50%;
        -webkit-border-radius: 50%;
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .c-cal__cel::before {
        content: "";
        display: block;
        padding-top: 100%;
      }

      .c-cal__cel:nth-child(7) p {
        background: rgba(215, 16, 15, 0.2);
      }

      .c-cal__cel:nth-child(6) p {
        background: #003b71;
      }

      .c-cal__cel:hover {
        background-color: #004b8f !important;
      }

      .c-cal__cel:hover p {
        background: #003b71 !important;
      }

      .c-cal__cel.isSelected {
        background-color: #004b8f;
      }

      .c-cal__cel.isSelected p {
        background: #003b71;
      }

      .c-cal__cel.isToday {
        background-color: rgba(245, 113, 112, 0.2);
      }

      .c-cal__cel.isToday p {
        background: rgba(245, 113, 112, 0.4);
      }

      .c-cal__cel.other_month {
        color: rgba(255, 255, 255, 0.2);
      }

      .event:before {
        position: absolute;
        content: "";
        display: block;
        width: 10px;
        height: 10px;
        background-color: #f5f5f5;
        z-index: 10;
        padding: 0;
        top: 50%;
        left: 50%;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        transform: translate(-50%, calc(50% + 20px/2));
        -webkit-transform: translate(-50%, calc(50% + 20px/2));
      }

      .event--birthday:before {
        background-color: #facc2e;
      }

      .event--festivity:before {
        background-color: #10ddc2;
      }

      .event--important:before {
        background-color: #f57170;
      }

      .c-aside {
        padding: 20px;
        @media screen and (min-width: 768px) {
          width: 300px;
        }
      }

      .c-aside__day {
        font-size: 28px;
        margin: 50px 0;
      }

      .c-aside__day .c-aside__num {
        font-family: "Lato", sans-serif;
        font-weight: 900;
      }

      .c-aside__event {
        position: relative;
        padding-left: 20px;
        margin: 20px 0;
      }

      .c-aside__event:before {
        position: absolute;
        display: block;
        content: "";
        width: 16px;
        height: 16px;
        left: 0;
        background-color: #f5f5f5;
        border-radius: 50%;
        -webkit-border-radius: 50%;
      }

      .c-aside__event--birthday:before {
        background-color: #facc2e;
      }

      .c-aside__event--festivity:before {
        background-color: #10ddc2;
      }

      .c-aside__event--important:before {
        background-color: #f57170;
      }

      .c-event__creator {
        position: fixed;
        top: 50%;
        left: 50%;
        max-width: 500px;
        max-height: 470px;
        width: 100%;
        height: 100%;
        z-index: 100;
        padding: 20px;
        visibility: hidden;
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        transform: translate(-50%, -50%) scale(0.9);
        -webkit-transform: translate(-50%, -50%) scale(0.9);
      }

      .c-event__creator.long {
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
      }

      .c-event__creator.elastic {
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        -webkit-transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }

      .c-event__creator form {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: space-between;
      }

      .c-event__creator.isVisible {
        transform: translate(-50%, -50%) scale(1);
        -webkit-transform: translate(-50%, -50%) scale(1);
        opacity: 1;
        visibility: visible;
      }

      input,
      textarea,
      select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0px;
        padding: 0;
        border-width: 0;
        resize: none;
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        border-radius: 20px;
        -webkit-border-radius: 20px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
      }

      input::-ms-expand,
      textarea::-ms-expand,
      select::-ms-expand {
        display: none;
      }

      input {
        height: 40px;
      }
    </style>


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
        for (var i = 1; i < start_day; i++) {
          // 🔴 For some reason some Mondays return the value 8 and the range is 1..7 xd?
          if (i <= start_day && start_day != 8) {
            document.write("<div class='c-cal__cel'></div>");
          }
        }

        // Fill the first week of days
        for (var i = start_day; i <= 7; i++) {
          document.write(
            "<div data-day='" + year + "-" + indexMonth + "-0" + day + "'class='c-cal__cel'><p>" + day + "</p></div>"
          );
          day++;
        }
        document.write("</div>");

        // 🟡 Fill the remaining weeks
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
          document.write("</div>");
          // The first day of the next month
          start_day = i;
        }

        document.write("</div>");
      }

      let monthText = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
      ];
    </script>
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
          <script>
            // Current year
            year = <?php echo $año ?>;
            $('.c-paginator__year').text(year);

            // First day of the week of the new year
            var today = new Date("Enero 1, " + year);

            // First day of the week for the first month of the year
            var start_day = <?php echo $firstWeekDay; ?>;

            fill_table("Enero", <?php echo days_in_month(1, $año) ?>, "01");
            fill_table("Febrero", <?php echo days_in_month(2, $año) ?>, "02");
            fill_table("Marzo", <?php echo days_in_month(3, $año) ?>, "03");
            fill_table("Abril", <?php echo days_in_month(4, $año) ?>, "04");
            fill_table("Mayo", <?php echo days_in_month(5, $año) ?>, "05");
            fill_table("Junio", <?php echo days_in_month(6, $año) ?>, "06");
            fill_table("Julio", <?php echo days_in_month(7, $año) ?>, "07");
            fill_table("Agosto", <?php echo days_in_month(8, $año) ?>, "08");
            fill_table("Septiembre", <?php echo days_in_month(9, $año) ?>, "09");
            fill_table("Octubre", <?php echo days_in_month(10, $año) ?>, "10");
            fill_table("Noviembre", <?php echo days_in_month(11, $año) ?>, "11");
            fill_table("Diciembre", <?php echo days_in_month(12, $año) ?>, "12");
          </script>
        </div>
      </div>

      <div class="c-event__creator c-calendar__style js-event__creator">
        <a href="javascript:;" class="o-btn js-event__close">CLOSE <span class="fa fa-close"></span></a>
        <form id="addEvent">
          <input placeholder="Event name" type="text" name="name">
          <input type="date" name="date">
          <textarea placeholder="Notes" name="notes" cols="30" rows="10"></textarea>
          <select name="tags">
            <option value="event">event</option>
            <option value="important">important</option>
            <option value="birthday">birthday</option>
            <option value="festivity">festivity</option>
          </select>
        </form>
        <br>
        <a href="javascript:;" class="o-btn js-event__save">SAVE <span class="fa fa-save"></span></a>
      </div>
    </div>

    <script>
      // 🟡 Global variables 
      var monthEl = $(".c-main");
      var dataCel = $(".c-cal__cel");
      var dateObj = new Date();
      var month = "<?php echo $month ?>";
      var day = "<?php echo $day ?>";
      var year = <?php echo $año ?>;
      var indexMonth =  <?php echo isset($_GET['year']) ? ($_GET['year'] > date('Y') ? 01 : ($_GET['year'] == date('Y') && isset($_GET['next']) ? 01 : 12)) : $month ; ?>;
      var todayBtn = $(".c-today__btn");
      var addBtn = $(".js-event__add");
      var saveBtn = $(".js-event__save");
      var closeBtn = $(".js-event__close");
      var winCreator = $(".js-event__creator");
      var inputDate = $(this).data();
      var today = <?php echo date('Y') ?>+"-"+month+"-"+day;


      // 🟡 ------ Set default events ------- 
      function defaultEvents(dataDay, dataName, dataNotes, classTag) {
        let date = $('*[data-day=' + dataDay + ']');
        date.attr("data-name", dataName);
        date.attr("data-notes", dataNotes);
        date.addClass("event");
        date.addClass("event--" + classTag);
      }

      // 🔴 Guardar eventos en el localstorage 
      // 🔴 Make sure you can have multiple events at the same day
      // defaultEvents(today, 'YEAH!', 'Today is your day', 'important');
      // defaultEvents(today, 'MERRY CHRISTMAS', 'A lot of gift!!!!', 'festivity');
      // defaultEvents(today, "LUCA'S BIRTHDAY", 'Another gifts...?', 'birthday');
      // defaultEvents('2024-03-03', "MY LADY'S BIRTHDAY", 'A lot of money to spent!!!!', 'birthday');


      // 🟡 ------ Controls ------- 

      //button of the current day
      todayBtn.on("click", function() {
        // if (month < indexMonth) {
        //   var step = indexMonth % month;
        //   movePrev(step, true);
        // } else if (month > indexMonth) {
        //   var step = month - indexMonth;
        //   moveNext(step, true);
        // }
        window.location.href = window.location.href.includes("?year=") ? window.location.href.replace(/\?year=.*/, " ") : window.location.href ;
      });

      // Higlight the cel of current day
      dataCel.each(function() {
        if ($(this).data("day") === today) {
          $(this).addClass("isToday");
          fillEventSidebar($(this));
        }
      });

      //window event creator
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
        var inputName = $("input[name=name]").val();
        var inputDate = $("input[name=date]").val();
        var inputNotes = $("textarea[name=notes]").val();
        var inputTag = $("select[name=tags]")
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
        var thisName = self.attr("data-name");
        var thisNotes = self.attr("data-notes");
        var thisImportant = self.hasClass("event--important");
        var thisBirthday = self.hasClass("event--birthday");
        var thisFestivity = self.hasClass("event--festivity");
        var thisEvent = self.hasClass("event");

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
        var thisEl = $(this);
        var thisDay = $(this)
          .attr("data-day")
          .slice(8);
        var thisMonth = $(this)
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
        for (var i = 0; i < fakeClick; i++) {
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
        for (var i = 0; i < fakeClick; i++) {
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

      //months paginator
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
                  window.location.href = window.location.href.replace(/\?year=.*/, "?year="+(year-1)+"&prev")
                } else {
                  window.location.href+="?year="+(year-1);
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
                  window.location.href = window.location.href.replace(/\?year=.*/, "?year="+(year+1)+"&next");
                } else {
                  window.location.href+="?year="+(year+1);
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

      //fill the sidebar with current day
      $(".c-aside__num").text(day);
      $(".c-aside__month").text(monthText[month - 1]);
    </script>


  </main>
</body>