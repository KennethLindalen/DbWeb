<?php

include_once "utils/session.php";
include_once "models/Medlem.php";

$feil = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  try {
    $medlemsnummer = Medlem::autentiser($_POST["identifikator"], $_POST["passord"]);
    $_SESSION["medlemsnummer"] = $medlemsnummer;
    $_SESSION["erInnlogget"] = true;
    header("Location: /");
  }
  catch (InvalidArgumentException $e) {
    $feil = json_decode($e->getMessage(), true);
  }
  catch (mysqli_sql_exception $e) {
    header("Location: error.php");
  }

}

?>
