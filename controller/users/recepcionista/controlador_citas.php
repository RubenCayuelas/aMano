<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'R' && $_SESSION['id'] > 0) {

  setlocale(LC_ALL, 'spanish');

  function days_in_month($mes, $año) {
    return $mes == 2 ? ($año % 4 ? 28 : ($año % 100 ? 29 : ($año % 400 ? 28 : 29))) : (($mes - 1) % 7 % 2 ? 30 : 31);
  }

  // Declaración de variables
  $day = date('d');
  $month = date('m');
  $año = isset($_GET['year']) ? $_GET['year'] : date('Y');
  $firstWeekDay = date('N', strtotime($año."-01-01"));

  include_once('../../../assets/db/db.php');

  // Sessions solicitudes
  include('../../../model/php/citas.php');
  include('../../../model/php/clientes.php');
  include('../../../model/php/fotografos.php');
  include('../../../model/php/servicios.php');
  $citas = new Citas();
  $clientes = new Clientes();
  $fotografos = new Fotografos();
  $servicios = new Servicios();

  $listaFotografos = $fotografos->listarFotografosRecepcionista();
  $listaServicios = $servicios->listarServicios();
  $listaClientes = $clientes->listarClientes();

  // Create a new cite for a client
  if (isset($_POST['addCita'])) {
    $result = $citas->añadirCitaCliente( $_POST['date'], $_POST['time'], $_POST['cliente'], $_SESSION['id_estudio'], $_POST['fotografo'], $_POST['servicio']);
    // $msg = 'Se ha creado la cita para el cliente correctamente.';
    // $msgError = 'Ha habido un error al crear la cita para el cliente.';

    // include('../../../view/users/recepcionista/clientes/bodyParts/msg_script.php');
  }

  // Accept or denny a solicitude from a client for a session
  if (isset($_POST['sessionSolicitudeAccept'])) {
    $citas->sessionStatusUpdate($_POST['id'], '1');
  } elseif (isset($_POST['sessionSolicitudeReject'])) {
    $citas->sessionStatusUpdate($_POST['id'], '0');
  }

  // Get the session solicitudes for this studio
  $solicitudes = $citas->getSessionSolicitudes();
  // Cancel past sessions
  $solicitudes = $citas->closePastsSessions($solicitudes);

  // Get the client data of the session solicitude
  for ($i=0; $i < count($solicitudes) ; $i++) { 
    $datosClientes[$i] = $clientes->getCliente($solicitudes[$i]['id_cliente']);
  }
  // Get the data of the session solicitude for Fotografo
  for ($i=0; $i < count($solicitudes); $i++) {
    $datosFotografos[$i] = $fotografos->getFotografo($solicitudes[$i]['id_fotografo']);
  }
  // Get the data of the session solicitude for Services
  for ($i=0; $i < count($solicitudes); $i++) {
    $datosServicios[$i] = $servicios->getServicio($solicitudes[$i]['id_servicio']);
  }

  // Head
  include('../../../view/users/recepcionista/citas/recepcionista_head.html');
  
  // Body recepcionista - citas
  include('../../../view/users/recepcionista/citas/recepcionista_body.php');
  include('../../../view/users/recepcionista/citas/recepcionista_body_solicitudes.php');

  // End
  include('../../../view/users/recepcionista/recepcionista_end.html');

} else {
  header("Location: ../../../index.php");
}