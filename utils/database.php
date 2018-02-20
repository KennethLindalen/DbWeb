<?php

mysqli_report(MYSQLI_REPORT_STRICT);

class Database extends mysqli {

  private $hostname = "itfag.usn.no";
  private $username = "v18u130";
  private $password = "Pw130";
  private $database = "v18db130";

  public function __construct() {
    parent::__construct(
      $this->hostname,
      $this->username,
      $this->password,
      $this->database
    );
  }

  public function __destruct() {
    $this->close();
  }

  public function insert($tabell, $data) {
    $kolonner = join(", ", array_keys($data));
    $verdier = array_values($data);
    $parametre = join(", ", array_fill(0, count($data), "?"));
    $datatyper = self::datatyper($verdier);

    $stmt = $this->prepare("INSERT INTO $tabell ($kolonner) VALUES ($parametre)");
    $stmt->bind_param($datatyper, ...$verdier);
    $stmt->execute();
    return $stmt;
  }

  public static function datatyper($verdier) {
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
