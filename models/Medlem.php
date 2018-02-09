<?php

include_once "utils/database.php";


class Medlem {

  // new Medlem($_POST);
  public function __construct($medlem = [], $fraDatabase = false) {
    $this->medlemsnummer = $medlem["medlemsnummer"];
    $this->fornavn       = $medlem["fornavn"];
    $this->etternavn     = $medlem["etternavn"];
    $this->adresse       = $medlem["adresse"];
    $this->postnummer    = $medlem["postnummer"];
    $this->telefonnummer = $medlem["telefonnummer"];
    $this->epost         = $medlem["epost"];
    $this->passord       = $medlem["passord"];
    $this->passord2      = $medlem["passord2"];
    if (!$fraDatabase) $this->valider();
  }

  private function valider() {
    $feil = [];

    // TODO: validering for fornavn, etternavn og adresse

    if (!preg_match("/^\d{8}$/", $this->telefonnummer))
      $feil["telefonnummer"] = "Ugyldig telefonnummer";

    if (!filter_var($this->epost, FILTER_VALIDATE_EMAIL))
      $feil["epost"] = "Ugyldig e-postadresse";

    if (!preg_match("/(?=.*\d)(?=.*[a-zæøå])(?=.*[A-ZÆØå]).{6,}/", $this->passord))
      $feil["passord"] = "Passordet må bestå av minst 6 tegn, og inneholde både tall, store-, og små bokstaver";

    if ($this->passord !== $this->passord2)
      $feil["passord2"] = "Passordene må være like";

    $this->medlemsnummer = null;
    $this->passord = password_hash($this->passord, PASSWORD_BCRYPT);
  }

  public function lagre() {
    if ($this->medlemsnummer)
      $this->oppdater();
    else
      $this->settInn();
    return $this;
  }

  private function settInn() {
    // insert into medlem med prepared statement eller stored procedure
    // hent medlemsnummer fra databasen (auto-incremented) og lagre i objektet'
    // $this->medlemsnummer = "Medlemsnummer fra databasen";
  }

  private function oppdater() {
    // update medlem set values where medlemsnummer = $this->medlemsnummer
  }

  public static function finn($identifikator) {
    // finn medlem med gitt medlemsnummer eller epost
  }

  public static function finnPassord() {
    // hent hashet passord for innlogging
  }

}

?>
