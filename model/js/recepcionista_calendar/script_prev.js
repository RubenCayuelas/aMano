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