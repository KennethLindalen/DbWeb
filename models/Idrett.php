<?php

// Includes
include_once "utils/database.php";

// Klasse som representerer de ulike idrettene klubben driver med.
class Idrett {

  // Idrettsobjekter opprettes direkte fra $_POST ved registrering, eller fra
  // et assosiativt array som hentes fra eksisterende oppføringer i databasen.
  // Ulike objektvariabler benyttes basert på hvor dataene kommer fra.
  public function __construct($idrett = [], $fraDatabase = false) {
    $this->idrettskode = $fraDatabase ? $idrett["idrettskode"] : null;
    $this->navn        = $idrett["navn"];
    if (!$fraDatabase) $this->valider();
  }

  // Metode for validering av felter.
  // Utføres kun når medlemsobjektet konstrueres fra $_POST ved registrering,
  // altså stoler vi på dataene dersom de kommer direkte fra databasen.
  private function valider() {
    $feil = [];

    // Idrettsnavn kan bestå av bokstaver, tall, bindestrek, apostrof, komma og punktum. Maks 100 tegn.
    if (!preg_match("/^[\pL\s\d'.,-]{1,100}$/u", $this->navn))
      $feil["navn"] = "Ugyldig idrettsnavn.";

    // Dersom noen av valideringene feilet, kast unntak og send med forklaringer.
    if (!empty($feil))
      throw new InvalidArgumentException(json_encode($feil));
  }


  // Metode for å lagre et idrettsobjekt til databasen.
  // UPDATE-spørring dersom idrettskode finnes, INSERT-spørring ellers.
  public function lagre() {
    if ($this->idrettskode)
      $this->oppdater();
    else
      $this->settInn();
  }


  // Metode for innsetting av nye medlemmer.
  private function settInn() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "INSERT INTO idrett (navn) VALUES (?);";

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $res = $con->spørring($sql, [$this->navn]);

    // Henter idrettskode fra nyinnsatt rad.
    $this->idrettskode = $res->insert_id;
  }


  // Metode for oppdatering av eksisterende idretter.
  private function oppdater() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      UPDATE idrett
      SET navn = ?
      WHERE idrettskode = ?;
    ";

    // verdier som skal settes inn.
    $verdier = [$this->navn, $this->idrettskode];

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $res = $con->spørring($sql, $verdier);
  }


  // Statisk metode for å finne en idrett gitt ved sin idrettskode.
  public static function finn($idrettskode) {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      SELECT idrettskode, navn
      FROM idrett
      WHERE idrettskode = ?;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql, [$idrettskode])
      ->get_result()
      ->fetch_assoc();

    // Returnerer et nytt idrettsobjekt.
    return new Idrett($res, true);
  }


  // Statisk metode for å liste opp alle idretter.
  public static function finnAlle() {

    // SQL-spørring for uthenting av alle idretter.
    $sql = "
      SELECT idrettskode, navn
      FROM idrett;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql)
      ->get_result()
      ->fetch_all(MYSQLI_ASSOC);

    // Funksjon som omgjør databaseresultater til idrettsobjekter.
    // Brukes i PHP-funksjonen "array_map" på hvert element i $res-arrayet.
    function arrayTilObjekt($rad) {
      return new Idrett($rad, true);
    }

    // Returnerer et array av idrettsobjekter.
    return array_map("arrayTilObjekt", $res);
  }

}

?>
