<?php

class Estudios
{
  private $BD;
  private $estudios;

// Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

// Obtener datos de estudio
  public function getEstudio($id)
  {
    $consulta = $this->BD->prepare('
        SELECT id, dirreccion, tlf
          FROM estudio 
          WHERE id = ?
    ');
    $consulta->bind_param('i', $id);
    $consulta->bind_result($id, $dirreccion, $tlf);
    $consulta->execute();
    $i = 0;
    $this->estudios = null;
    while ($consulta->fetch()) {
      $this->estudios[$i]['id'] = $id;
      $this->estudios[$i]['dirreccion'] = $dirreccion;
      $this->estudios[$i]['tlf'] = $tlf;
      $i++;
    }
    $consulta->close();
    return $this->estudios;
  }

}
