<?php

include_once "models/Artikkel.php";
include_once "models/Medlem.php";

function inputErGyldig($felt) {
  global $feil;
  if ($_SERVER["REQUEST_METHOD"] === "POST")
    return isset($feil[$felt]) ? "is-invalid" : "is-valid";
}

function kategoriErValgt($kategori) {
  if ($_SERVER["REQUEST_METHOD"] === "POST")
    return $_POST["operasjon"] == $kategori ? "show" : "";
}

$feil = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  try {

    if ($_POST["operasjon"] == "nyArtikkel") {
      $_POST["medlemsnummer"] = $_SESSION["medlemsnummer"];
      $nyArtikkel = new Artikkel($_POST);
      $nyArtikkel->lagre();
    }

    if ($_POST["operasjon"] == "slettArtikkel") {
      Artikkel::slett($_POST["artikkelkode"]);
    }

  }

  catch (InvalidArgumentException $e) {
    $feil = json_decode($e->getMessage(), true);
  }

  catch (mysqli_sql_exception $e) {
    header("Location: error.php?id=1");
  }


}

$alleArtikler = Artikkel::finnAlle(1000);

?>
