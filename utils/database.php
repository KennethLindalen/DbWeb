<?php

class Database {

  private static $hostname = "localhost";
  private static $username = "v18u130";
  private static $password = "Pw130";
  private static $database = "v18db130";
  private static $tilkobling;

  private static function kobleTil() {
    self::$tilkobling = mysqli_connect(
      self::$hostname, self::$username, self::$password, self::$database
    );
  }

  private static function kobleFra() {
    self::$tilkobling->close();
  }

  public static function spørring() {
    self::$kobleTil();
    var_dump(self::$tilkobling);
    self::$kobleFra();
  }

}

?>
