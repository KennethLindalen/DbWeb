<?php

  include_once "models/Medlem.php";

  $feil = [];

  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
      $medlem = new Medlem($_POST);
      $medlem->lagre();
    }
    catch (InvalidArgumentException $e) {
      $feil = json_decode($e->getMessage(), true);
    }
    catch (mysqli_sql_exception $e) {
      header("Location: error.php");
    }

  }

?>
