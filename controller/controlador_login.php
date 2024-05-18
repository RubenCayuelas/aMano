<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include_once('../models/php/funciones.php');
$themeState = session_theme();


if (isset($_GET['logout'])) {
  // Cierra la sesión y borra la cookie
  if (isset($_COOKIE['session'])) {
    setcookie('session', "", time() - 6000, "/");
  }
  session_destroy();
  header("refresh:0;url=../index.php");
} else {

  
  if (isset($_POST['login'])) {
  // Compruebla que se ha enviado el formulario y que los datos son correctos y almacenandolos en la sesión y en una cookie si el usuario quiere, por el contrario si los datos no son correctos muestra un mensaje de error.
    if (trim($_POST['user']) != '' && trim($_POST['password']) != '') {

      include_once('../models/php/db.php');

      include_once('../models/php/usuarios.php');
      include_once('../models/php/recepcionistas.php');
      include_once('../models/php/fotografos.php');
      include_once('../models/php/clientes.php');
      $usuarios = new Usuarios();
      $datosUsuario = $usuarios->login($_POST['user'], $_POST['password']);

      if ($datosUsuario['id'] != -1) {
        
        $_SESSION['id'] = $datosUsuario['id'];
        $_SESSION['nick'] = $datosUsuario['nick'];
        $_SESSION['userType'] = $datosUsuario['tipo'];
        $_SESSION['nombre'] = $datosUsuario['nombre'];

        if ($_SESSION['userType'] == 'R') {
          // Guarda más datos específicos del recepcionista
          $_SESSION['id_estudio'] = $datosUsuario['id_estudio'];
          recordarme('id', $_SESSION['id'],'nick', $_SESSION['nick'],'userType', $_SESSION['userType'], 'nombre', $_SESSION['nombre'], 'id_estudio', $_SESSION['id_estudio']);
          if ($_SESSION['id'] == 0) {
            // Redicección a la página del administrador
            echo '<meta http-equiv="refresh" content="0;url=./users/admin/controlador_clientes.php">';
          } else {
            // Redirección a la pagina principal del los recepcionistas
            echo '<meta http-equiv="refresh" content="0;url=./users/recepcionista/controlador_clientes.php">';
          }
        } elseif ($_SESSION['userType'] == 'F') {
          recordarme('id', $_SESSION['id'],'nick', $_SESSION['nick'],'userType', $_SESSION['userType'], 'nombre', $_SESSION['nombre']);
          // Redirección a la pagina principal del los fotógrafo
          echo '<meta http-equiv="refresh" content="0;url=./users/fotografo/controlador_miPerfil.php">';
        } elseif ($_SESSION['userType'] == 'C') {
          recordarme('id', $_SESSION['id'],'nick', $_SESSION['nick'],'userType', $_SESSION['userType'], 'nombre', $_SESSION['nombre']);
          // Redirección a la pagina principal del cliente
          echo '<meta http-equiv="refresh" content="0;url=./users/cliente/controlador_miPerfil.php">';
        }

      } else {
        // Escribe un mensaje describiendo el error ocurrido
        include('../view/login/login_head.php');
        include('../view/login/login_body.php');
        echo "<script defer>document.querySelector('div#info_text').innerHTML = 'El nombre de usuario o la contraseña son incorrectos'</script>";
      }
    } else {
      // Escribe un mensaje describiendo el error ocurrido
      include('../view/login/login_head.php');
      include('../view/login/login_body.php');
      echo "<script defer>document.querySelector('div#info_text').innerHTML = 'Debes de completar todos los campos'</script>";
    }
  } else {
    // En caso de no haber enviado el login tambien pinta el Body
    include('../view/login/login_head.php');
    include('../view/login/login_body.php');
  }

  // Footer
  include('../view/login/login_end.php');
}

function recordarme(...$valores) {
  // Comprueba si queremos que recordemos la sesión para ello creamos la siginete cookie.
  if (isset($_POST['recordarme'])) {
    $datos = [];
    foreach ($valores as $i => $value) {
      $datos[$i] = $value;
    }
    setcookie("session", s_encode($datos), time() + 604800, "/");
    
    // setcookie("session", session_encode(), time() + 604800, "/");
    // 604800 son los segundos de una semana (el tiempo que se mantendrá la cookie).
  }
}