<?php

// Modul for registrering av nye medlemmer.
// Inkluderes på siden der registrering av nye medlemmer skal foregå.
// Tilgjengeliggjør feilinformasjon (valideringsfeil, etc.) for
// denne siden slik at brukere enkelt kan informeres gjennom $feil.

// Krever tilgang til medlemsklassen.
include_once "models/Medlem.php";

// Eventuelle feil ved registrering vil gjøres tilgjengelig for GUI her.
$feil = [];

// Funksjon som returnerer bootstrap-klassenavn for input-felter der feil finnes.
// Må bruke global-nøkkelordet for å få tilgang til variabler utenfor funksjoner.
function erGyldig($felt) {
  global $feil;
  if ($_SERVER["REQUEST_METHOD"] === "POST")
    return isset($feil[$felt]) ? "is-invalid" : "is-valid";
}

// Modulen brukes kun ved POST-requests til registreringssiden.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Lager et nytt medlemsobjekt basert på brukerinput og lagrer i databasen.
  try {
    $medlem = new Medlem($_POST);
    $medlem->lagre();
    header("Location: /");
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
