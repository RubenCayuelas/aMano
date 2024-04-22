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
        