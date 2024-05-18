<?php

class Usuarios
{
  
// Login
  public function login($nick, $pass)
  {
    $recepcionistas = new Recepcionistas;
    $fotografos = new Fotografos;
    $clientes = new Clientes;

    $tipoUsuario = [$recepcionistas, $fotografos, $clientes];

    $i=0;
    while (!isset($usuarios['tipo']) && $i<count($tipoUsuario)) {
      $usuarios = new $tipoUsuario[$i];
      $usuarios = $usuarios->login($nick, $pass);
      $i++;
    }
    return $usuarios;
  }
}
