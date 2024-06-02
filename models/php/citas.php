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

  // Obtain the session requested
  public function getSession($id_cita)
  {
    $consulta = $this->BD->prepare('
          SELECT fecha, hora, id_cliente, id_fotografo, id_servicio
          FROM cita
          WHERE id = ?
      ');
    $consulta->bind_param('i', $id_cita);
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

  // Update the work asigned to the session
  public function sessionAddWork($idCita, $id_work)
  {
    $consulta = $this->BD->prepare('UPDATE cita SET id_trabajo = ? WHERE id = ?');
    $consulta->bind_param('si', $id_work, $idCita);
    $consulta->execute();
    if ($consulta->affected_rows > 0) {
      return true;
    } else {
      return false;
    }
    $consulta->close();
  }

  // Create a new session for a client
  public function añadirCitaCliente($fecha, $hora, $cliente, $estudio, $fotografo, $servicio)
  {
    // Verificar si ya existe una cita para la misma fecha y hora
    $consultaPrevia = $this->BD->prepare('
        SELECT COUNT(*) as count
        FROM cita
        WHERE fecha = ? AND hora = ?
    ');
    $consultaPrevia->bind_param('ss', $fecha, $hora);
    $consultaPrevia->execute();
    $resultado = $consultaPrevia->get_result()->fetch_assoc();
    $consultaPrevia->close();

    // Si ya existe una cita para la misma fecha y hora, retornar falso
    if ($resultado['count'] > 0) {
      return false;
    } elseif (strtotime($fecha) >= strtotime(date('Y-m-d'))) {
      // Si la fecha es válida (mayor o igual a la fecha actual)
      // Insertar la nueva cita
      $consulta = $this->BD->prepare('
            INSERT INTO cita (fecha, hora, id_cliente, id_estudio, id_fotografo, id_servicio)
            VALUES (?, ?, ?, ?, ?, ?)
        ');
      $consulta->bind_param('ssiiii', $fecha, $hora, $cliente, $estudio, $fotografo, $servicio);
      $consulta->execute();

      // Verificar si la consulta fue exitosa
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
    $consulta = $this->BD->prepare('SELECT c.id, c.fecha, c.hora, id_cliente, cl.nombre cliente, cl.foto cliente_picture,
                                           c.id_fotografo, f.nombre fotografo, c.id_servicio , s.nombre servicio
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

  // Obtain all the sessions for a client
  public function getAllSessionsForClient($cliente)
  {
    $consulta = $this->BD->prepare('SELECT c.id, c.fecha, c.hora, id_cliente, cl.nombre cliente, cl.foto cliente_picture,
                                           c.id_fotografo, f.nombre fotografo, c.id_servicio , s.nombre servicio
                                    FROM cita c, cliente cl, fotografo f, servicio s
                                    WHERE c.id_cliente = cl.id
                                      AND c.id_fotografo = f.id
                                      AND c.id_servicio = s.id
                                      AND c.estado = "1"
                                      AND c.id_estudio = ?
    ');
    $consulta->bind_param('i', $cliente);
    $consulta->execute();
    $datos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    $consulta->close();
    return $datos;
  }

  // Sessions that are able to start a Work
  public function getSessionsAbleForCreateWorkFromPhotographer($fotografo)
  {
    $fecha_actual = date('Y-m-d');

    $consulta = $this->BD->prepare('SELECT c.id, c.fecha, c.hora, c.id_cliente, cl.nombre, c.id_servicio, s.nombre
                                    FROM cita c, cliente cl, servicio s
                                    WHERE c.id_cliente = cl.id AND c.id_servicio = s.id
                                      AND c.fecha <= ? 
                                      AND c.estado = "1"
                                      AND c.id_trabajo IS NULL
                                      AND c.id_fotografo = ?
        ');
    $consulta->bind_param('si', $fecha_actual, $fotografo);
    $consulta->bind_result($id, $nombre, $hora, $id_cliente, $cliente, $id_servicio, $servicio);
    $consulta->execute();
    $i = 0;
    $this->citas = null;
    while ($consulta->fetch()) {
      $this->citas[$i]['id'] = $id;
      $this->citas[$i]['nombre'] = $nombre;
      $this->citas[$i]['hora'] = $hora;
      $this->citas[$i]['id_cliente'] = $id_cliente;
      $this->citas[$i]['cliente'] = $cliente;
      $this->citas[$i]['id_servicio'] = $id_servicio;
      $this->citas[$i]['servicio'] = $servicio;
      $i++;
    }
    $consulta->close();
    return $this->citas;
  }
}
