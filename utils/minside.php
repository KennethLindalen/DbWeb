<?php

// Modul for oppdatering av brukerdetaljer.
// Inkluderes på medlemmenes "min side", der nye detaljer tastes inn.
// Tilgjengeliggjør feilinformasjon (valideringsfeil, etc.) for
// denne siden slik at brukere enkelt kan informeres gjennom $feil.

// Krever tilgang til medlemsklassen.
include_once "models/Medlem.php";

// Hent medlemsobjektet fra databasen.
$medlem = Medlem::finn($_SESSION["medlemsnummer"]);

// Eventuelle feil ved endring vil gjøres tilgjengelig for GUI her.
$feil = [];

// Funksjon som returnerer bootstrap-klassenavn for input-felter der feil finnes.
// Må bruke global-nøkkelordet for å få tilgang til variabler utenfor funksjoner.
function erGyldig($felt) {
  global $feil;
  if ($_SERVER["REQUEST_METHOD"] === "POST")
    return isset($feil[$felt]) ? "is-invalid" : "is-valid";
}

// Modulen brukes kun ved POST-requests til "min side".
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  try {

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
