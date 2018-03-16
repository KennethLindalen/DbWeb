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
    $this->passord       = $fraDatabase ? null : $medlem["passord"];
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

    if (!filter_var($this->epost, FILTER_VALIDATE_EMAIL) || strlen($this->epost) > 100)
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
    try {
      if ($this->medlemsnummer)
        $this->oppdater();
      else
        $this->settInn();
    }
    catch (mysqli_sql_exception $e) {
      if ($e->getCode() == 1062)
        throw new InvalidArgumentException(json_encode(["epost" => "E-postadressen er allerede i bruk"]));
      if ($e->getCode() == 1452)
        throw new InvalidArgumentException(json_encode(["postnummer" => "Ugyldig postnummer"]));
      throw $e;
    }
  }

  private function settInn() {
    $sql = "
      INSERT INTO medlem (fornavn, etternavn, adresse, postnummer, telefonnummer, epost, passord)
      VALUES (?, ?, ?, ?, ?, ?, ?);
    ";

    $verdier = [
      $this->fornavn,
      $this->etternavn,
      $this->adresse, 
      $this->postnummer, 
      $this->telefonnummer, 
      $this->epost, 
      $this->passord
    ];

    $con = new Database();
    $res = $con->spørring($sql, $verdier);

    $this->medlemsnummer = $res->insert_id;
    $this->passord = null;
  }

  private function oppdater() {
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

    $verdier = [
      $this->fornavn,
      $this->etternavn,
      $this->adresse,
      $this->postnummer,
      $this->telefonnummer,
      $this->epost,
      $this->medlemsnummer
    ];

    $con = new Database();
    $res = $con->spørring($sql, $verdier);
  }

  public static function finn($medlemsnummer) {
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

    $con = new Database();
    $res = $con
      ->spørring($sql, [$medlemsnummer])
      ->get_result()
      ->fetch_assoc();

    return new Medlem($res, true);
  }

  public static function autentiser($identifikator, $passord) {
    $sql = "
      SELECT medlemsnummer, passord
      FROM medlem
      WHERE medlemsnummer = ? OR epost = ?;
    ";

    $con = new Database();
    $res = $con
      ->spørring($sql, [$identifikator, $identifikator])
      ->get_result()
      ->fetch_assoc();

    if (password_verify($passord, $res["passord"]))
      return $res["medlemsnummer"];

    throw new InvalidArgumentException(json_encode(["autentisering" => "Autentisering feilet"]));
  }

  public function toArray() {
    return array_filter((array) $this, function($var) { return $var != null; });
  }

}

?>
