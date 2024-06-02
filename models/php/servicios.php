<?php

class Servicios
{
  private $BD;
  private $servicios;

// Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

// Obtener datos de un servicio
  public function getServicio($id)
  {
    $consulta = $this->BD->prepare('
        SELECT id, nombre, descripcion, precio
        FROM servicio
        WHERE id = ?
    ');
    $consulta->bind_param('i', $id);
    $consulta->bind_result($id, $nombre, $descripcion, $precio);
    $consulta->execute();
    $i = 0;
    $this->servicios = null;
    while ($consulta->fetch()) {
      $this->servicios[$i]['id'] = $id;
      $this->servicios[$i]['nombre'] = $nombre;
      $this->servicios[$i]['descripcion'] = $descripcion;
      $this->servicios[$i]['precio'] = $precio;
      $i++;
    }
    $consulta->close();
    return $this->servicios;
  }

  // Listar servicios
  public function listarServicios()
  {
    $consulta = $this->BD->prepare('
        SELECT id, nombre, descripcion, precio
        FROM servicio
    ');
    $consulta->bind_result($id, $nombre, $descripcion, $precio);
    $consulta->execute();
    $i = 0;
    $this->servicios = null;
    while ($consulta->fetch()) {
      $this->servicios[$i]['id'] = $id;
      $this->servicios[$i]['nombre'] = $nombre;
      $this->servicios[$i]['descripcion'] = $descripcion;
      $this->servicios[$i]['precio'] = $precio;
      $i++;
    }
    $consulta->close();
    return $this->servicios;
  }

}
