<?php

class Trabajo
{
  private $BD;
  private $trabajo;

  // Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

  // Obtain all the works for a client
  public function getTrabajos($cliente)
  {
    $consulta = $this->BD->prepare('
        SELECT t.id, t.nombre, t.descripcion, t.publico, t.id_servicio, se.nombre servicio, t.id_fotografo, f.nombre fotografo, t.id_cliente, c.nombre cliente, c.nick nick
        FROM trabajo t, cliente c, fotografo f, servicio se
        WHERE t.id_servicio = se.id
          AND t.id_fotografo = f.id
          AND t.id_cliente = c.id
          AND t.id_cliente = ?
    ');
    $consulta->bind_param('i', $cliente);
    $consulta->bind_result($id, $nombre, $descripcion, $publico, $id_servicio, $servicio, $id_fotografo, $fotografo, $id_cliente, $cliente, $nick);
    $consulta->execute();
    $i = 0;
    $this->trabajo = null;
    while ($consulta->fetch()) {
      $this->trabajo[$i]['id'] = $id;
      $this->trabajo[$i]['nombre'] = $nombre;
      $this->trabajo[$i]['descripcion'] = $descripcion;
      $this->trabajo[$i]['publico'] = $publico;
      $this->trabajo[$i]['id_servicio'] = $id_servicio;
      $this->trabajo[$i]['servicio'] = $servicio;
      $this->trabajo[$i]['id_fotografo'] = $id_fotografo;
      $this->trabajo[$i]['fotografo'] = $fotografo;
      $this->trabajo[$i]['id_cliente'] = $id_cliente;
      $this->trabajo[$i]['cliente'] = $cliente;
      $this->trabajo[$i]['nick'] = $nick;
      $i++;
    }
    $consulta->close();
    return $this->trabajo;
  }

}
