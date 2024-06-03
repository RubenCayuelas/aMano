<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../models/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'C') {

  include_once('../../../models/php/db.php');
  include('../../../models/php/clientes.php');
  include('../../../models/php/trabajo.php');
  include('../../../models/php/foto.php');
  $clientes = new Clientes();
  $trabajos = new Trabajo();
  $fotos = new Foto();

  // Editar datos del cliente
  if (isset($_POST['modCliente'])) {
    $result = $clientes->editCliente($_SESSION['id'], $_POST['name'], $_POST['nick'], $_POST['tlf'], $_POST['tlf2']);
    $msg = 'Se han modificado los datos correctamente.';
    $msgError = 'Ha habido un error al modificar los datos.';

    include('../../../view/users/cliente/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['modPass'])) {
    $result = $clientes->editClientePass($_SESSION['id'], $_POST['pass']);
    $msg = 'Se ha cambiado la contraseña correctamente.';
    $msgError = 'Ha habido un error durante el cambio de contraseña.';

    include('../../../view/users/cliente/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['changePicture'])) {
    $result = $clientes->changePictureForClient($_SESSION['id'], $_FILES['picture'], $_POST['changePicture']);
    $msg = 'Se ha cambiado la foto de perfil correctamente.';
    $msgError = 'Ha habido un error al cambiar la foto de perfil.';

    include('../../../view/users/cliente/miPerfil/bodyParts/msg_script.php');

  } elseif (isset($_POST['elimPicture'])) {
    $result = $clientes->elimPictureForCliente($_SESSION['id'], $_POST['elimPicture']);
    $msg = 'Se ha cambiado la foto de perfil correctamente.';
    $msgError = 'Ha habido un error al cambiar la foto de perfil.';

    include('../../../view/users/cliente/miPerfil/bodyParts/msg_script.php');

  }

  
  $cliente = $clientes->getCliente($_SESSION['id']);
  
  if (isset($_POST['busqueda'])) {
    $listaTrabajosData = $trabajos->getTrabajosSearch($_SESSION['id'], $_POST['search']);
    $listaTrabajos = $listaTrabajosData != null ? $listaTrabajosData : [];
  } else {
    $listaTrabajosData = $trabajos->getTrabajos($_SESSION['id']);
    $listaTrabajos = $listaTrabajosData != null ? $listaTrabajosData : [];
  }
  
  
  for ($i=0; $i < count($listaTrabajos); $i++) {
    $previewTrabajosPictures[$i] = $fotos->getPreviewForTrabajo($listaTrabajos[$i]['id']);
  }

  // Head
  include('../../../view/users/cliente/cliente_head.php');

  // Body cliente - miPerfil
  include('../../../view/users/cliente/miPerfil/cliente_body.php');
  // Msg of the result for adding a new client
  include('../../../view/users/cliente/miPerfil/bodyParts/msg.html');

  if ($listaTrabajos == null || $listaTrabajos == '') {
    include('../../../view/users/cliente/miPerfil/bodyParts/body_no_results.html');
  } else {
    include('../../../view/users/cliente/miPerfil/bodyParts/body_results.php');
  }

  // End
  include('../../../view/users/cliente/cliente_end.html');
  
} else {
  header("Location: ../../../index.php");
}
