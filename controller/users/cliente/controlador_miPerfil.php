<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();


if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'C') {

  // Head
  include('../../../view/users/cliente/cliente_head.html');

  // Body cliente - miPerfil
  include('../../../view/users/cliente/miPerfil/cliente_body.php');

  // End
  include('../../../view/users/cliente/cliente_end.html');
  
} else {
  header("Location: ../../../index.php");
}
