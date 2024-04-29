<?php

class Fotografos
{
  private $BD;
  private $fotografos;

// Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

// Login
  public function login($nick, $pass)
  {
    $consulta = $this->BD->prepare('
          SELECT id, nick
          from fotografo
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
      $datos['tipo'] = 'F';
    } else {
      $datos['id'] = -1;
    }
    return $datos;
    $consulta->close();
  }
  
// Listar Fotógrafos
  public function listarFotografos()
  {
    $consulta = $this->BD->query('
            SELECT id, nombre, nick, foto, descripcion, habilidades, id_estudio
            FROM fotografo
            WHERE activo = "1"
    ');
    $this->fotografos = null;
    $this->fotografos = $consulta->fetch_all(MYSQLI_ASSOC);
    return $this->fotografos;
  }

// Listar Fotografos que trabajen en el mismo estudio que el recepcionista que realiza la llamada
 public function listarFotografosRecepcionista()
 {
  return $this->listarFotografos();
 }

// Buscar fotografo
  public function buscarFotografos($search)
  {
    $busqueda = $search . '%';
    $consulta = $this->BD->prepare('
                SELECT id, nombre, nick, foto, descripcion, habilidades, id_estudio
                FROM fotografo 
                WHERE (nombre like ? 
                  OR nick like ?)
                    AND activo = "1"
                    AND id != 0
    ');
    $consulta->bind_param('ss', $busqueda, $busqueda);
    $consulta->bind_result($id, $nombre, $nick, $foto, $descripcion, $habilidades, $id_estudio);
    $consulta->execute();
    $i = 0;
    $this->fotografos = null;
    while ($consulta->fetch()) {
      $this->fotografos[$i]['id'] = $id;
      $this->fotografos[$i]['nombre'] = $nombre;
      $this->fotografos[$i]['nick'] = $nick;
      $this->fotografos[$i]['foto'] = $foto;
      $this->fotografos[$i]['descripcion'] = $descripcion;
      $this->fotografos[$i]['habilidades'] = $habilidades;
      $this->fotografos[$i]['id_estudio'] = $id_estudio;
      $i++;
    }
    $consulta->close();
    return $this->fotografos;
  }

// Obtener datos de fotografo
  public function getFotografo($id)
  {
    $consulta = $this->BD->prepare('
        SELECT id, nombre, nick, foto, descripcion, habilidades, id_estudio
          FROM fotografo 
          WHERE id = ?
    ');
    $consulta->bind_param('i', $id);
    $consulta->bind_result($id, $nombre, $nick, $foto, $descripcion, $habilidades, $id_estudio);
    $consulta->execute();
    $i = 0;
    $this->fotografos = null;
    while ($consulta->fetch()) {
      $this->fotografos[$i]['id'] = $id;
      $this->fotografos[$i]['nombre'] = $nombre;
      $this->fotografos[$i]['nick'] = $nick;
      $this->fotografos[$i]['foto'] = $foto;
      $this->fotografos[$i]['descripcion'] = $descripcion;
      $this->fotografos[$i]['habilidades'] = $habilidades;
      $this->fotografos[$i]['id_estudio'] = $id_estudio;
      $i++;
    }
    $consulta->close();
    return $this->fotografos;
  }




}
