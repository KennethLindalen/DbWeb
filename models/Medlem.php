<?php

// Includes
include_once "utils/database.php";

// Klasse som representerer klubbens medlemmer
class Medlem {

  // Konstruktørmetode
  // Medlemsobjekter opprettes direkte fra $_POST ved registrering, eller fra
  // et assosiativt array som hentes fra eksisterende oppføringer i databasen.
  // Ulike objektvariabler benyttes basert på hvor dataene kommer fra.
  public function __construct($medlem = [], $fraDatabase = false) {
    $this->medlemsnummer = $fraDatabase ? $medlem["medlemsnummer"] : null;
    $this->fornavn       = $medlem["fornavn"];
    $this->etternavn     = $medlem["etternavn"];
    $this->adresse       = $medlem["adresse"];
    $this->postnummer    = $medlem["postnummer"];
    $this->poststed      = $fraDatabase ? $medlem["poststed"] : null;
    $this->telefonnummer = $medlem["telefonnummer"];
    $this->epost         = $medlem["epost"];
    $this->passord       = $fraDatabase ? null : $medlem["passord"];
    $this->passord2      = $fraDatabase ? null : $medlem["passord2"];
    if (!$fraDatabase) $this->valider();
  }

  // Metode for validering av felter
  // Utføres kun når medlemsobjektet konstrueres fra $_POST ved registrering,
  // altså stoler vi på dataene dersom de kommer direkte fra databasen.
  private function valider() {
    $feil = [];

    // Fornavn kan bestå av bokstaver, bindestrek, apostrof og punktum. Maks 100 tegn.
    if (!preg_match("/^[\pL\s'.-]{1,100}$/u", $this->fornavn))
      $feil["fornavn"] = "Ugyldig fornavn.";

    // Etternavn kan bestå av bokstaver, bindestrek, apostrof og punktum. Maks 100 tegn.
    if (!preg_match("/^[\pL\s'.-]{1,100}$/u", $this->etternavn))
      $feil["etternavn"] = "Ugyldig etternavn.";

    // Fornavnet kan kun bestå av bokstaver, tall, bindestrek, apostrof, komma og punktum. Maks 100 tegn.
    if (!preg_match("/^[\pL\s\d'.,-]{1,100}$/u", $this->adresse))
      $feil["adresse"] = "Ugyldig adresse.";

    // Postnummeret må bestå av 4 siffer
    if (!preg_match("/^\d{4}$/", $this->postnummer))
      $feil["postnummer"] = "Ugyldig postnummer.";

    // Telefonnummer må bestå av 8 siffer. Vi begrenser oss altså til norske telefonnummer.
    if (!preg_match("/^\d{8}$/", $this->telefonnummer))
      $feil["telefonnummer"] = "Ugyldig telefonnummer.";

    // Bruker PHP sitt innebygde filter for å validere e-postadresse. Maks 100 tegn.
    if (!filter_var($this->epost, FILTER_VALIDATE_EMAIL) || strlen($this->epost) > 100)
      $feil["epost"] = "Ugyldig e-postadresse.";

    // Passordet må inneholde store- og små bokstaver og tall. Minst 8 tegn.
    if (!preg_match("/(?=.*\d)(?=.*[a-zæøå])(?=.*[A-ZÆØÅ]).{8,}/", $this->passord))
      $feil["passord"] = "Passordet må bestå av minst 8 tegn og inneholde både tall, store-, og små bokstaver.";

    // Bruker må oppgi passord to ganger for å sikre at han/hun ikke har tastet feil
    if ($this->passord !== $this->passord2)
      $feil["passord2"] = "Passordene må være like.";

    // Dersom noen av valideringene feilet, kast unntak og send med forklaringer.
    if (!empty($feil))
      throw new InvalidArgumentException(json_encode($feil));

    // Dersom valideringene er godkjent, krypter passord og fjern ukryptert fra objekt.
    $this->passord = password_hash($this->passord, PASSWORD_BCRYPT);
    $this->passord2 = null;
  }


  // Metode for å lagre et medlemsobjekt til databasen.
  public function lagre() {

    // UPDATE-spørring dersom medlemsnummer finnes, INSERT-spørring ellers.
    try {
      if ($this->medlemsnummer)
        $this->oppdater();
      else
        $this->settInn();
    }

    // Feilkode 1062 - brudd på UNIQUE i databasen - e-postadressen eksisterer.
    // Feilkode 1452 - brudd på fremmednøkkelkrav i databasen - ugyldig postnummer.
    // Kaster unntaket videre dersom det ikke er relatert til validering.
    catch (mysqli_sql_exception $e) {
      if ($e->getCode() == 1062)
        throw new InvalidArgumentException(json_encode(["epost" => "E-postadressen er allerede i bruk."]));
      if ($e->getCode() == 1452)
        throw new InvalidArgumentException(json_encode(["postnummer" => "Ugyldig postnummer."]));
      throw $e;
    }
  }


  // Metode for innsetting av nye medlemmer.
  private function settInn() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      INSERT INTO medlem (fornavn, etternavn, adresse, postnummer, telefonnummer, epost, passord)
      VALUES (?, ?, ?, ?, ?, ?, ?);
    ";

    // Verdiene som skal settes inn i databasen.
    $verdier = [
      $this->fornavn,
      $this->etternavn,
      $this->adresse,
      $this->postnummer,
      $this->telefonnummer,
      $this->epost,
      $this->passord
    ];

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $res = $con->spørring($sql, $verdier);

    // Henter medlemsnummer fra nyinnsatt rad og fjerner passordet fra objektet.
    $this->medlemsnummer = $res->insert_id;
    $this->passord = null;
  }


  // Metode for oppdatering av eksisterende medlemmer.
  private function oppdater() {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      UPDATE medlem
      SET
        fornavn = ?,
        etternavn = ?,
        adresse = ?,
        postnummer = ?,
        telefonnummer = ?,
        epost = ?
      WHERE
        medlemsnummer = ?
    ";

    // Verdiene som skal settes inn i databasen.
    $verdier = [
      $this->fornavn,
      $this->etternavn,
      $this->adresse,
      $this->postnummer,
      $this->telefonnummer,
      $this->epost,
      $this->medlemsnummer
    ];

    // Kobler til databasen og utfører spørringen.
    $con = new Database();
    $con->spørring($sql, $verdier);
  }


  // Statisk metode for å finne et medlem basert på gitt medlemsnummer.
  public static function finn($medlemsnummer) {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      SELECT
        m.medlemsnummer,
        m.fornavn,
        m.etternavn,
        m.adresse,
        p.postnummer,
        p.poststed,
        m.telefonnummer,
        m.epost
      FROM
        medlem AS m,
        poststed AS p
      WHERE
        m.postnummer = p.postnummer AND
        medlemsnummer = ?;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql, [$medlemsnummer])
      ->get_result()
      ->fetch_assoc();

    // Returnerer et nytt medlemsobjekt.
    return new Medlem($res, true);
  }


  // Statisk metode for autentisering av brukere ved innlogging.
  public static function autentiser($identifikator, $passord) {

    // SQL-spørring med parametre for bruk i prepared statement.
    $sql = "
      SELECT medlemsnummer, passord
      FROM medlem
      WHERE medlemsnummer = ? OR epost = ?;
    ";

    // Kobler til databasen og utfører spørringen.
    // Henter resultatet fra spørringen i et assosiativt array ($res).
    $con = new Database();
    $res = $con
      ->spørring($sql, [$identifikator, $identifikator])
      ->get_result()
      ->fetch_assoc();

    // Verifiserer passordet ved å sammenlikne brukerinput og hash fra databasen.
    if (password_verify($passord, $res["passord"]))
      return $res["medlemsnummer"];

    // Kast unntak dersom autentiseringen feilet og gi passende tilbakemelding.
    throw new InvalidArgumentException(json_encode(["autentisering" => "Feil brukernavn eller passord."]));
  }


  // Metode for omgjøring av et medlemsobjekt til et assosiativt array uten null-verdier.
  public function toArray() {
    return array_filter((array) $this, function($var) { return $var != null; });
  }

}

?>
