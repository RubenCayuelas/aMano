<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../models/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'C') {

  setlocale(LC_ALL, 'spanish');

  function days_in_month($mes, $año) {
    return $mes == 2 ? ($año % 4 ? 28 : ($año % 100 ? 29 : ($año % 400 ? 28 : 29))) : (($mes - 1) % 7 % 2 ? 30 : 31);
  }

  // Declaración de variables para el calendario
  $day = date('d');
  $month = date('m');
  $año = isset($_GET['year']) ? $_GET['year'] : date('Y');
  $firstWeekDay = date('N', strtotime($año."-01-01"));

  include_once('../../../models/php/db.php');

  include('../../../models/php/citas.php');
  include('../../../models/php/estudios.php');
  include('../../../models/php/fotografos.php');
  include('../../../models/php/servicios.php');
  $citas = new Citas();
  $estudios = new Estudios();
  $fotografos = new Fotografos();
  $servicios = new Servicios();

  $listaEstudios = $estudios->listadoEstudios();
  $listaServicios = $servicios->listarServicios();
  $listaCitas = $citas->getAllSessionsForClient($_SESSION['id']);
  
  // Create a new session solicitude in two steps
  if (isset($_POST['addCita'])) {
    // Step 1: Date, time and studio
    $listaFotografos = $fotografos->listarFotografosDelEstudio($_POST['estudio']);
  } elseif (isset($_POST['addCita2'])) {
    // Stept 2: Photographer and service
    $result = $citas->añadirCitaCliente( $_POST['date'], $_POST['time'], $_SESSION['id'], $_POST['estudio'], $_POST['fotografo'], $_POST['servicio']);
    // header('Location: #');
  }

  // Head
  include('../../../view/users/cliente/misCitas/cliente_head.php');

  // Body cliente - misCitas
  include('../../../view/users/cliente/misCitas/cliente_body.php');

  // End
  include('../../../view/users/cliente/cliente_end.html');

} else {
  header("Location: ../../../index.php");
}
