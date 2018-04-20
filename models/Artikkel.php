<?php

// Includes
include_once "utils/database.php";
include_once "models/Medlem.php";

// Klasse som representerer klubbens nyhetsartikler.
class Artikkel {

  public function __construct($artikkel = [], $fraDatabase = false) {
    $this->artikkelkode  = $fraDatabase ? $artikkel["artikkelkode"] : null;
    $this->tittel        = $artikkel["tittel"];
    $this->undertittel   = $artikkel["undertittel"];
    $this->innhold       = $artikkel["innhold"];
    $this->bildeUrl      = $artikkel["bildeUrl"];
    $this->medlemsnummer = $artikkel["medlemsnummer"];
  }


  private function valider() {
    $feil = [];

    if (!preg_match("/^.{1,100}$/", $this->tittel))
      $feil["tittel"] = "Tittel må være mellom 1 og 100 tegn lang.";

    if (!preg_match("/^.{1,100}$/", $this->undertittel))
      $feil["undertittel"] = "Undertittel må være mellom 1 og 100 tegn lang.";

    if (!preg_match("/^.{1,500}$/s", $this->innhold))
      $feil["innhold"] = "Innhold må være mellom 1 og 100 tegn langt.";

    if (!preg_match("/^.{1,100}$/", $this->bildeUrl))
      $feil["bildeUrl"] = "URL må være mellom 1 og 100 tegn lang.";

    if (!empty($feil))
      throw new InvalidArgumentException(json_encode($feil));
  }


  public function lagre() {
    $this->valider();
    if ($this->artikkelkode)
      $this->oppdater();
    else
      $this->settInn();
  }


  private function settInn() {

    $sql = "
      INSERT INTO artikkel (tittel, undertittel, innhold, bildeUrl, medlemsnummer)
      VALUES (?, ?, ?, ?, ?);
    ";

    $verdier = [
      $this->tittel,
      $this->undertittel,
      $this->innhold,
      $this->bildeUrl,
      $this->medlemsnummer
    ];

    $con = new Database();
    $res = $con->spørring($sql, $verdier);

    $this->artikkelkode = $res->insert_id;
  }


  private function oppdater() {

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

    $verdier = [
      $this->tittel,
      $this->undertittel,
      $this->innhold,
      $this->bildeUrl,
      $this->artikkelkode
    ];

    $con = new Database();
    $con->spørring($sql, $verdier);
  }


  public static function slett($artikkelkode) {

    $sql = "
      CALL slett_artikkel(?);
    ";

    $con = new Database();
    $con->spørring($sql, [$artikkelkode]);
  }


  public function slettDenne() {
    self::slett($this->artikkelkode);
  }


  public static function finn($artikkelkode) {

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

    $con = new Database();
    $res = $con
      ->spørring($sql, [$artikkelkode])
      ->get_result()
      ->fetch_assoc();

    return new Artikkel($res, true);
  }


  public static function finnAlle($antall = 6, $offset = 0) {

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

    $con = new Database();
    $res = $con
      ->spørring($sql, [$antall, $offset])
      ->get_result()
      ->fetch_all(MYSQLI_ASSOC);

    return array_map(function($rad) {
      return new Artikkel($rad, true);
    }, $res);
  }


  public function getMedlem() {
    return Medlem::finn($this->medlemsnummer);
  }

}


?>
