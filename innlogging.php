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
      <input type="text" name="Medlemsnummer eller e-postadresse" placeholder="identifikator"><br>
      <input type="text" name="Passord" placeholder="passord"><br>
      <button>Logg inn</button>
    </form>

  </body>
</html>
