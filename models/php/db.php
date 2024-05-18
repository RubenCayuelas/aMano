<?php
class BD
{
  public static function connect()
  {
    // Obtener la dirección IP de MySQL desde la variable de entorno
    $host = getenv('MYSQL_HOST') ? getenv('MYSQL_HOST') : 'localhost';

    $BD = new mysqli($host, "root", "", "dbamano"); 
    $BD->set_charset("utf8");
    return $BD;
  }
}