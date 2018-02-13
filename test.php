<?php
  include_once "models/Medlem.php";

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
      $medlem = new Medlem($_POST);
    } catch (Exception $e) {
      $feil = $e;
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

    <form action="test.php" method="post">
      <?php var_dump($feil); ?>
      <input type="text" name="fornavn"><?php if ($feil["fornavn"]) echo $feil["fornavn"]; ?><br>
      <input type="text" name="etternavn"><?php if ($feil["etternavn"]) echo $feil["etternavn"]; ?><br>
      <input type="text" name="adresse"><?php if ($feil["adresse"]) echo $feil["adresse"]; ?><br>
      <input type="text" name="postnummer"><?php if ($feil["postnummer"]) echo $feil["postnummer"]; ?><br>
      <input type="text" name="telefonnummer"><?php if ($feil["telefonnummer"]) echo $feil["telefonnummer"]; ?><br>
      <input type="email" name="epost"><?php if ($feil["epost"]) echo $feil["epost"]; ?><br>
      <input type="password" name="passord"><?php if ($feil["passord"]) echo $feil["passord"]; ?><br>
      <input type="password" name="passord2"><?php if ($feil["passord2"]) echo $feil["passord2"]; ?><br>
      <button>Send</button>
    </form>

    <p>
      <?php var_dump($medlem); ?>
    </p>
  </body>
</html>
