<?php

// Includes
include_once "utils/database.php";
include_once "models/Medlem.php";

// Klasse som representerer klubbens nyhetsartikler.
class Artikkel {

  // Artikkelobjekter opprettes direkte fra $_POST ved registrering, eller fra
  // et assosiativt array som hentes fra eksisterende oppføringer i databasen.
  public function __construct($artikkel = [], $fraDatabase = false) {
    $this->artikkelkode  = $fraDatabase ? $artikkel["artikkelkode"] : null;
    $this->tittel        = $artikkel["tittel"];
    $this->undertittel   = $artikkel["undertittel"];
    $this->innhold       = $artikkel["innhold"];
    $this->bildeUrl      = $artikkel["bildeUrl"];
    $this->medlemsnummer = $artikkel["medlemsnummer"];
  }

  // Metode for validering av felter.
  // Utføres kun når artikkelobjektet konstrueres fra $_POST ved registrering,
  // altså stoler vi på dataene dersom de kommer direkte fra databasen.
  private function valider() {
    $feil = [];

    // Tittel består av 1-100 tegn.
    if (!preg_match("/^.{1,100}$/", $this->tittel))
      $feil["tittel"] = "Tittel må være mellom 1 og 100 tegn lang.";

    // Undertittel består av 1-100 tegn.
    if (!preg_match("/^.{1,100}$/", $this->undertittel))
      $feil["undertittel"] = "Undertittel må være mellom 1 og 100 tegn lang.";

    // Innholdet består av 1-500 tegn.
    if (!preg_match("/^.{1,500}$/s", $this->innhold))
      $feil["innhold"] = "Innhold må være mellom 1 og 100 tegn langt.";

    // Bilde-URL består av 1-100 tegn.
    if (!preg_match("/^.{1,100}$/", $this->bildeUrl))
      $feil["bildeUrl"] = "URL må være mellom 1 og 100 tegn lang.";

    // Dersom noen av valideringene feilet, kast unntak og send med forklaringer.
    if (!empty($feil))
      throw new InvalidArgumentException(json_encode($feil));
  }


  // Metode for å lagre et anleggsobjekt til databasen.
  // UPDATE-spørring dersom artikkelkoden finnes, INSERT-spørring ellers.
  public function lagre() {
    $this->valider();
    if ($this->artikkelkode)
      $this->oppdater();
    else
      $this->settInn();
  }


  // Metode for innsetting av nye artikler.
  private function settInn() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      INSERT INTO artikkel (tittel, undertittel, innhold, bildeUrl, medlemsnummer)
      VALUES (?, ?, ?, ?, ?);
    ";

    // Verdier som skal settes inn.
    $verdier = [
      $this->tittel,
      $this->undertittel,
      $this->innhold,
      $this->bildeUrl,
      $this->medlemsnummer
    ];

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $res = $con->spørring($sql, $verdier);

    // Henter artikkelkode fra nyinnsatt rad.
    $this->artikkelkode = $res->insert_id;
  }


  // Metode for oppdatering av eksisterende idretter.
  private function oppdater() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      UPDATE artikkel
      SET
        tittel = ?,
        undertittel = ?,
        innhold = ?,
        bildeUrl = ?
      WHERE
        artikkelkode = ?;
    ";

    // Verdier som skal settes inn.
    $verdier = [
      $this->tittel,
      $this->undertittel,
      $this->innhold,
      $this->bildeUrl,
      $this->artikkelkode
    ];

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $con->spørring($sql, $verdier);
  }


  // Statisk metode for sletting av anlegg fra databasen.
  public static function slett($artikkelkode) {

    // Kaller på en lagret prosedyre. Bruker prepared statement.
    $sql = "
      CALL slett_artikkel(?);
    ";

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $con->spørring($sql, [$artikkelkode]);
  }


  // Metode for å slette en artikkel fra databasen.
  public function slettDenne() {
    self::slett($this->artikkelkode);
  }


  // Statisk metode for å finne en artikkel gitt ved sin artikkelkode.
  public static function finn($artikkelkode) {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      SELECT
        artikkelkode,
        tittel,
        undertittel,
        innhold,
        bildeUrl,
        medlemsnummer
      FROM artikkel
      WHERE artikkelkode = ?;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql, [$artikkelkode])
      ->get_result()
      ->fetch_assoc();

    // Oppretter et artikkelobjekt og returnerer dette.
    return new Artikkel($res, true);
  }


  // Statisk metode for å liste opp alle artikler.
  // Tar parametre som avgjør hvor mange artikler som skal
  // hentes, og hvor mange som skal hoppes over fra starten.
  public static function finnAlle($antall = 6, $offset = 0) {

    // SQL-spørring for uthenting av alle anlegg.
    // Sorteres etter artikkelkode synkende, altså de nyeste først.
    $sql = "
      SELECT
        artikkelkode,
        tittel,
        undertittel,
        innhold,
        bildeUrl,
        medlemsnummer
      FROM artikkel
      ORDER BY artikkelkode DESC
      LIMIT ?
      OFFSET ?;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql, [$antall, $offset])
      ->get_result()
      ->fetch_all(MYSQLI_ASSOC);

    // Returnerer et array av artikkelobjekter.
    return array_map(function($rad) {
      return new Artikkel($rad, true);
    }, $res);
  }


  // Returnerer et medlemsobjekt som tilsvarer artikkelens forfatter.
  public function getMedlem() {
    return Medlem::finn($this->medlemsnummer);
  }

}


?>
