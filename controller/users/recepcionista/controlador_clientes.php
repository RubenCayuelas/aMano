<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../models/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'R' && $_SESSION['id'] > 0) {

  include_once('../../../models/php/db.php');
  include('../../../models/php/clientes.php');
  include('../../../models/php/fotografos.php');
  include('../../../models/php/servicios.php');
  include('../../../models/php/citas.php');
  $clientes = new Clientes();
  $fotografos = new Fotografos();
  $servicios = new Servicios();
  $citas = new Citas();

  $listaFotografos = $fotografos->listarFotografosRecepcionista();
  $listaServicios = $servicios->listarServicios();

  // Añadir citas y añadir y modificar datos de clientes
  if (isset($_POST['modCliente'])) {
    $result = $clientes->editCliente($_POST['modCliente'], $_POST['nombre'], $_POST['nick'], $_POST['tlf'], $_POST['tlf2']);
    $msg = 'El cliente se modificado correctamente.';
    $msgError = 'Ha habido un error al modificar el cliente.';

    include('../../../view/users/recepcionista/clientes/bodyParts/msg_script.php');

  } elseif (isset($_POST['modPass'])) {
    $result = $clientes->editClientePass($_POST['modPass'], $_POST['pass']);
    $msg = 'El cliente se modificado correctamente.';
    $msgError = 'Ha habido un error al modificar el cliente.';

    include('../../../view/users/recepcionista/clientes/bodyParts/msg_script.php');

  } elseif (isset($_POST['newCliente'])) {
    $result = $clientes->añadirCliente($_POST['nombre'], $_POST['nick'], $_POST['password'], $_POST['tlf'], $_POST['tlf2']);
    $msg = 'El cliente se ha añadido correctamente.';
    $msgError = 'Ha habido un error al añadir el cliente.';

    include('../../../view/users/recepcionista/clientes/bodyParts/msg_script.php');

  } elseif (isset($_POST['addCita'])) {
    $result = $citas->añadirCitaCliente( $_POST['date'], $_POST['time'], $_POST['addCita'], $_SESSION['id_estudio'], $_POST['fotografo'], $_POST['servicio']);
    $msg = 'Se ha creado la cita para el cliente correctamente.';
    $msgError = 'Ha habido un error al crear la cita para el cliente.';

    include('../../../view/users/recepcionista/clientes/bodyParts/msg_script.php');
  }

  // Controlador de la busqueda de clientes
  if (isset($_POST['busqueda']) && trim($_POST['search']) != '') {
    // Guarda la lista de todas las socios coincidentes con la busqueda
    $listaClientes = $clientes->buscarClientes($_POST['search']);
  } else {
    // Guarda la lista de todas las socios
    $listaClientes = $clientes->listarClientes();
  }

  // Head
  include('../../../view/users/recepcionista/recepcionista_head.html');

  // Body recepcionista - clientes
  include('../../../view/users/recepcionista/clientes/recepcionista_body.php');
 
  // Msg of the result for adding a new client
  include('../../../view/users/recepcionista/clientes/bodyParts/msg.html');

  // Search results 
  if ($listaClientes == null || $listaClientes == '') {
    include('../../../view/users/recepcionista/clientes/bodyParts/body_no_results.html');
  } else {
    include('../../../view/users/recepcionista/clientes/bodyParts/body_results.php');
  }

  // JS
  include('../../../view/users/recepcionista/collapse_js/collapse.html');

  // End
  include('../../../view/users/recepcionista/recepcionista_end.html');
} else {
  header("Location: ../../../index.php");
}
