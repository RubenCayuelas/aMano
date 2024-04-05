<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('../../../model/php/funciones.php');
session_init();
$themeState = session_theme();

if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'R' && $_SESSION['id'] > 0) {

  // Declaración de variables
  // $resultado = $condicion ? 'verdadero' : 'falso';
  $dia = date('d');
  $mes = date('m');
  $año = isset($_GET['año']) ? $_GET['año'] : date('Y');
  $firstWeekDay = date('N', strtotime($año."-01-01"));
  function days_in_month($mes, $año) {
    return $mes == 2 ? ($año % 4 ? 28 : ($año % 100 ? 29 : ($año % 400 ? 28 : 29))) : (($mes - 1) % 7 % 2 ? 30 : 31);
  }

  // Head
  include('../../../view/users/recepcionista/recepcionista_head.php');
  
  // Body recepcionista - citas
  include('../../../view/users/recepcionista/citas/recepcionista_body.php');

  // https://alvarotrigo.com/blog/css-calendar/
  // 
  // Para el fotógrafo
  // https://codepen.io/alvarotrigo/pen/KKQzvdr?editors=1100
  
  // End
  include('../../../view/users/recepcionista/recepcionista_end.php');

} else {
  header("Location: ../../../index.php");
}