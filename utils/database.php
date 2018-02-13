<?php

class Database {

  private $hostname = "localhost";
  private $username = "v18u130";
  private $password = "Pw130";
  private $database = "v18db130";
  private $tilkobling = null;

  private function kobleTil() {
    $this->tilkobling = mysqli_connect($hostname, $username, $password, $database);
  }

  private function kobleFra() {
    $this->tilkobling->close();
  }

  public function spørring() {
    $this->kobleTil();

    $this->kobleFra();
  }

}

?>
