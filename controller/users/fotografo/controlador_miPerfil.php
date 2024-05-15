<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'F') {

  include_once('../../../assets/db/db.php');
  include('../../../model/php/clientes.php');
  include('../../../model/php/trabajo.php');
  include('../../../model/php/foto.php');
  $clientes = new Clientes();
  $trabajos = new Trabajo();
  $fotos = new Foto();

  // Editar datos del fotografo
  if (isset($_POST['modCliente'])) {
    $result = $clientes->editCliente($_SESSION['id'], $_POST['name'], $_POST['nick'], $_POST['tlf'], $_POST['tlf2']);
    $msg = 'Se han modificado los datos correctamente.';
    $msgError = 'Ha habido un error al modificar los datos.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['modPass'])) {
    $result = $clientes->editClientePass($_SESSION['id'], $_POST['pass']);
    $msg = 'Se ha cambiado la contraseña correctamente.';
    $msgError = 'Ha habido un error durante el cambio de contraseña.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['changePicture'])) {
    $result = $clientes->changePictureForClient($_SESSION['id'], $_FILES['picture']);
    $msg = 'Se ha cambiado la foto de perfil correctamente.';
    $msgError = 'Ha habido un error al cambiar la foto de perfil.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['elimPicture'])) {
    $result = $clientes->elimPictureForCliente($_SESSION['id'], $_POST['elimPicture']); #Add the route to eliminate the outdated picture
    $msg = 'Se ha cambiado la foto de perfil correctamente.';
    $msgError = 'Ha habido un error al cambiar la foto de perfil.';

    include('../../../view/users/fotografo/miPerfil/bodyParts/msg_script.php');

  }

  
  $fotografo = $clientes->getCliente($_SESSION['id']);
  $listaTrabajos = $trabajos->getTrabajos($_SESSION['id']);
  
  
  for ($i=0; $i < count($listaTrabajos); $i++) {
    $previewTrabajosPictures[$i] = $fotos->getPreviewForTrabajo($listaTrabajos[$i]['id']);
  }

  // Head
  include('../../../view/users/fotografo/fotografo_head.php');

  // Body fotografo - miPerfil
  include('../../../view/users/fotografo/miPerfil/fotografo_body.php');
  // Msg of the result for adding a new photograph
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
