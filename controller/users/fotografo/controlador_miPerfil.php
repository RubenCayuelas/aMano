<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../models/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'F') {

  include_once('../../../models/php/db.php');
  include('../../../models/php/clientes.php');
  include('../../../models/php/fotografos.php');
  include('../../../models/php/trabajo.php');
  include('../../../models/php/foto.php');
  include('../../../models/php/citas.php');
  $clientes = new Clientes();
  $fotografos = new Fotografos();
  $trabajos = new Trabajo();
  $fotos = new Foto();
  $citas = new Citas();

  // Editar datos del fotografo y crea un nuevo trabajo
  if (isset($_POST['modFotografo'])) {
    $result = $fotografos->editFotografo($_SESSION['id'], $_POST['name'], $_POST['nick'], $_POST['habilidades'], $_POST['descripcion']);
    $msg = 'Se han modificado los datos correctamente.';
    $msgError = 'Ha habido un error al modificar los datos.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['modPass'])) {
    $result = $fotografos->editPassForPhotographer($_SESSION['id'], $_POST['pass']);
    $msg = 'Se ha cambiado la contraseña correctamente.';
    $msgError = 'Ha habido un error durante el cambio de contraseña.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['changePicture'])) {
    $result = $fotografos->changePictureForPhotograph($_SESSION['id'], $_FILES['picture'], $_POST['changePicture']);
    $msg = 'Se ha cambiado la foto de perfil correctamente.';
    $msgError = 'Ha habido un error al cambiar la foto de perfil.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['elimPicture'])) {
    $result = $fotografos->elimPictureForPhotograph($_SESSION['id'], $_POST['elimPicture']);
    $msg = 'Se ha cambiado la foto de perfil correctamente.';
    $msgError = 'Ha habido un error al cambiar la foto de perfil.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['newWork'])) {
    // Get service and client id for the session assigned to create the new work
    $datosCita = $citas->getSession($_POST['session']);

    if (!empty($datosCita)) {
      $newWork = $trabajos->newTrabajo($_POST['nombre'], $_POST['descripcion'], $datosCita[0]['id_servicio'], $datosCita[0]['id_cliente'], $_SESSION['id']);
      if ($newWork) {
        $lastWorkId = $trabajos->lastWorkId($_SESSION['id']);
        if (!empty($lastWorkId)) {
          $result = $citas->sessionAddWork($_POST['session'], $lastWorkId);
        } else {
          $result = false;
        }
      } else {
        $result = false;
      }
    } else {
      $result = false;
    }

    $msg = 'Se ha creado el trabajo correctamente.';
    $msgError = 'Ha habido un error crear el trabajo.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');
  }

  
  $fotografo = $fotografos->getFotografo($_SESSION['id']);
  $listaTrabajos = $trabajos->getTrabajosForPhotographer($_SESSION['id']);
  $listaTrabajosPorCrear = $citas->getSessionsAbleForCreateWorkFromPhotographer($_SESSION['id']);
  
  for ($i=0; $i < count($listaTrabajos); $i++) {
    $previewTrabajosPictures[$i] = $fotos->getPreviewForTrabajo($listaTrabajos[$i]['id']);
  }

  // Head
  include('../../../view/users/fotografo/fotografo_head.php');

  // Body fotografo - miPerfil
  include('../../../view/users/fotografo/miPerfil/fotografo_body.php');
  // Msg of the result (success or failure)
  include('../../../view/users/fotografo/miPerfil/bodyParts/msg.html');

  if ($listaTrabajos == null || $listaTrabajos == '') {
    include('../../../view/users/fotografo/miPerfil/bodyParts/body_no_results.html');
  } else {
    include('../../../view/users/fotografo/miPerfil/bodyParts/body_results.php');
  }

  // End
  include('../../../view/users/fotografo/fotografo_end.html');
  
} else {
  header("Location: ../../../index.php");
}
