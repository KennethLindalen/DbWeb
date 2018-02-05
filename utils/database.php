<?php

class Database {

  private $database;

  public function __construct() {
    $this->database = mysqli_connect("localhost", "v18u130", "Pw130", "v18db130");
  }

  public function disconnect() {
    var_dump($this->database);
    echo "<br>";
    $this->database->close();
    var_dump($this->database);
  }

  public function getRow() {

  }

  public function getRows() {

  }

  public function insertRow() {

  }

  public function updateRow() {

  }

  public function deleteRow() {

  }

}

?>
