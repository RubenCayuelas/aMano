<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../models/php/funciones.php');
session_init();
$themeState = session_theme();


if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'F') {
  if (isset($_POST['openProyect'])) {

    include_once('../../../models/php/db.php');
    include('../../../models/php/trabajo.php');
    include('../../../models/php/foto.php');
    $trabajos = new Trabajo();
    $fotos = new Foto();

    // Datos de el trabajo abierto 
    $trabajo = $trabajos->getTrabajo($_POST['trabajo_id']);
    $listaFotos = $fotos->getPicturesForTrabajo($_POST['trabajo_id']);
    $previewPicture = $fotos->getPreviewForTrabajo($_POST['trabajo_id']);

    // Head
    include('../../../view/users/fotografo/fotografo_head.php');

    // Body fotografo - misCitas
    include('../../../view/users/fotografo/trabajos/fotografo_body.php');

    include('../../../view/users/fotografo/trabajos/bodyParts/body_picture_list.php');

    // End
    include('../../../view/users/fotografo/fotografo_end.html');
    

  } else {
    header("Location: ./controlador_miPerfil.php");
  }
} else {
  header("Location: ../../../index.php");
}
