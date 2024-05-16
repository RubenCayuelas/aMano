<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();


if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'F') {
  if (isset($_POST['openProyect'])) {


    // Head
    include('../../../view/users/fotografo/fotografo_head.php');
  
    // Body fotografo - misCitas
    include('../../../view/users/fotografo/trabajos/fotografo_body.php');
  
    // End
    include('../../../view/users/fotografo/fotografo_end.html');
    

  } else {
    header("Location: ./controlador_miPerfil.php");
  }
} else {
  header("Location: ../../../index.php");
}
