<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();


if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'R' && $_SESSION['id'] > 0) {

  include_once('../../../assets/db/db.php');
  include('../../../model/php/fotografos.php');
  $fotografos = new Fotografos();
  
  // Controlador de la busqueda de fotografos
  if (isset($_POST['busqueda']) && trim($_POST['search']) != '') {
  // Guarda la lista de todas las socios coincidentes con la busqueda
    $listaFotografos = $fotografos->buscarFotografos($_POST['search']);
  } else {
  // Guarda la lista de todas las socios
    $listaFotografos = $fotografos->listarFotografosRecepcionista();
  }

  // Head
  include('../../../view/users/recepcionista/recepcionista_head.php');
  
  // Body recepcionista - fotógrafos
  include('../../../view/users/recepcionista/fotógrafos/recepcionista_body.php');

  if ($listaFotografos == null || $listaFotografos == '') {
    include('../../../view/users/recepcionista/fotógrafos/bodyParts/body_no_results.php');
  } else {
    include('../../../view/users/recepcionista/fotógrafos/bodyParts/body_results.php');
  }
  
  // End
  include('../../../view/users/recepcionista/recepcionista_end.php');

} else {
  header("Location: ../../../index.php");
}