<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'R' && $_SESSION['id'] > 0) {

  include_once('../../../assets/db/db.php');
  include('../../../model/php/clientes.php');
  $clientes = new Clientes();

  // Añadir o modificar clientes
  if (isset($_POST['modCliente'])) {
    $clientes->editCliente($_POST['id'], $_POST['nombre'], $_POST['nick'], $_POST['password'], $_POST['tlf'], $_POST['tlf2']);
  } elseif (isset($_POST['newCliente'])) {
    $add = $clientes->añadirCliente($_POST['nombre'], $_POST['nick'], $_POST['password'], $_POST['tlf'], $_POST['tlf2']);
    include('../../../view/users/recepcionista/clientes/bodyParts/msg_script.php');
  }

  // Crear cita para un cliente
  if (isset($_POST['addCita'])) {
    
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
  include('../../../view/users/recepcionista/clientes/js/recepcionista_js.html');

  // End
  include('../../../view/users/recepcionista/recepcionista_end.html');
} else {
  header("Location: ../../../index.php");
}
