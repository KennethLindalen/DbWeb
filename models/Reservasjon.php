<?php

include_once "utils/database.php";
include_once "models/Medlem.php";
include_once "models/Anlegg.php";


class Reservasjon {

  public function __construct($reservasjon = [], $fraDatabase = false) {
    $this->medlemsnummer = $reservasjon["medlemsnummer"];
    $this->anleggskode   = $reservasjon["anleggskode"];
    $this->dato          = $reservasjon["dato"];
    $this->time          = $reservasjon["time"];
  }

  private function valider() {
    $feil = [];

    // Medlemsnummer må være et positivt heltall.
    if (!preg_match("/^\d+$/", $this->medlemsnummer) || $this->medlemsnummer < 0)
      $feil["medlemsnummer"] = "Ugyldig medlemsnummer.";

    // Anleggskode må være et positivt heltall.
    if (!preg_match("/^\d+$/", $this->anleggskode) || $this->medlemsnummer < 0)
      $feil["anleggskode"] = "Ugyldig anleggskode.";

    // Dato må være på gyldig format (ÅÅÅÅ-MM-DD) og være en reell dato (checkdate).
    if (!preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $this->dato, $res) ||
        !checkdate((int) $res[2], (int) $res[3], (int) $res[1]))
      $feil["dato"] = "Ugyldig dato.";

    // Time må være et heltall mellom 0 og 23.
    if (!preg_match("/^\d+$/", $this->time) || $this->time < 0 || $this->time > 23)
      $feil["time"] = "Ugyldig time.";

    // Dersom noen av valideringene feilet, kast unntak og send med forklaringer.
    if (!empty($feil))
      throw new InvalidArgumentException(json_encode($feil));
  }


  // Metode for å lagre et reservasjonsobjekt til databasen.
  public function lagre() {

    // Validerer og setter inn data - catch fanger eventuelle unntak.
    try {
      $this->valider();
      $this->settInn();
    }

    // Feilkode 1062 - brudd på UNIQUE i databasen - anlegget er allerede reservert.
    // Feilkode 1452 - brudd på fremmednøkkelkrav i databasen - medlem eller anlegg finnes ikke.
    // Feilkode 1644 - brudd på tabellens "BEFORE INSERT"-trigger - time utenfor åpningstid.
    // Kaster unntaket videre dersom det ikke er relatert til validering.
    catch (mysqli_sql_exception $e) {
      if ($e->getCode() == 1062)
        throw new InvalidArgumentException(json_encode(["time" => "Anlegget er allerede reservert denne timen."]));
      if ($e->getCode() == 1452)
        throw new InvalidArgumentException(json_encode(["anleggskode" => "Anlegget finnes ikke."]));
      if ($e->getCode() == 1644)
        throw new InvalidArgumentException(json_encode(["time" => $e->getMessage()]));
      throw $e;
    }
  }


  // Metode for innsetting av nye reservasjoner.
  private function settInn() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      INSERT INTO reservasjon (medlemsnummer, anleggskode, dato, time)
      VALUES (?, ?, ?, ?);
    ";

    // Verdier som skal settes inn.
    $verdier = [
      $this->medlemsnummer,
      $this->anleggskode,
      $this->dato,
      $this->time
    ];

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $con->spørring($sql, $verdier);
  }


  // Statisk metode for sletting av reservasjoner.
  public static function slett($anleggskode, $dato, $time) {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      CALL slett_reservasjon(?, ?, ?);
    ";

    try {
      // Kobler til databasen og utfører spørringen.
      $con = new Database();
      $con->spørring($sql, [$anleggskode, $dato, $time]);
    }

    // Feilkode 1644 - brudd på tabellens "BEFORE DELETE"-trigger - kanselleringsfrist utgått.
    catch (mysqli_sql_exception $e) {
      if ($e->getCode() == 1644)
        throw new InvalidArgumentException(json_encode(["time" => $e->getMessage()]));
      throw $e;
    }

  }


  // Metode for sletting av reservasjon.
  public function slettDenne() {
    self::slett($this->anleggskode, $this->dato, $this->time);
  }


  // Metode for å finne en reservasjon gitt ved sine primærnøkkelfelter.
  public static function finn($anleggskode, $dato, $time) {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      SELECT
        medlemsnummer,
        anleggskode,
        dato,
        time
      FROM reservasjon
      WHERE
        anleggskode = ? AND
        dato = ? AND
        time = ?;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
      $res = $con
      ->spørring($sql, [$anleggskode, $dato, $time])
      ->get_result()
      ->fetch_assoc();

    // Returnerer et nytt idrettsobjekt.
    return $res ? new Reservasjon($res, true) : null;
  }


  // Statisk metode for å liste opp alle reservasjoner med eventuelle søkekriterier.
  public static function finnAlle($kriterier = []) {

    // Bygger opp WHERE-delen av SQL-spørringen basert på søkekriteriene som oppgis.
    $where = sizeof($kriterier) > 0
      ? "WHERE " . join(" AND ", array_map(function($felt) { return "$felt LIKE ?"; }, array_keys($kriterier)))
      : "";

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      SELECT
        medlemsnummer,
        anleggskode,
        dato,
        time
      FROM reservasjon
      $where
      ORDER BY dato, time;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql, array_values($kriterier))
      ->get_result()
      ->fetch_all(MYSQLI_ASSOC);

    // Returnerer et array av reservasjonsobjekter.
    return array_map(function($rad) { return new Reservasjon($rad, true); }, $res);
  }


  // Returnerer et medlemsobjekt for medlemmet som "eier" reservasjonen.
  public function getMedlem() {
    return Medlem::finn($this->medlemsnummer);
  }


  // Returnerer et anleggsobjekt for anlegget reservasjonen gjelder.
  public function getAnlegg() {
    return Anlegg::finn($this->anleggskode);
  }

}

?>
