<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'R' && $_SESSION['id'] == 0) {

  // Head
  include('../../../view/users/recepcionista/admin_head.php');
  
  // Body recepcionista - citas
  include('../../../view/users/recepcionista/recepcionistas/admin_body.php');
  
  // End
  include('../../../view/users/recepcionista/admin_end.php');

} else {
  header("Location: ../../../index.php");
}

