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
    $consulta->bind_result($id, $foto);
    $consulta->execute();
    $preview = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    $consulta->close();
    return $preview;
  }

}
