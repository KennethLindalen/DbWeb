<?php

// Modul for innlogging av medlemmer.
// Inkluderes på siden der innlogging skal foregå, og tilgjengeliggjør
// eventuell feilinformasjon for denne siden, slik at bruker kan informeres.

// Krever tilgang til sessions og til medlemsklassen.
include_once "utils/session.php";
include_once "models/Medlem.php";

// Eventuelle feil ved innlogging vil gjøres tilgjengelig for GUI her.
$feil = [];

// Modulen brukes kun ved POST-requests til innloggingssiden
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Henter medlemsnummeret til medlemmet der identifikator og passord matcher.
  try {
    $medlemsnummer = Medlem::autentiser($_POST["identifikator"], $_POST["passord"]);
    $_SESSION["medlemsnummer"] = $medlemsnummer;
    header("Location: /");
  }

  // Dersom autentiseringen feiler, legg feilmelding inn i feil-arrayet.
  catch (InvalidArgumentException $e) {
    $feil = json_decode($e->getMessage(), true);
  }

  // Dersom feil oppstod i forbindelse med databasen, redirect til error-side.
  catch (mysqli_sql_exception $e) {
    header("Location: error.php?id=1");
  }

}

?>
