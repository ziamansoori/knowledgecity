<?php
namespace Src;

class Database {

  private $dbConnection = null;

  public function __construct()
  {
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $db   = $_ENV['DB_DATABASE'];
    $user = $_ENV['DB_USERNAME'];
    $pass = $_ENV['DB_PASSWORD'];

      $mysqli = mysqli_connect($host, $user, $pass, $db, $port);
      if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
      }

      $this->dbConnection = $mysqli;
  }

  public function connet()
  {
    return $this->dbConnection;
  }
}