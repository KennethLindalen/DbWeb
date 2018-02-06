<?php

include_once "utils/database.php";


class Medlem {

  public function __construct($medlem = [], $fraDatabase = false) {
    $this->medlemsnummer = $medlem["medlemsnummer"];
    $this->fornavn       = $medlem["fornavn"];
    $this->etternavn     = $medlem["etternavn"];
    $this->adresse       = $medlem["adresse"];
    $this->postnummer    = $medlem["postnummer"];
    $this->telefonnummer = $medlem["telefonnummer"];
    $this->epost         = $medlem["epost"];
    $this->passord       = $medlem["passord"];
    if (!$fraDatabase) $this->valider();
  }

  private function valider() {
    // kast unntak ved feil
    $this->passord = password_hash($this->passord, PASSWORD_BCRYPT);
  }

  public function lagre() {
    // insert into medlem med prepared statement eller stored procedure
    // hent medlemsnummer fra databasen (auto-incremented) og lagre i objektet'
    // $this->medlemsnummer = "Medlemsnummer fra databasen";
  }

  public static function finn() {
    // finn medlem med gitt medlemsnummer eller epost
  }

  public static function finnPassord() {
    // hent hashet passord for innlogging
  }

}

?>
