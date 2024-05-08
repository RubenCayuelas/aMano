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

  // Create a new session for a client
  public function añadirCitaCliente($fecha, $hora, $cliente, $estudio, $fotografo, $servicio)
  {
    if (strtotime($fecha) >= strtotime(date('Y-m-d'))) {
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
    } else {
      return false;
    }
  }

  // Obtain the session solicitudes for that year
  public function getSessionsFor($year)
  {
    // Obtenemos el primer día del año y el último día del año
    $startOfYear = $year . '-01-01';
    $endOfYear = $year . '-12-31';
    $consulta = $this->BD->prepare('SELECT c.id, c.fecha, c.hora, id_cliente, cl.nombre cliente, cl.foto cliente_picture, c.id_fotografo, f.nombre fotografo, c.id_servicio , s.nombre servicio
                                    FROM cita c, cliente cl, fotografo f, servicio s
                                    WHERE c.id_cliente = cl.id
                                      AND c.id_fotografo = f.id
                                      AND c.id_servicio = s.id
                                      AND c.estado = "1"
                                      AND c.id_estudio = ?
                                      AND c.fecha BETWEEN ? AND ?
    ');
    $consulta->bind_param('iss', $_SESSION['id_estudio'], $startOfYear, $endOfYear);
    $consulta->execute();
    $datos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    $consulta->close();
    return $datos;
  }



}
