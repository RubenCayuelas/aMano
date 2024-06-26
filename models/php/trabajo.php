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

  // 
  public function getTrabajo($id_trabajo)
  {
    $consulta = $this->BD->prepare('SELECT t.id, t.nombre, t.descripcion, t.publico, t.id_servicio, se.nombre servicio,
                                           t.id_fotografo, f.nombre fotografo, t.id_cliente, c.nombre cliente, c.nick nick
                                      FROM trabajo t, cliente c, fotografo f, servicio se
                                      WHERE t.id_servicio = se.id
                                        AND t.id_fotografo = f.id
                                        AND t.id_cliente = c.id
                                        AND t.id = ?
    ');
    $consulta->bind_param('i', $id_trabajo);
    $consulta->bind_result($id, $nombre, $descripcion, $publico, $id_servicio, $servicio, $id_fotografo, $fotografo, $id_cliente, $cliente, $nick);
    $consulta->execute();
    $i = 0;
    $this->trabajo = null;
    while ($consulta->fetch()) {
      $this->trabajo['id'] = $id;
      $this->trabajo['nombre'] = $nombre;
      $this->trabajo['descripcion'] = $descripcion;
      $this->trabajo['publico'] = $publico;
      $this->trabajo['id_servicio'] = $id_servicio;
      $this->trabajo['servicio'] = $servicio;
      $this->trabajo['id_fotografo'] = $id_fotografo;
      $this->trabajo['fotografo'] = $fotografo;
      $this->trabajo['id_cliente'] = $id_cliente;
      $this->trabajo['cliente'] = $cliente;
      $this->trabajo['nick'] = $nick;
      $i++;
    }
    $consulta->close();
    return $this->trabajo;
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

  // Obtain all the public works
  public function getLastPublicWork()
  {
    $consulta = $this->BD->prepare('
        SELECT t.id, t.nombre, t.descripcion, t.publico, t.id_servicio, se.nombre servicio, t.id_fotografo, f.nombre fotografo, t.id_cliente, c.nombre cliente, c.nick nick
        FROM trabajo t
        INNER JOIN cliente c ON t.id_cliente = c.id
        INNER JOIN fotografo f ON t.id_fotografo = f.id
        INNER JOIN servicio se ON t.id_servicio = se.id
        WHERE t.publico = "1"
        ORDER BY t.id DESC
        LIMIT 1
    ');

    $consulta->execute();
    $consulta->bind_result($id, $nombre, $descripcion, $publico, $id_servicio, $servicio, $id_fotografo, $fotografo, $id_cliente, $cliente, $nick);
    $this->trabajo = null;
    if ($consulta->fetch()) {
      $this->trabajo['id'] = $id;
      $this->trabajo['nombre'] = $nombre;
      $this->trabajo['descripcion'] = $descripcion;
      $this->trabajo['publico'] = $publico;
      $this->trabajo['id_servicio'] = $id_servicio;
      $this->trabajo['servicio'] = $servicio;
      $this->trabajo['id_fotografo'] = $id_fotografo;
      $this->trabajo['fotografo'] = $fotografo;
      $this->trabajo['id_cliente'] = $id_cliente;
      $this->trabajo['cliente'] = $cliente;
      $this->trabajo['nick'] = $nick;
    }
    $consulta->close();
    return $this->trabajo;
  }


  // Obtain all the works for a client that match the search data
  public function getTrabajosSearch($cliente, $search)
  {
    $busqueda = $search . "%";
    $consulta = $this->BD->prepare('
        SELECT t.id, t.nombre, t.descripcion, t.publico, t.id_servicio, se.nombre servicio, t.id_fotografo, f.nombre fotografo, t.id_cliente, c.nombre cliente, c.nick nick
        FROM trabajo t, cliente c, fotografo f, servicio se
        WHERE t.id_servicio = se.id
          AND t.id_fotografo = f.id
          AND t.id_cliente = c.id
          AND t.id_cliente = ?
          AND (c.nombre LIKE ? 
            OR se.nombre LIKE ?
            OR t.nombre LIKE ?
            OR f.nombre LIKE ?)
    ');
    $consulta->bind_param('issss', $cliente, $busqueda, $busqueda, $busqueda, $busqueda);
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

  // Obtain all the works for a photographer
  public function getTrabajosForPhotographer($fotografo)
  {
    $consulta = $this->BD->prepare('
        SELECT t.id, t.nombre, t.descripcion, t.publico, t.id_servicio, se.nombre servicio, t.id_fotografo, f.nombre fotografo, t.id_cliente, c.nombre cliente, c.nick nick
        FROM trabajo t, cliente c, fotografo f, servicio se
        WHERE t.id_servicio = se.id
          AND t.id_fotografo = f.id
          AND t.id_cliente = c.id
          AND t.id_fotografo = ?
    ');
    $consulta->bind_param('i', $fotografo);
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

  // Obtain all the works for a photographer  that match the search data
  public function getTrabajosForPhotographerSearch($fotografo, $search)
  {
    $busqueda = $search . "%";
    $consulta = $this->BD->prepare('
        SELECT t.id, t.nombre, t.descripcion, t.publico, t.id_servicio, se.nombre servicio, t.id_fotografo, f.nombre fotografo, t.id_cliente, c.nombre cliente, c.nick nick
        FROM trabajo t, cliente c, fotografo f, servicio se
        WHERE t.id_servicio = se.id
          AND t.id_fotografo = f.id
          AND t.id_cliente = c.id
          AND t.id_fotografo = ?
          AND (c.nombre LIKE ? 
            OR se.nombre LIKE ?
            OR t.nombre LIKE ?
            OR f.nombre LIKE ?)
    ');
    $consulta->bind_param('issss', $fotografo, $busqueda, $busqueda, $busqueda, $busqueda);
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

  // Obtain the id of the last work created by the photographer
  public function lastWorkId($fotografo)
  {
    $consulta = $this->BD->prepare('SELECT MAX(id) AS last_work_id FROM trabajo WHERE id_fotografo = ?');
    $consulta->bind_param('i', $fotografo);
    $consulta->execute();
    $resultado = $consulta->get_result()->fetch_assoc();
    $consulta->close();
    return $resultado['last_work_id'];
  }

  // Create a new Work
  public function newTrabajo($nombre, $descripcion, $id_servicio, $id_cliente, $id_fotografo)
  {
    $consulta = $this->BD->prepare('INSERT INTO trabajo (nombre, descripcion, publico, id_servicio, id_cliente, id_fotografo) VALUES (?, ?, "0", ?, ?, ?)');
    $consulta->bind_param('ssiii', $nombre, $descripcion, $id_servicio, $id_cliente, $id_fotografo);
    $resultado = $consulta->execute();
    $consulta->close();
    return $resultado;
  }

  // Update the puclic status of a work
  public function updateWorkPublicStatus($trabajo_id, $publico)
  {
    return "PATATA"; // Change this to something that works
  }
}
