<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../models/php/funciones.php');
session_init();
$themeState = session_theme();


if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'C') {
  if (isset($_POST['openProyect'])) {

    include_once('../../../models/php/db.php');
    include('../../../models/php/trabajo.php');
    include('../../../models/php/foto.php');
    $trabajos = new Trabajo();
    $fotos = new Foto();

    $trabajo_id = $_POST['trabajo_id'];

    // Datos de el trabajo abierto 
    $trabajo = $trabajos->getTrabajo($trabajo_id);
    $listaFotos = $fotos->getPicturesForTrabajo($trabajo_id);
    $previewPicture = $fotos->getPreviewForTrabajo($trabajo_id);

    // Head
    include('../../../view/users/cliente/cliente_head.php');

    // Body cliente - trabajo
    include('../../../view/users/cliente/trabajos/cliente_body.php');

    if ($listaFotos != []) {
      include('../../../view/users/cliente/trabajos/bodyParts/body_picture_list.php');
    } else {
      include('../../../view/users/cliente/trabajos/bodyParts/body_no_results.html');
    }

    // End
    include('../../../view/users/cliente/cliente_end.html');

  } else {
    header("Location: ./controlador_miPerfil.php");
  }
} else {
  header("Location: ../../../index.php");
}
