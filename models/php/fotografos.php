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
          SELECT id, nick, nombre
          from fotografo
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
    $consulta = $this->BD->prepare('SELECT id, nombre, nick, foto, descripcion, habilidades, id_estudio
                                    FROM fotografo
                                    WHERE activo = "1"
                                      AND id_estudio = ? ');
    $consulta->bind_param('i', $_SESSION['id_estudio']);
    $consulta->execute();
    $this->fotografos = null;
    $this->fotografos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    $consulta->close();
    return $this->fotografos;
  }

  // Listar Fotografos que trabajen en el estudio indicado
  public function listarFotografosDelEstudio($id_estudio)
  {
    $consulta = $this->BD->prepare('SELECT id, nombre, nick, foto, descripcion, habilidades, id_estudio
                                    FROM fotografo
                                    WHERE activo = "1"
                                      AND id_estudio = ? ');
    $consulta->bind_param('i', $id_estudio);
    $consulta->execute();
    $this->fotografos = null;
    $this->fotografos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    $consulta->close();
    return $this->fotografos;
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

  // Edit a photographer
  public function editFotografo($id, $nombre, $nick, $habilidades, $descripcion)
  {
    if (trim($id) != '' && trim($nombre) != '' && trim($nick) != '' && trim($habilidades) != '') {
      // Verificar si el nick es único
      $consultaNick = $this->BD->prepare('SELECT id FROM fotografo WHERE nick = ? AND id != ?');
      $consultaNick->bind_param('si', $nick, $id);
      $consultaNick->execute();
      $resultadoNick = $consultaNick->get_result();
      if ($resultadoNick->num_rows > 0) {
        $consultaNick->close();
        return false;
      }
      $consultaNick->close();

      $consulta = $this->BD->prepare('UPDATE fotografo
                                      SET nombre=?, 
                                          nick=?, 
                                          habilidades=?, 
                                          descripcion=?  
                                      WHERE id=?');
      $consulta->bind_param('ssssi', $nombre, $nick, $habilidades, $descripcion, $id);
      $consulta->execute();
      $consulta->close();
      return true;
    } else {
      return false;
    }
  }

  // Edit password of a photographer
  public function editPassForPhotographer($id, $password)
  {
    if (trim($password) != '') {
      $pass = md5(md5(md5(md5(md5($password)))));
      $consulta = $this->BD->prepare('UPDATE fotografo
                                      SET pass=?
                                      WHERE id=?');
      $consulta->bind_param('si', $pass, $id);
      $consulta->execute();
      $consulta->close();
    } else {
      $consulta = false;
    }
    return $consulta;
  }

  // Change the profile picture of a phothograp
  public function changePictureForPhotograph($fotografo, $picture, $actualPicture)
  {
    if ($picture['error'] === UPLOAD_ERR_OK) {
      $extension = pathinfo($picture['name'], PATHINFO_EXTENSION);
      $isImg = getimagesize($picture['tmp_name']);
      if ($isImg !== false) {

        if ($actualPicture != 'defaultUser.png') {
          unlink("../../../assets/img/usersPictures/$actualPicture");
        }
        
        $nombreImagen = 'photograph_profilePicture_' . $fotografo . '.' . $extension;
        $rutaImagen = "../../../assets/img/usersPictures/$nombreImagen";
        move_uploaded_file($picture['tmp_name'], $rutaImagen);

        $consulta = $this->BD->prepare("UPDATE fotografo SET foto = ? WHERE id = ?");
        $consulta->bind_param('si', $nombreImagen, $fotografo);
        $consulta->execute();
        $consulta->close();

        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  // Delete the profile picture of a client
  public function elimPictureForPhotograph($cliente, $actualPicture)
  {
    $consulta = $this->BD->prepare('UPDATE fotografo
                                      SET foto = "defaultUser.png"
                                      WHERE id = ?');
    $consulta->bind_param('i', $cliente);
    $consulta->execute();
    $consulta->close();
    if (!$actualPicture == 'defaultUser.png') {
      unlink("../../../assets/img/usersPictures/$actualPicture");
    }
    return $consulta;
  }
}
