<?php

include_once "utils/database.php";
include_once "models/Poststed.php";

class Medlem {

  public function __construct($medlem) {
    $this->medlemsnummer = $medlem["medlemsnummer"];
    $this->fornavn = $medlem["fornavn"];
    $this->etternavn = $medlem["etternavn"];
    $this->adresse = $medlem["adresse"];
    $this->postnummer = $medlem["postnummer"];
    $this->telefonnummer = $medlem["telefonnummer"];
    $this->epost = $medlem["epost"];
    $this->passord = $medlem["passord"];
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
    $stmt->execute();
    var_dump($conn);
    $stmt->close();
    $conn->close();
  }

}

?>
