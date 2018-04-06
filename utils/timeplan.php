<?php

// Includes
include_once "utils/session.php";
include_once "utils/funksjoner.php";
include_once "models/Medlem.php";
include_once "models/Idrett.php";
include_once "models/Reservasjon.php";

// Variabler som alltid må være tilgjengelige.
$alleIdretter = Idrett::finnAlle();
$feil = [];

// Returnerer "selected" slik at valgt idrett forblir valgt i select-felt.
function idrettErValgt($idrettskode) {
  if ($_SERVER["REQUEST_METHOD"] == "POST")
    return $_POST["idrettskode"] == $idrettskode ? "selected" : "";
}

// Returnerer "show" slik at listen for valgt anlegg forblir utvidet.
function anleggErValgt($anleggskode) {
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anleggskode"]))
    return $_POST["anleggskode"] == $anleggskode ? "show" : "";
}

// Henter reservasjoner for et gitt anlegg på en gitt dato.
function hentReservasjoner($anlegg, $dato) {

  // Finner alle reservasjoner for et gitt anlegg på en gitt dato.
  $reservasjoner = Reservasjon::finnAlle(["anleggskode" => $anlegg->anleggskode, "dato" => $dato]);

  // Lager et array på størrelse med antall timer i anleggets åpningstid.
  $resultat = [];
  for ($time = $anlegg->åpningstid; $time < $anlegg->stengetid; $time++) {
    $resultat[$time] = null;
  }

  // For hver reservasjon på anlegget på denne datoen, legg til reservasjonsobjekt på rett index.
  foreach ($reservasjoner as $reservasjon) {
    $resultat[$reservasjon->time] = $reservasjon;
  }

  return $resultat;
}

// Setter nødvendige variabler ved GET-forespørsler.
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $valgtIdrett = null;
  $valgtDato   = date("Y-m-d");
}

// Logikk for behandling av POST-forespørsler.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $valgtIdrett = Idrett::finn($_POST["idrettskode"]);
  $valgtDato   = $_POST["dato"] == "" ? date("Y-m-d") : fraArray($_POST, "dato");

  try {

    // Skiller mellom ulike typer operasjoner som skal utføres.
    switch ($_POST["operasjon"]) {

      // Oppretter og lagrer et nytt reservasjonsobjekt i databasen.
      case "nyReservasjon":
        $res = new Reservasjon(array_merge($_POST, ["medlemsnummer" => $_SESSION["medlemsnummer"]]));
        $res->lagre();
      break;

      // Sletter et reservasjonsobjekt fra databasen. Kan kun slettes av "eieren" eller administrator.
      case "slettReservasjon":
        $res = Reservasjon::finn($_POST["anleggskode"], $_POST["dato"], $_POST["time"]);

        if ($res && $res->medlemsnummer == $_SESSION["medlemsnummer"] || $_SESSION["administrator"])
          $res->slettDenne();
        else
          throw new InvalidArgumentException(json_encode(["autentisering" => "Kan ikke slette andre medlemmers reservasjoner."]));
      break;

    }
  }

  // Tilgjengeliggjør eventuelle feilmeldinger til GUI.
  catch (InvalidArgumentException $e) {
    $feil = json_decode($e->getMessage(), true);
  }

  // Videresender til feilside dersom alvorlige feil inntreffer.
  catch (mysqli_sql_exception $e) {
    header("Location: error.php?id=1");
  }

}


?>
