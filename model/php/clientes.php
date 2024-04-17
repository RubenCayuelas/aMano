<?php

class Clientes
{
  private $BD;
  private $clientes;

// Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

// Login
  public function login($nick, $pass)
  {
    $consulta = $this->BD->prepare('
          SELECT id, nick, nombre, foto
          from cliente
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
      $datos['foto'] = $datosReseult['foto'];
      $datos['tipo'] = 'C';
    } else {
      $datos['id'] = -1;
    }
    return $datos;
    $consulta->close();
  }

// Listar Clientes
  public function listarClientes()
  {
    $consulta = $this->BD->query('
            SELECT id, nombre, nick, foto, tlf, tlf2
            FROM cliente
            WHERE activo = "1"
              LIMIT 20
    ');
    $this->clientes = null;
    $this->clientes = $consulta->fetch_all(MYSQLI_ASSOC);
    return $this->clientes;
  }

// Buscar cliente
  public function buscarClientes($search)
  {
    $busqueda = $search . '%';
    $consulta = $this->BD->prepare('
                SELECT id, nombre, nick, foto, tlf, tlf2
                FROM cliente 
                WHERE (nombre like ? 
                  OR nick like ? 
                  OR tlf like ? 
                  OR tlf2 like ?)
                    AND activo = "1"
                    AND id != 0
    ');
    $consulta->bind_param('ssss', $busqueda, $busqueda, $busqueda, $busqueda);
    $consulta->bind_result($id, $nombre, $nick, $foto, $tlf1, $tlf2);
    $consulta->execute();
    $i = 0;
    $this->clientes = null;
    while ($consulta->fetch()) {
      $this->clientes[$i]['id'] = $id;
      $this->clientes[$i]['nombre'] = $nombre;
      $this->clientes[$i]['nick'] = $nick;
      $this->clientes[$i]['foto'] = $foto;
      $this->clientes[$i]['tlf'] = $tlf1;
      $this->clientes[$i]['tlf2'] = $tlf2;
      $i++;
    }
    $consulta->close();
    return $this->clientes;
  }

// Obtener datos de cliente
  public function getCliente($id)
  {
    $consulta = $this->BD->prepare('
                SELECT id, nombre, nick, foto, tlf, tlf2
                FROM cliente 
                WHERE id = ?
                    AND activo = "1"
    ');
    $consulta->bind_param('i', $id);
    $consulta->bind_result($id, $nombre, $nick, $foto, $tlf1, $tlf2);
    $consulta->execute();
    $i = 0;
    $this->clientes = null;
    while ($consulta->fetch()) {
      $this->clientes[$i]['id'] = $id;
      $this->clientes[$i]['nombre'] = $nombre;
      $this->clientes[$i]['nick'] = $nick;
      $this->clientes[$i]['foto'] = $foto;
      $this->clientes[$i]['tlf'] = $tlf1;
      $this->clientes[$i]['tlf2'] = $tlf2;
      $i++;
    }
    $consulta->close();
    return $this->clientes;
  }








}
