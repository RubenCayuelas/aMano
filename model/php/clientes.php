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
              AND activo = "1"
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
    $this->clientes = null;
    while ($consulta->fetch()) {
      $this->clientes['id'] = $id;
      $this->clientes['nombre'] = $nombre;
      $this->clientes['nick'] = $nick;
      $this->clientes['foto'] = $foto;
      $this->clientes['tlf'] = $tlf1;
      $this->clientes['tlf2'] = $tlf2;
    }
    $consulta->close();
    return $this->clientes;
  }

  // Createa a new client
  public function añadirCliente($nombre, $nick, $password, $tlf1, $tlf2)
  {
    if (trim($nombre) != '' && trim($nick) != '' && trim($tlf1) != '' && trim($password) != '') {
      if (is_numeric($tlf1) && strlen(trim($tlf1)) === 9 && trim($tlf1) > 0) {
        $pass = md5(md5(md5(md5(md5($password)))));
        if (trim($tlf2) != '') {
          if (is_numeric($tlf2) && strlen(trim($tlf2)) === 9 && trim($tlf2) > 0) {
            $consulta = $this->BD->prepare('INSERT INTO cliente VALUES (null,?,?,?,"defaultUser.png",?,?,"1")');
            $consulta->bind_param('sssss', $nombre, $nick, $pass, $tlf1, $tlf2);
            $consulta->execute();
            $consulta->close();
          } else {
            $consulta = false;
          }
        } else {
          $consulta = $this->BD->prepare('INSERT INTO cliente VALUES (null,?,?,?,"defaultUser.png",?,null,"1")');
          $consulta->bind_param('ssss', $nombre, $nick, $pass, $tlf1);
          $consulta->execute();
          $consulta->close();
        }
      } else {
        $consulta = false;
      }
    } else {
      $consulta = false;
    }
    return $consulta;
  }


  // Edit a client
  function editCliente($id, $nombre, $nick, $tlf1, $tlf2)
  {
    if (trim($id) != '' && trim($nombre) != '' && trim($nick) != '' && trim($tlf1) != '') {
      if (is_numeric($tlf1) && strlen(trim($tlf1)) === 9 && trim($tlf1) > 0) {
        if (trim($tlf2) != '') {
          if (is_numeric($tlf2) && strlen(trim($tlf2)) === 9 && trim($tlf2) > 0) {
            $consulta = $this->BD->prepare('UPDATE cliente
                                            SET nombre=?, 
                                                nick=?, 
                                                tlf=?, 
                                                tlf2=?  
                                              WHERE id=?');
            $consulta->bind_param('ssssi', $nombre, $nick, $tlf1, $tlf2, $id);
            $consulta->execute();
            $consulta->close();
          } else {
            $consulta = false;
          }
        } else {
          $consulta = $this->BD->prepare('UPDATE cliente
                                          SET nombre=?, 
                                              nick=?,
                                              tlf=?, 
                                              tlf2=NULL
                                          WHERE id=?');
          $consulta->bind_param('sssi', $nombre, $nick, $tlf1, $id);
          $consulta->execute();
          $consulta->close();
        }
      } else {
        $consulta = false;
      }
    } else {
      $consulta = false;
    }
    return $consulta;
  }

  // Editar contraseña Cliente
  function editClientePass($id, $password)
  {
    if (trim($password) != '') {
      $pass = md5(md5(md5(md5(md5($password)))));
      $consulta = $this->BD->prepare('UPDATE cliente
                                      SET password=?, 
                                      WHERE id=?');
      $consulta->bind_param('si', $pass, $id);
      $consulta->execute();
      $consulta->close();
    } else {
      $consulta = false;
    }
    return $consulta;
  }
  
}
