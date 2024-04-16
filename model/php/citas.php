<?php

class Citas
{
  private $BD;
  private $citas;

// Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

// Obtain the session solicitudes
  // public function getSessionSolicitudes()
  // {
  //   $consulta = $this->BD->prepare('
  //         SELECT id, fecha, hora, estado, id_estudio, id_fotógrafo
  //         from cliente
  //         WHERE nick = ?
  //             AND pass = ?
  //   ');
  //   $consulta->bind_param('ss', $nick, $contraseña);
  //   $consulta->execute();
  //   $resultado = $consulta->get_result();
  //   if ($resultado->num_rows > 0) {
  //     $datosReseult = $resultado->fetch_assoc();
  //     $datos['id'] = $datosReseult['id'];
  //     $datos['nick'] = $datosReseult['nick'];
  //     $datos['nombre'] = $datosReseult['nombre'];
  //     $datos['foto'] = $datosReseult['foto'];
  //     $datos['tipo'] = 'C';
  //   } else {
  //     $datos['id'] = -1;
  //   }
  //   return $datos;
  //   $consulta->close();
  // }

// Obtain the session solicitudes for that year


// Create a new session for some client


// 





}
