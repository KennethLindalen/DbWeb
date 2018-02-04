<?php

include_once "utils/database.php";
include_once "models/Poststed.php";

class Medlem {

  public function __construct($mnr, $fnavn, $enavn, $adr, $postnr, $tlf, $epost, $pw) {
    $this->medlemsnummer = $mnr;
    $this->fornavn = $fnavn;
    $this->etternavn = $enavn;
    $this->adresse = $adr;
    $this->postnummer = $postnr;
    $this->telefonnummer = $tlf;
    $this->epost = $epost;
    $this->passord = password_hash($pw, PASSWORD_BCRYPT);
  }

  public static function søk() {

  }

  public static function finn() {

  }

  public function lagre() {
    $sql = "INSERT INTO Medlem (`Fornavn`, `Etternavn`, `Adresse`, `Postnummer`, `Telefonnummer`, `E-postadresse`, `Passord`) "
         . "VALUES (?, ?, ?, ?, ?, ?, ?)";
    $conn = getConnection();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $this->fornavn, $this->etternavn, $this->adresse, $this->postnummer, $this->telefonnummer, $this->epost, $this->passord);
    $stmt->bind_result($res);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo $res;
  }

}

?>
