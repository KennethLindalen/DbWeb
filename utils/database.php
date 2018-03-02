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

  public function spørring($sql, $verdier) {
    $stmt = $this->prepare($sql);
    $stmt->bind_param(self::datatyper($verdier), ...$verdier);
    $stmt->execute();
    return $stmt;
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
