<?php

// Modul for sletting og oppretting av nyhetsartikler. Behandler forespørsler
// fra administrasjonssiden og utfører de nødvendige operasjonene mot databasen
// via modellklassene. Tilgjengeliggjør også nødvendige variabler for GUI.

// Modulen krever tilgang til artikkel- og medlemsmodellklassene.
include_once "models/Artikkel.php";
include_once "models/Medlem.php";

// Eventuelle feil samles opp her og gjøres tilgjengelig for GUI.
$feil = [];

// Returnerer "is-valid" eller "is-invalid" som klassenavn dersom
// det finnes valideringsfeil fra serveren ved gitt tekstboks.
function inputErGyldig($felt) {
  global $feil;
  if ($_SERVER["REQUEST_METHOD"] === "POST")
    return isset($feil[$felt]) ? "is-invalid" : "is-valid";
}

// Returnerer "show" som klassenavn for å holde kategorien
// som brukeren gjorde POST-forespørselen fra utvidet.
function kategoriErValgt($kategori) {
  if ($_SERVER["REQUEST_METHOD"] === "POST")
    return $_POST["operasjon"] == $kategori ? "show" : "";
}

// Behandler ulike POST-forespørsler til administrasjon-nyheter-siden.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  try {

    // Oppretter en ny nyhetsartikkel basert på inndata.
    if ($_POST["operasjon"] == "nyArtikkel") {
      $_POST["medlemsnummer"] = $_SESSION["medlemsnummer"];
      $nyArtikkel = new Artikkel($_POST);
      $nyArtikkel->lagre();
    }

    // Sletter en nyhetsartikkel basert på inndata.
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

// Tilgjengeliggjør data for GUI. Disse hentes etter at operasjonene
// over er utført, slik at vi garanterer oppdaterte verdier fra databasen.
$alleArtikler = Artikkel::finnAlle(1000);

?>
