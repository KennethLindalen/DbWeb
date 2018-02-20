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

  public static function spørring($sql, $verdier) {
    self::kobleTil();
    $stmt = self::$tilkobling->prepare($sql);
    $stmt->bind_param(self::datatyper($verdier), ...$verdier);
    $stmt->execute();

    if ($stmt->affected_rows < 0)
      if ($stmt->errno == 1062)
        throw new Exception(json_encode(["epost" => "E-postadressen er allerede i bruk"]));
      if ($stmt->errno == 1452)
        throw new Exception(json_encode(["postnummer" => "Postnummeret finnes ikke"]));

    self::kobleFra();
  }

  public static function insert($tabell, $verdier) {
    $kolonner = join(", ", array_keys($verdier));
    $params = join(", ", array_map(function($var) { return "?"; }, $verdier));
    $sql = "INSERT INTO $tabell ($kolonner) VALUES ($params)";
    self::spørring($sql, array_values($verdier));
  }

  private static function datatyper($verdier) {
    $datatyper = "";
    foreach ($verdier as $verdi) {
      if (gettype($verdi) == "integer")
        $datatyper .= "i";
      if (gettype($verdi) == "double")
        $datatyper .= "d";
      if (gettype($verdi) == "string")
        $datatyper .= "s";
    }
    return $datatyper;
  }

}

?>
