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

  // Controlador de la busqueda de clientes
  if (isset($_POST['busqueda']) && trim($_POST['search']) != '') {
  // Guarda la lista de todas las socios coincidentes con la busqueda
    $listaClientes = $clientes->buscarClientes($_POST['search']);
  } else {
  // Guarda la lista de todas las socios
    $listaClientes = $clientes->listarClientes();
  }

  // Paginación de la lista
  

  // Head
  include('../../../view/users/recepcionista/recepcionista_head.php');

  // Body recepcionista - clientes
  include('../../../view/users/recepcionista/clientes/recepcionista_body.php');

  if ($listaClientes == null || $listaClientes == '') {
    include('../../../view/users/recepcionista/clientes/bodyParts/body_no_results.php');
  } else {
    include('../../../view/users/recepcionista/clientes/bodyParts/body_results.php');
  }

  // JS
  include('../../../view/users/recepcionista/clientes/js/recepcionista_js.html');
  
  // End
  include('../../../view/users/recepcionista/recepcionista_end.php');

} else {
  header("Location: ../../../index.php");
}