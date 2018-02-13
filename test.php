<?php
  include_once "models/Medlem.php";
  include_once "utils/funksjoner.php";

  $feil = [];
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
      $medlem = new Medlem($_POST);
      header("Location: index.php");
    }

    catch (Exception $e) {
      $feil = json_decode($e->getMessage(), true);
    }

  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>asdfasdf</title>
  </head>
  <body>

    <form method="post">
      <input type="text" name="fornavn" value="<?= fraArray($_POST, 'fornavn') ?>">
      <?= fraArray($feil, "fornavn") ?><br>

      <input type="text" name="etternavn" value="<?= fraArray($_POST, 'etternavn') ?>">
      <?= fraArray($feil, "etternavn") ?><br>

      <input type="text" name="adresse" value="<?= fraArray($_POST, 'adresse') ?>">
      <?= fraArray($feil, "adresse") ?><br>

      <input type="text" name="postnummer" value="<?= fraArray($_POST, 'postnummer') ?>">
      <?= fraArray($feil, "postnummer") ?><br>

      <input type="text" name="telefonnummer" value="<?= fraArray($_POST, 'telefonnummer') ?>">
      <?= fraArray($feil, "telefonnummer") ?><br>

      <input type="email" name="epost" value="<?= fraArray($_POST, 'epost') ?>">
      <?= fraArray($feil, "epost") ?><br>

      <input type="password" name="passord" value="<?= fraArray($_POST, 'passord') ?>">
      <?= fraArray($feil, "passord") ?><br>

      <input type="password" name="passord2" value="<?= fraArray($_POST, 'passord2') ?>">
      <?= fraArray($feil, "passord2") ?><br>

      <button>Send</button>
    </form>

    <?php if (empty($feil)) echo "Ingen feil." ?>
  </body>
</html>
