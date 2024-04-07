
<script>
  // 🟡 Global variables 
  var monthEl = $(".c-main");
  var dataCel = $(".c-cal__cel");
  var dateObj = new Date();
  var month = "<?php echo $month ?>";
  var day = "<?php echo $day ?>";
  var year = <?php echo $año ?>;
  var indexMonth = <?php echo isset($_GET['year']) ? ($_GET['year'] > date('Y') ? 01 : ($_GET['year'] == date('Y') && isset($_GET['next']) ? 01 : 12)) : $month; ?>;
  var todayBtn = $(".c-today__btn");
  var addBtn = $(".js-event__add");
  var saveBtn = $(".js-event__save");
  var closeBtn = $(".js-event__close");
  var winCreator = $(".js-event__creator");
  var inputDate = $(this).data();
  var today = <?php echo date('Y') ?> + "-" + month + "-" + day;


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
  todayBtn.on("click", () => {
    window.location.href = window.location.href.includes("?year=") ? window.location.href.replace(/\?year=.*/, " ") : window.location.href;
  });

  // Higlight the cel of current day
  dataCel.each(() => {
    if ($(this).data("day") === today) {
      $(this).addClass("isToday");
      fillEventSidebar($(this));
    }
  });

  //window event creator
  addBtn.on("click", () => {
    winCreator.addClass("isVisible");
    $("body").addClass("overlay");
    dataCel.each(() => {
      if ($(this).hasClass("isSelected")) {
        today = $(this).data("day");
        document.querySelector('input[type="date"]').value = today;
      } else {
        document.querySelector('input[type="date"]').value = today;
      }
    });
  });
  closeBtn.on("click", () => {
    winCreator.removeClass("isVisible");
    $("body").removeClass("overlay");
  });
  saveBtn.on("click", () => {
    var inputName = $("input[name=name]").val();
    var inputDate = $("input[name=date]").val();
    var inputNotes = $("textarea[name=notes]").val();
    var inputTag = $("select[name=tags]")
      .find(":selected")
      .text();

    dataCel.each(() => {
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
  dataCel.on("click", () => {
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

  // Months paginator
  function buttonsPaginator(buttonId, mainClass, monthClass, next, prev) {
    switch (true) {
      case next:
        $(buttonId).on("click", () => {
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
        $(buttonId).on("click", () => {
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

