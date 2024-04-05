<?php
class BD
{
  public static function connect()
  {
    $BD = new mysqli("mysql", "root", "", "dbamano");
    // $BD = new mysqli("localhost", "root", "", "dbamano");
    $BD->set_charset("utf8");
    return $BD;
  }
}
