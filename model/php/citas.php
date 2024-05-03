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
        SELECT id, fecha, hora, id_cliente, id_fotografo, id_servicio
        FROM cita
        WHERE estado IS NULL
          AND id_estudio = ?
    ');
    $consulta->bind_param('i', $_SESSION['id_estudio']);
    $consulta->execute();
    $datos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    $consulta->close();
    return $datos;
  }

  // Calcel past session solicitudes
  public function closePastsSessions($solicitudes)
  {
    $sessions = [];
    foreach ($solicitudes as $solicitud) {
      if ($solicitud['fecha'] < date('Y-m-d')) {
        $this->sessionStatusUpdate($solicitud['id'], '0');
      } else {
        $sessions[] = $solicitud;
      }
    }
    return $sessions;
  }

  // Update the status of the session
  public function sessionStatusUpdate($idCita, $nuevoEstado)
  {
    $consulta = $this->BD->prepare('UPDATE cita SET estado = ? WHERE id = ?');
    $consulta->bind_param('si', $nuevoEstado, $idCita);
    $consulta->execute();
    $consulta->close();
  }


  // Obtain the session solicitudes for that year


  // Create a new session for some client



  // Crear cita desde el cliente
  public function añadirCitaCliente($fecha, $hora, $cliente, $estudio, $fotografo, $servicio)
  {
    $consulta = $this->BD->prepare('
        INSERT INTO cita (fecha, hora, id_cliente, id_estudio, id_fotografo, id_servicio)
        VALUES (?, ?, ?, ?, ?, ?)
    ');
    $consulta->bind_param('ssiiii', $fecha, $hora, $cliente, $estudio, $fotografo, $servicio);
    $consulta->execute();
    
    // Verificamos si la consulta fue exitosa
    if ($consulta->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
  }
}
