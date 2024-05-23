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
}
