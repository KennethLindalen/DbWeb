<?php

include_once "models/Medlem.php";
include_once "models/Idrett.php";
include_once "models/Anlegg.php";
include_once "models/Reservasjon.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $feil = [];

  try {

    //
    switch ($_POST["operasjon"]) {

      //
      case "slettMedlem":
        Medlem::slett($_POST["medlemsnummer"]);
        break;

      //
      case "nyIdrett":
        $idrett = new Idrett($_POST);
        $idrett->lagre();
        break;

      //
      case "slettIdrett":
        Idrett::slett($_POST["idrettskode"]);
        break;

      //
      case "nyttAnlegg":
        $anlegg = new Anlegg($_POST);
        $anlegg->lagre();
        break;

      //
      case "slettAnlegg":
        Anlegg::slett($_POST["anleggskode"]);
        break;

      //
      case "slettReservasjon":
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


?>
