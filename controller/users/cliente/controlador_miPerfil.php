<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'C') {

  // Head
  include('../../../view/users/cliente/cliente_head.php');

  // Body cliente - miPerfil
  include('../../../view/users/cliente/miPerfil/cliente_body.php');

  // End
  include('../../../view/users/cliente/cliente_end.php');
  
} else {
  header("Location: ../../../index.php");
}
