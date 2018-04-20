<?php

// Modul for behandling av administrasjonsoperasjoner. Behandler forespørsler
// fra administrasjonssiden og utfører de nødvendige operasjonene mot databasen
// via modellklassene. Tilgjengeliggjør også nødvendige variabler for GUI.

// Modulen krever tilgang til alle modellklassene.
include_once "models/Medlem.php";
include_once "models/Idrett.php";
include_once "models/Anlegg.php";
include_once "models/Reservasjon.php";

// Operasjonene utføres kun ved POST-forespørsler til administrasjonssiden.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Eventuelle feil samles opp her og gjøres tilgjengelig for GUI.
  $feil = [];

  try {

    // Vi utfører ulike operasjoner basert på "operasjon"-feltet i POST-parameteren.
    switch ($_POST["operasjon"]) {

      // Sletting av medlemmer.
      case "slettMedlem":
        if ($_POST["medlemsnummer"] == $_SESSION["medlemsnummer"])
          $feil["generelt"] = "Du kan ikke slette din egen bruker."
        else
          Medlem::slett($_POST["medlemsnummer"]);
      break;

      // Innsetting av nye medlemmer.
      case "nyIdrett":
        $idrett = new Idrett($_POST);
        $idrett->lagre();
      break;

      // Sletting av idretter.
      case "slettIdrett":
        Idrett::slett($_POST["idrettskode"]);
      break;

      // Innsetting av nye anlegg.
      case "nyttAnlegg":
        $anlegg = new Anlegg($_POST);
        $anlegg->lagre();
      break;

      // Sletting av anlegg.
      case "slettAnlegg":
        Anlegg::slett($_POST["anleggskode"]);
      break;
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
$alleMedlemmer = Medlem::finnAlle();
$alleIdretter  = Idrett::finnAlle();
$alleAnlegg    = Anlegg::finnAlle();

?>
