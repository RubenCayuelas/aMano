<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'C') {

  include_once('../../../assets/db/db.php');
  include('../../../model/php/clientes.php');
  include('../../../model/php/trabajo.php');
  include('../../../model/php/foto.php');
  include('../../../model/php/citas.php');
  $clientes = new Clientes();
  $trabajos = new Trabajo();
  $fotos = new Foto();
  $citas = new Citas();

  $cliente = $clientes->getCliente($_SESSION['id']);
  $listaTrabajos = $trabajos->getTrabajos($_SESSION['id']);
  
  // $listaCitas = $citas->getAllSessionsForClient($_SESSION['id']);
  
  for ($i=0; $i < count($listaTrabajos); $i++) {
    $previewTrabajosPictures[$i] = $fotos->getPreviewForTrabajo($listaTrabajos[$i]['id']);
  }

  // Head
  include('../../../view/users/cliente/cliente_head.php');

  // Body cliente - miPerfil
  include('../../../view/users/cliente/miPerfil/cliente_body.php');

  if ($listaTrabajos == null || $listaTrabajos == '') {
    include('../../../view/users/cliente/miPerfil/bodyParts/body_no_results.html');
  } else {
    include('../../../view/users/cliente/miPerfil/bodyParts/body_results.php');
  }

  // End
  include('../../../view/users/cliente/cliente_end.html');
  
} else {
  header("Location: ../../../index.php");
}
