<?php

// mysqli skal kaste unntak ved hver feil som oppstår.
mysqli_report(MYSQLI_REPORT_ALL);

// Databaseklasse for tilkobling til database og utførelse av spørringer.
class Database extends mysqli {

  // Innloggingsdetaljer for databasen.
  private $hostname = "itfag.usn.no";
  private $username = "v18u130";
  private $password = "Pw130";
  private $database = "v18db130";

  // Konstruktørmetode - bruker konstruktøren til superklassen (mysqli).
  public function __construct() {
    parent::__construct(
      $this->hostname,
      $this->username,
      $this->password,
      $this->database
    );
  }

  // Destruktørmetode - stenger tilkoblingen når objektet ikke lenger refereres til.
  public function __destruct() {
    $this->close();
  }

  // Metode for utførelse av spørringer.
  // Gjøres ved hjelp av prepared statements for å unngå SQL-injection.
  public function spørring($sql, $verdier) {
    $stmt = $this->prepare($sql);
    $stmt->bind_param(self::datatyper($verdier), ...$verdier);
    $stmt->execute();
    return $stmt;
  }

  // Metode som tar en liste av verdier og returnerer en tekststreng
  // basert på verdienes datatyper. Til bruk i bind_param-metoden.
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
