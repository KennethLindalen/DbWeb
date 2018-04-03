<?php

// Includes
include_once "utils/database.php";
include_once "models/Idrett.php";
include_once "utils/cache.php";

// Klasse som representerer ulike idrettsanlegg tilknyttet klubbens idretter.
class Anlegg {

  // Anleggsobjekter opprettes direkte fra $_POST ved registrering, eller fra
  // et assosiativt array som hentes fra eksisterende oppføringer i databasen.
  // Ulike objektvariabler benyttes basert på hvor dataene kommer fra.
  public function __construct($anlegg = [], $fraDatabase = false) {
    $this->anleggskode = $fraDatabase ? $anlegg["anleggskode"] : null;
    $this->idrettskode = $anlegg["idrettskode"];
    $this->navn        = $anlegg["navn"];
    $this->åpningstid  = $anlegg["åpningstid"];
    $this->stengetid   = $anlegg["stengetid"];
    $this->timepris    = $anlegg["timepris"];
  }

  // Metode for validering av felter.
  // Utføres kun når anleggsobjektet konstrueres fra $_POST ved registrering,
  // altså stoler vi på dataene dersom de kommer direkte fra databasen.
  private function valider() {
    $feil = [];

    // Idrettskode må bestå av et positivt heltall.
    if (!preg_match("/^\d+$/", $this->idrettskode) || $this->idrettskode < 0)
      $feil["idrettskode"] = "Idrettskode må være et positivt heltall.";

    // Anleggsnavn kan bestå av bokstaver, tall, bindestrek, apostrof, komma og punktum. Maks 100 tegn.
    if (!preg_match("/^[\wæøåÆØÅ '.,-]{1,100}$/i", $this->navn))
      $feil["navn"] = "Ugyldig idrettsnavn.";

    // Åpningstid må bestå av et positivt heltall mellom 0 og 23 (tilsvarer time).
    if (!preg_match("/^\d{1,2}$/", $this->åpningstid) || $this->åpningstid < 0 || $this->åpningstid > 23)
      $feil["åpningstid"] = "Åpningstid må være et heltall mellom 0 og 23.";

    // Stengetid må bestå av et positivt heltall mellom 0 og 23 (tilsvarer time).
    if (!preg_match("/^\d{1,2}$/", $this->stengetid) || $this->stengetid < 0 || $this->stengetid > 23)
      $feil["stengetid"] = "Stengetid må være mellom 0 og 23.";

    // Anleggets åpningstid må være tidligere på dagen enn anleggets stengetid.
    if (!isset($feil["åpningstid"]) && !isset($feil["stengetid"]) && $this->stengetid < $this->åpningstid)
      $feil["åpningstid"] = "Anlegget kan ikke stenge før det åpner.";

    // Timepris må bestå av et positivt heltall.
    if (!preg_match("/^\d+$/", $this->timepris) || $this->timepris < 0)
      $feil["timepris"] = "Timepris må være et positivt heltall.";

    // Dersom noen av valideringene feilet, kast unntak og send med forklaringer.
    if (!empty($feil))
      throw new InvalidArgumentException(json_encode($feil));
  }


  // Metode for å lagre et anleggsobjekt til databasen.
  public function lagre() {

    // UPDATE-spørring dersom medlemsnummer finnes, INSERT-spørring ellers.
    try {
      $this->valider();

      if ($this->anleggskode)
        $this->oppdater();
      else
        $this->settInn();
    }

    // Feilkode 1062 - brudd på UNIQUE i databasen - anleggsnavnet eksisterer.
    // Feilkode 1452 - brudd på fremmednøkkelkrav i databasen - idretten finnes ikke.
    // Kaster unntaket videre dersom det ikke er relatert til validering.
    catch (mysqli_sql_exception $e) {
      if ($e->getCode() == 1062)
        throw new InvalidArgumentException(json_encode(["navn" => "Et anlegg med dette navnet finnes allerede."]));
      if ($e->getCode() == 1452)
        throw new InvalidArgumentException(json_encode(["idrettskode" => "Idretten finnes ikke."]));
      throw $e;
    }
  }


  // Metode for innsetting av nye idrettsanlegg.
  private function settInn() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      INSERT INTO anlegg (idrettskode, navn, åpningstid, stengetid, timepris)
      VALUES (?, ?, ?, ?, ?);
    ";

    // Verdier som skal settes inn.
    $verdier = [
      $this->idrettskode,
      $this->navn,
      $this->åpningstid,
      $this->stengetid,
      $this->timepris
    ];

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $res = $con->spørring($sql, $verdier);

    // Henter idrettskode fra nyinnsatt rad.
    $this->anleggskode = $res->insert_id;
  }


  // Metode for oppdatering av eksisterende idretter.
  private function oppdater() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      UPDATE anlegg
      SET
        idrettskode = ?,
        navn = ?,
        åpningstid = ?,
        stengetid = ?,
        timepris = ?
      WHERE
        anleggskode = ?;
    ";

    // Verdier som skal settes inn.
    $verdier = [
      $this->idrettskode,
      $this->navn,
      $this->åpningstid,
      $this->stengetid,
      $this->timepris,
      $this->anleggskode
    ];

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $res = $con->spørring($sql, $verdier);
  }


  // Statisk metode for sletting av anlegg fra databasen.
  public static function slett($anleggskode) {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      DELETE FROM anlegg
      WHERE anleggskode = ?;
    ";

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $con->spørring($sql, [$anleggskode]);
  }


  // Metode for å slette et anlegg fra databasen.
  public function slettDenne() {
    self::slett($this->anleggskode);
  }


  // Statisk metode for å finne et idrettsanlegg gitt ved sin anleggskode.
  public static function finn($anleggskode) {

    // Returnerer anlegg fra cache hvis det finnes der.
    if ($anlegg = Cache::get("anlegg", $anleggskode)) 
      return $anlegg;

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      SELECT
        anleggskode,
        idrettskode,
        navn,
        åpningstid,
        stengetid,
        timepris
      FROM anlegg
      WHERE anleggskode = ?
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql, [$anleggskode])
      ->get_result()
      ->fetch_assoc();

    // Oppretter nytt anleggsobjekt, lagrer i cache og returnerer.
    $anlegg = $res ? new Anlegg($res, true) : null;
    return Cache::set("anlegg", $anleggskode, $anlegg);
  }


  // Statisk metode for å liste opp alle idrettsanlegg.
  public static function finnAlle($kriterier = []) {

    // Bygger opp WHERE-delen av SQL-spørringen basert på søkekriteriene som oppgis.
    $where = sizeof($kriterier) > 0
      ? "AND " . join(" AND ", array_map(function($felt) { return "a.$felt = ?"; }, array_keys($kriterier)))
      : "";

    // SQL-spørring for uthenting av alle anlegg.
    // Sorteres alfabetisk etter tilhørende idrettsnavn.
    $sql = "
      SELECT
        a.anleggskode,
        a.idrettskode,
        a.navn,
        a.åpningstid,
        a.stengetid,
        a.timepris
      FROM anlegg AS a, idrett AS i
      WHERE
        a.idrettskode = i.idrettskode
        $where
      ORDER BY i.navn, a.navn;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql, array_values($kriterier))
      ->get_result()
      ->fetch_all(MYSQLI_ASSOC);

    // Returnerer et array av anleggsobjekter og lagrer i cache.
    return array_map(function($rad) {
      return Cache::set("anlegg", $rad["anleggskode"], new Anlegg($rad, true));
    }, $res);
  }


  // Returnerer et idrettsobjekt som tilsvarer anleggets idrettskode.
  public function getIdrett() {
    return Idrett::finn($this->idrettskode);
  }

}

?>
