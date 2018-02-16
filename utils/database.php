<?php

class Database {

  private static $hostname = "itfag.usn.no";
  private static $username = "v18u130";
  private static $password = "Pw130";
  private static $database = "v18db130";
  private static $tilkobling;

  private static function kobleTil() {
    self::$tilkobling = mysqli_connect(
      self::$hostname,
      self::$username,
      self::$password,
      self::$database
    );
    self::$tilkobling->set_charset("utf8");
  }

  private static function kobleFra() {
    self::$tilkobling->close();
  }

  public static function spørring() {
    self::kobleTil();
    self::kobleFra();
  }

  public static function insert($tabell, $verdier) {
    $kolonner = array_keys($verdier);
    $verdier = array_values($verdier);

    var_dump($tabell);
    var_dump($kolonner);
    var_dump($verdier);
  }

}

?>
