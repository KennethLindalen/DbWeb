<?php include "utils/registrering.php"; ?>
<?php include "utils/funksjoner.php"; ?>
<?php include "includes/head.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrering - Test</title>
  </head>
  <body>

    <h3>Oppgi dine personalia - og bli medlem! </h3>
    <form method="post">

      <input type="text" name="fornavn" placeholder="Fornavn" value="<?= $_POST['fornavn'] ?? ""?>">
      <?= $feil["fornavn"] ?? "" ?><br>

      <input type="text" name="etternavn" placeholder="Etternavn" value="<?= $_POST['etternavn'] ?? "" ?>">
      <?= $feil["etternavn"] ?? "" ?><br>

      <input type="text" name="adresse" placeholder="Adresse" value="<?= $_POST['adresse'] ?? "" ?>">
      <?= $feil["adresse"] ?? "" ?><br>

      <input type="text" name="postnummer" placeholder="Postnummer" value="<?= $_POST['postnummer'] ?? "" ?>">
      <?= $feil["postnummer"] ?? "" ?><br>

      <input type="text" name="telefonnummer" placeholder="Telefonnummer" value="<?= $_POST['telefonnummer'] ?? "" ?>">
      <?= $feil["telefonnummer"] ?? "" ?><br>

      <input type="email" name="epost" placeholder="E-postadresse" value="<?= $_POST['epost'] ?? "" ?>">
      <?= $feil["epost"] ?? "" ?><br>

      <input type="password" name="passord" placeholder="Passord" value="<?= $_POST['passord'] ?? "" ?>">
      <?= $feil["passord"] ?? "" ?><br>

      <input type="password" name="passord2" placeholder="Gjenta passord" value="<?= $_POST['passord2'] ?? "" ?>">
      <?= $feil["passord2"] ?? "" ?><br>

      <button>Bli Medlem!</button>


    <?php if (empty($feil)) echo "Ingen feil" ?>

</form>
  </body>
</html>
