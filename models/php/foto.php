<?php

class Foto
{
  private $BD;
  private $foto;

  // Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

  // Get all the data from a Picture
  public function getPicture($id)
  {
    $consulta = $this->BD->prepare("SELECT * FROM foto WHERE id = ?");
    $consulta->bind_param('i', $id);
    $consulta->execute();
    $resultado = $consulta->get_result()->fetch_assoc();
    return $resultado;
  }

  // Obtain the Pictures for a work
  public function getPreviewForTrabajo($id_trabajo)
  {
    $consulta = $this->BD->prepare('
        SELECT id, foto
        FROM foto
        WHERE id_trabajo = ?
          AND preview = "1"
    ');
    $consulta->bind_param('i', $id_trabajo);
    $consulta->execute();
    $preview = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    $consulta->close();
    return $preview;
  }

  // Obtain all the pictures for a work
  public function getPicturesForTrabajo($id_trabajo)
  {
    $consulta = $this->BD->prepare('
        SELECT id, foto, preview
        FROM foto
        WHERE id_trabajo = ?
    ');
    $consulta->bind_param('i', $id_trabajo);
    $consulta->bind_result($id, $foto, $preview);
    $consulta->execute();
    $i = 0;
    $this->foto = null;
    while ($consulta->fetch()) {
      $this->foto[$i]['id'] = $id;
      $this->foto[$i]['foto'] = $foto;
      $this->foto[$i]['preview'] = $preview;
      $i++;
    }
    $consulta->close();
    return $this->foto;
  }

  // Save the pictures uploaded for a work
  public function savePictures($id_trabajo, $fotos, $nick_usuario, $nombre_trabajo)
  {
    // Return if fotos is empty
    if (empty($fotos['name'][0])) {
      return false;
    }

    foreach ($fotos['name'] as $index => $nombreOriginal) {
      if ($fotos['error'][$index] === UPLOAD_ERR_OK) {
        // Verify if the file is a image
        if (getimagesize($fotos['tmp_name'][$index]) !== false) {
          // Get the file extension
          $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);

          // Obtain the next id for the picture
          $consulta = $this->BD->prepare("SHOW TABLE STATUS LIKE 'foto'");
          $consulta->execute();
          $resultado = $consulta->get_result();
          $row = $resultado->fetch_assoc();
          $nextId = $row['Auto_increment'];
          $consulta->close();

          // Create the name of the image and the route
          $nombreImagen = $nombre_trabajo . '_' . $id_trabajo . '_' . $nextId . '.' . $extension;
          $rutaImagen = "../../../assets/img/trabajos/$nick_usuario/$nombre_trabajo/$nombreImagen";

          // Create the directory if it doesn't exist
          if (!file_exists("../../../assets/img/trabajos/$nick_usuario/$nombre_trabajo")) {
            mkdir("../../../assets/img/trabajos/$nick_usuario/$nombre_trabajo", 0777, true);
          }

          // Save the image into the specified directory
          if (move_uploaded_file($fotos['tmp_name'][$index], $rutaImagen)) {
            // Insert the new image into the database
            $consulta = $this->BD->prepare("INSERT INTO foto (id_trabajo, foto) VALUES (?, ?)");
            $consulta->bind_param('is', $id_trabajo, $nombreImagen);
            $consulta->execute();
            $consulta->close();
          } else {
            return false; // If the image cannot be moved
          }
        } else {
          return false; // If the file is not an image
        }
      } else {
        return false; // If there is an upload error
      }
    }

    return true;
  }

  // Delete a picture
  public function deletePicture($id_foto, $nick_usuario, $nombre_trabajo)
  {
    $foto = $this->getPicture($id_foto);

    $nombreArchivo = $foto['foto'];
    $rutaArchivo = "../../../assets/img/trabajos/$nick_usuario/$nombre_trabajo/$nombreArchivo";

    // Delete the picture file if it exists
    if (file_exists($rutaArchivo)) {
      unlink($rutaArchivo);
    }

    // Delete the record from the database
    $consulta = $this->BD->prepare("DELETE FROM foto WHERE id = ?");
    $consulta->bind_param('i', $id_foto);
    $consulta->execute();
    $consulta->close();
  }

  // Set preview image for a job
  public function setPreview($id_foto, $id_trabajo)
  {
    $this->setAllPreviewTo0($id_trabajo);

    $consulta = $this->BD->prepare('UPDATE foto SET preview = "1" WHERE id = ?');
    $consulta->bind_param('i', $id_foto);
    $consulta->execute();
    $consulta->close();
  }
  
  // Discard the preview image for a job
  private function setAllPreviewTo0($id_trabajo)
  {
    $consulta = $this->BD->prepare('UPDATE foto SET preview = "0" WHERE id_trabajo = ? AND preview = "1"');
    $consulta->bind_param('i', $id_trabajo);
    $consulta->execute();
    $consulta->close();
  }

}
