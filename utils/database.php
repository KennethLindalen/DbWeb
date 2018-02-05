<?php

class Database {

  private $database;

  public function __construct() {
    $this->database = mysqli_connect("localhost", "v18u1630", "Pw130", "v18db130");
    var_dump($this->database);
  }

  public function disconnect() {
    $this->database->close();
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
