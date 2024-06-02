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
    include('../../../models/php/clientes.php');
    $trabajos = new Trabajo();
    $fotos = new Foto();
    $clientes = new Clientes();

    $trabajo_id = $_POST['trabajo_id'];

    // Manejo de la actualización del estado del proyecto vía AJAX
    // Fix it's not working
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $input = json_decode(file_get_contents('php://input'), true);
      if (isset($input['publico']) && isset($input['trabajo_id'])) {

        $publico = $input['publico'] ? 1 : 0;
        $trabajo_id = $input['trabajo_id'];
        $trabajos->updateWorkPublicStatus($trabajo_id, $publico);

        echo json_encode(['mensaje' => 'Estado del proyecto actualizado']);
        exit;
      } else {
        echo json_encode(['error' => 'Datos inválidos']);
        exit;
      }
    }

    if (isset($_POST['newPictures'])) {
      $datos_trabajo = $trabajos->getTrabajo($trabajo_id);
      $datos_usuario = $clientes->getCliente($datos_trabajo['id_cliente']);
      
      $result = $fotos->savePictures($trabajo_id, $_FILES['pictures'], $datos_usuario['nick'], $datos_trabajo['nombre']);

    } elseif (isset($_POST['deletePicture'])) {
      $datos_trabajo = $trabajos->getTrabajo($trabajo_id);
      $datos_usuario = $clientes->getCliente($datos_trabajo['id_cliente']);

      $fotos->deletePicture($_POST['deletePicture'], $datos_usuario['nick'], $datos_trabajo['nombre']);
    }

    // Datos de el trabajo abierto 
    $trabajo = $trabajos->getTrabajo($trabajo_id);
    $listaFotos = $fotos->getPicturesForTrabajo($trabajo_id);
    $previewPicture = $fotos->getPreviewForTrabajo($trabajo_id);

    // Head
    include('../../../view/users/fotografo/fotografo_head.php');

    // Body fotografo - misCitas
    include('../../../view/users/fotografo/trabajos/fotografo_body.php');

    if ($listaFotos != []) {
      include('../../../view/users/fotografo/trabajos/bodyParts/body_picture_list.php');
    } else {
      include('../../../view/users/fotografo/trabajos/bodyParts/body_no_results.html');
    }

    // End
    include('../../../view/users/fotografo/fotografo_end.html');

  } else {
    header("Location: ./controlador_miPerfil.php");
  }
} else {
  header("Location: ../../../index.php");
}
