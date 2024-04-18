<?php

class Citas
{
  private $BD;
  private $citas;

// Constructor
  public function __construct()
  {
    $this->BD = BD::connect();
  }

// Obtain the session solicitudes
  public function getSessionSolicitudes()
  {
    $consulta = $this->BD->prepare('
        SELECT id, fecha, hora, id_cliente, id_estudio, id_fotografo
        FROM cita
        WHERE estado IS NULL
          AND id_estudio = (SELECT id_estudio 
                              FROM recepcionista
                              WHERE id = ?)
    ');
    $consulta->bind_param('i', $_SESSION['id']);
    $consulta->execute();
    $datos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    $consulta->close();
    return $datos;
  }


// Obtain the session solicitudes for that year


// Create a new session for some client


// 





}
