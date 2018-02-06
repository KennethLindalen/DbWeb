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

  private function valider($medlem) {
    // hvis gyldig, krypter passord
    // hvis ugyldig, kast unntak
    $this->passord = password_hash($this->passord, PASSWORD_BCRYPT);
  }

  public function lagre() {
    // insert into medlem med prepared statement eller stored procedure
  }

  public static function finn() {
    // finn medlem med gitt medlemsnummer eller epost
  }

  public static function finnPassord() {
    // hent hashet passord for innlogging
  }

}

?>
