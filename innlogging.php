<?php include_once "utils/innlogging.php"; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Innlogging - Test</title>
  </head>
  <body>

    <pre>
      <?= $feil["autentisering"] ?? "" ?>
    </pre>

    <pre>
      <?= $_SESSION["medlemsnummer"] ?? "ikke innlogget" ?>
    </pre>

    <form method="post">
      <input type="text" name="identifikator" placeholder="Medlemsnummer eller e-postadresse"><br>
      <input type="text" name="passord" placeholder="Passord"><br>
      <button>Logg inn</button>
    </form>

  </body>
</html>
