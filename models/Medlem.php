<?php

include_once "utils/database.php";
include_once "models/Poststed.php";

class Medlem {

  public function __construct($medlem = [], $fraDatabase = false) {
    $this->medlemsnummer = $medlem["medlemsnummer"];
    $this->fornavn = $medlem["fornavn"];
    $this->etternavn = $medlem["etternavn"];
    $this->adresse = $medlem["adresse"];
    $this->postnummer = $medlem["postnummer"];
    $this->telefonnummer = $medlem["telefonnummer"];
    $this->epost = $medlem["epost"];
    $this->passord = $fraDatabase
      ? $medlem["passord"]
      : hash($medlem["passord"], PASSWORD_BCRYPT);
  }

  private function valider() {

  }

  public static function finn() {

  }

  public function lagre() {

  }

}

?>
