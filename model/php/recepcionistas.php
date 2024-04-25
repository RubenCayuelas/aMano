<?php

class Recepcionistas
{
  private $BD;
  private $recepcionistas;

// Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

// Login
  public function login($nick, $pass)
  {
    $consulta = $this->BD->prepare('
          SELECT id, nick, nombre
          from recepcionista
          WHERE nick = ?
              AND pass = ?
    ');
    $contraseña = md5(md5(md5(md5(md5($pass)))));
    $consulta->bind_param('ss', $nick, $contraseña);
    $consulta->execute();
    $resultado = $consulta->get_result();
    if ($resultado->num_rows > 0) {
      $datosReseult = $resultado->fetch_assoc();
      $datos['id'] = $datosReseult['id'];
      $datos['nick'] = $datosReseult['nick'];
      $datos['nombre'] = $datosReseult['nombre'];
      $datos['tipo'] = 'R';
    } else {
      $datos['id'] = -1;
    }
    return $datos;
    $consulta->close();
  }

// Listar Recepcionistas
  public function listarRecepcionistas()
  {
    $consulta = $this->BD->query('
            SELECT id, nombre, nick, foto, tlf, id_estudio
            FROM recepcionista
            WHERE activo = "1"
    ');
    $this->recepcionistas = null;
    $this->recepcionistas = $consulta->fetch_all(MYSQLI_ASSOC);
    return $this->recepcionistas;
  }

// Buscar recepcionista
  public function buscarRecepciomistas($search)
  {
    $busqueda = $search . '%';
    $consulta = $this->BD->prepare('
                SELECT id, nombre, nick, tlf, id_estudio
                FROM recepcionista 
                WHERE (nombre like ? 
                  OR nick like ? 
                  OR tlf like ?)
                    AND activo = "1"
                    AND id != 0
    ');
    $consulta->bind_param('sss', $busqueda, $busqueda, $busqueda);
    $consulta->bind_result($id, $nombre, $nick, $tlf, $id_estudio);
    $consulta->execute();
    $i = 0;
    $this->recepcionistas = null;
    while ($consulta->fetch()) {
      $this->recepcionistas[$i]['id'] = $id;
      $this->recepcionistas[$i]['nombre'] = $nombre;
      $this->recepcionistas[$i]['nick'] = $nick;
      $this->recepcionistas[$i]['tlf'] = $tlf;
      $this->recepcionistas[$i]['id_estudio'] = $id_estudio;
      $i++;
    }
    $consulta->close();
    return $this->recepcionistas;
  }

// Obtener datos de recepcionista
  public function getRecepcionista($id)
  {
    $consulta = $this->BD->prepare('
      SELECT id, nombre, nick, tlf, id_estudio
        FROM recepcionista 
        WHERE id = ?
    ');
    $consulta->bind_param('i', $id);
    $consulta->bind_result($id, $nombre, $nick, $tlf, $id_estudio);
    $consulta->execute();
    $i = 0;
    $this->recepcionistas = null;
    while ($consulta->fetch()) {
      $this->recepcionistas[$i]['id'] = $id;
      $this->recepcionistas[$i]['nombre'] = $nombre;
      $this->recepcionistas[$i]['nick'] = $nick;
      $this->recepcionistas[$i]['tlf'] = $tlf;
      $this->recepcionistas[$i]['id_estudio'] = $id_estudio;
      $i++;
    }
    $consulta->close();
    return $this->recepcionistas;
  }

}
