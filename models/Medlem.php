<?php

include_once "utils/database.php";
include_once "models/Poststed.php";

class Medlem {

  public function __construct($mnr, $fnavn, $enavn, $adr, $postnr, $epost, $pw) {
    $this->medlemsnummer = $mnr;
    $this->fornavn = $fnavn;
    $this->etternavn = $enavn;
    $this->adresse = $adr;
    $this->postnummer = $postnr;
    $this->epost = $epost;
    $this->passord = password_hash($pw, PASSWORD_BCRYPT);
  }

  public static function søk() {

  }

  public static function finn() {

  }

  public function lagre() {
    $sql = "INSERT INTO Medlem VALUES (?, ?, ?, ?, ?, ?);";

    $conn = getConnection();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $this->fornavn, $this->etternavn, $this->adresse, $this->postnummer, $this->epost, $this->passord);
    /*$stmt->execute();
    $stmt->close();
    $conn->close();*/
    echo "hey";
  }

}

?>
