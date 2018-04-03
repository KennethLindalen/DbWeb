<?php

// Modul for oppdatering av brukerdetaljer.
// Inkluderes på medlemmenes "min side", der nye detaljer tastes inn.
// Tilgjengeliggjør feilinformasjon (valideringsfeil, etc.) for
// denne siden slik at brukere enkelt kan informeres gjennom $feil.

// Krever tilgang til medlemsklassen.
include_once "models/Medlem.php";
include_once "models/Reservasjon.php";
include_once "utils/funksjoner.php";

// Hent medlemsobjektet fra databasen.
$medlem = Medlem::finn($_SESSION["medlemsnummer"]);

// Eventuelle feil ved endring vil gjøres tilgjengelig for GUI her.
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

// Setter nødvendige variabler ved GET-forespørsler.
if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $valgtMåned = date("Y-m");
}

// Logikk for behandling av POST-forespørsler
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  try {

    // Henter reservasjonsdata dersom operasjonen er "faktura".
    if ($_POST["operasjon"] == "faktura") {
      $valgtMåned = $_POST["måned"] == "" ? date("Y-m") : fraArray($_POST, "måned");

      // Henter alle brukerens reservasjoner med "dato LIKE <måned>%".
      $reservasjoner = Reservasjon::finnAlle([
        "medlemsnummer" => $_SESSION["medlemsnummer"],
        "dato" => $valgtMåned . "%"]
      );

      $sum = 100;
      foreach ($reservasjoner as $reservasjon) {
        $sum += $reservasjon->getAnlegg()->timepris;
      }
    }

    // Oppdaterer felter og lagrer dersom operasjonen er "endreMedlem".
    if ($_POST["operasjon"] == "endreMedlem") {
      $medlem->fornavn       = $_POST["fornavn"];
      $medlem->etternavn     = $_POST["etternavn"];
      $medlem->adresse       = $_POST["adresse"];
      $medlem->postnummer    = $_POST["postnummer"];
      $medlem->telefonnummer = $_POST["telefonnummer"];
      $medlem->epost         = $_POST["epost"];
      $medlem->lagre();
    }

    // Autentiserer medlemmet, oppdaterer passordfeltene og lagrer i databasen
    // dersom operasjonen er "endrePassord". Kaster autentiserings- og valideringsunntak.
    if ($_POST["operasjon"] == "endrePassord") {
      Medlem::autentiser($medlem->medlemsnummer, $_POST["gammeltPassord"]);
      $medlem->passord = $_POST["passord"];
      $medlem->passord2 = $_POST["passord2"];
      $medlem->lagre();
    }

  }

  // Dersom feil oppstår ved validering, legg feilene inn i feil-arrayet.
  catch (InvalidArgumentException $e) {
    $feil = json_decode($e->getMessage(), true);
  }

  // Dersom feil oppstår i forbindelse med databasen, redirect til error-siden.
  catch (mysqli_sql_exception $e) {
    header("Location: error.php?id=1");
  }

}

?>
