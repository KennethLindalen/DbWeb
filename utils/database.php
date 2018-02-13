<?php

class Database {

  private static $hostname = "localhost";
  private static $username = "v18u130";
  private static $password = "Pw130";
  private static $database = "v18db130";
  private static $tilkobling = null;

  private static function kobleTil() {
    self::$tilkobling = mysqli_connect($hostname, $username, $password, $database);
  }

  private static function kobleFra() {
    self::$tilkobling->close();
  }

  public static function spørring() {
    self::kobleTil();
    var_dump(self::$tilkobling);
    self::kobleFra();
  }

}

Database::spørring();

?>
