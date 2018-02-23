<?php

include_once "utils/database.php";

class Medlem {

  public function __construct($medlem = [], $fraDatabase = false) {
    $this->medlemsnummer = $fraDatabase ? $medlem["medlemsnummer"] : null;
    $this->fornavn       = $medlem["fornavn"];
    $this->etternavn     = $medlem["etternavn"];
    $this->adresse       = $medlem["adresse"];
    $this->postnummer    = $medlem["postnummer"];
    $this->poststed      = $fraDatabase ? $medlem["poststed"] : null;
    $this->telefonnummer = $medlem["telefonnummer"];
    $this->epost         = $medlem["epost"];
    $this->passord       = $medlem["passord"];
    $this->passord2      = $fraDatabase ? null : $medlem["passord2"];
    if (!$fraDatabase) $this->valider();
  }

  private function valider() {
    $feil = [];

    if (!preg_match("/^[\pL\s'.-]{1,100}$/", $this->fornavn))
      $feil["fornavn"] = "Ugyldig fornavn";

    if (!preg_match("/^[\pL\s'.-]{1,100}$/", $this->etternavn))
      $feil["etternavn"] = "Ugyldig etternavn";

    if (!preg_match("/^[\pL\s\d'.,-]{1,100}$/", $this->adresse))
      $feil["adresse"] = "Ugyldig adresse";

    if (!preg_match("/^\d{4}$/", $this->postnummer))
      $feil["postnummer"] = "Ugyldig postnummer";

    if (!preg_match("/^\d{8}$/", $this->telefonnummer))
      $feil["telefonnummer"] = "Ugyldig telefonnummer";

    if (!filter_var($this->epost, FILTER_VALIDATE_EMAIL))
      $feil["epost"] = "Ugyldig e-postadresse";

    if (!preg_match("/(?=.*\d)(?=.*[a-zæøå])(?=.*[A-ZÆØÅ]).{8,}/", $this->passord))
      $feil["passord"] = "Passordet må bestå av minst 8 tegn og inneholde både tall, store-, og små bokstaver";

    if ($this->passord !== $this->passord2)
      $feil["passord2"] = "Passordene må være like";

    if (!empty($feil))
      throw new InvalidArgumentException(json_encode($feil));

    $this->passord = password_hash($this->passord, PASSWORD_BCRYPT);
    $this->passord2 = null;
  }

  public function lagre() {
    if ($this->medlemsnummer)
      $this->oppdater();
    else
      $this->settInn();
  }

  private function settInn() {
    $con = new Database();
    $res = $con->insert("medlem", $this->toArray());

    if ($res->affected_rows < 1)
      if ($res->errno == 1062)
        throw new InvalidArgumentException(json_encode(["epost" => "E-postadressen er allerede i bruk"]));
      if ($res->errno == 1452)
        throw new InvalidArgumentException(json_encode(["postnummer" => "Ugyldig postnummer"]));

    $this->medlemsnummer = $res->insert_id;
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

  private function toArray() {
    $array = (array) $this;
    $array = array_filter($array, function($var) { return $var != null; });
    return $array;
  }

}

?>
