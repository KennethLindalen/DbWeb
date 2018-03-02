<?php include "utils/registrering.php"; ?>
<?php include "utils/funksjoner.php"; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrering - Test</title>
  </head>
  <body>

    <form method="post">
      <input type="text" name="fornavn" placeholder="Fornavn" value="<?= fraArray($_POST, 'fornavn') ?>">
      <?= fraArray($feil, "fornavn") ?><br>

      <input type="text" name="etternavn" placeholder="Etternavn" value="<?= fraArray($_POST, 'etternavn') ?>">
      <?= fraArray($feil, "etternavn") ?><br>

      <input type="text" name="adresse" placeholder="Adresse" value="<?= fraArray($_POST, 'adresse') ?>">
      <?= fraArray($feil, "adresse") ?><br>

      <input type="text" name="postnummer" placeholder="Postnummer" value="<?= fraArray($_POST, 'postnummer') ?>">
      <?= fraArray($feil, "postnummer") ?><br>

      <input type="text" name="telefonnummer" placeholder="Telefonnummer" value="<?= fraArray($_POST, 'telefonnummer') ?>">
      <?= fraArray($feil, "telefonnummer") ?><br>

      <input type="email" name="epost" placeholder="E-postadresse" value="<?= fraArray($_POST, 'epost') ?>">
      <?= fraArray($feil, "epost") ?><br>

      <input type="password" name="passord" placeholder="Passord" value="<?= fraArray($_POST, 'passord') ?>">
      <?= fraArray($feil, "passord") ?><br>

      <input type="password" name="passord2" placeholder="Gjenta passord" value="<?= fraArray($_POST, 'passord2') ?>">
      <?= fraArray($feil, "passord2") ?><br>

      <button>Send</button>
    </form>

    <?php if (empty($feil)) echo "Ingen feil." ?>
  </body>
</html>
