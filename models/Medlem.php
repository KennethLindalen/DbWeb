<?php

include_once(dirname(__FILE__) . "/Poststed.php");

class Medlem {

  public function __construct($mnr, $fnavn, $enavn, $adr, $postnr, $epost, $pw) {
    $this->medlemsnummer = $mnr;
    $this->fornavn = $fnavn;
    $this->etternavn = $enavn;
    $this->adresse = $adr;
    $this->postnummer = $postnr;
    $this->poststed = Poststed::fraPostnummer($postnr);
    $this->epost = $epost;
    $this->passord = password_hash($pw, PASSWORD_BCRYPT);
  }

  public static function søk() {

  }

  public static function finn() {

  }

  public function lagre() {
    var_dump($this);
  }

}

?>
