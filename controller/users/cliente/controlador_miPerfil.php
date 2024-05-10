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
  // include('../../../model/php/fotografos.php');
  // include('../../../model/php/servicios.php');
  // include('../../../model/php/citas.php');
  $clientes = new Clientes();
  // $fotografos = new Fotografos();
  // $servicios = new Servicios();
  // $citas = new Citas();

  $cliente = $clientes->getCliente($_SESSION['id']);

  // Head
  include('../../../view/users/cliente/cliente_head.php');

  // Body cliente - miPerfil
  include('../../../view/users/cliente/miPerfil/cliente_body.php');

  // End
  include('../../../view/users/cliente/cliente_end.html');
  
} else {
  header("Location: ../../../index.php");
}
