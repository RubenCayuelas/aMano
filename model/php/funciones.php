<?php

function session_theme()
{
  if (isset($_COOKIE['theme'])) {
    $_SESSION['theme'] = $_COOKIE['theme'];
  } else {
    setcookie("theme","light",time()+(60*60*60*24*7), "/");
    $_SESSION['theme'] = 'light';
  }

  return $_SESSION['theme'] == 'light' ? '' : 'checked';
}

function session_init()
{
  if (!isset($_SESSION['id']) && isset($_COOKIE['session'])) {
    // session_decode($_COOKIE['session']);
    s_decode($_COOKIE['session']);
  }
}

function s_encode($valores)
{
  $datos = '';
  foreach ($valores as $k => $v) {
    if ($k%2==0) {
      $datos= $datos."$v=";
      
    } else {
      if ($k < (count($valores)-1)) {
        $datos= $datos."$v;";
      } else {
        $datos= $datos."$v";
      }
    }
  }
  return $datos;
}
function s_decode($cookie)
{
  $datos = explode(';',$cookie);
  foreach ($datos as $v) {
    $dato = explode('=', $v);
    // print_r($dato);
    $_SESSION[$dato[0]] = $dato[1];
  }
}