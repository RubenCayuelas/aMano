<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();


if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'R' && $_SESSION['id'] > 0) {

  // Head
  include('../../../view/users/recepcionista/recepcionista_head.php');
  
  // Body recepcionista - fotógrafos
  include('../../../view/users/recepcionista/fotógrafos/recepcionista_body.php');
  
  // End
  include('../../../view/users/recepcionista/recepcionista_end.php');

} else {
  header("Location: ../../../index.php");
}