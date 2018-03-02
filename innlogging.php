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

    <form method="post">
      <input type="text" name="identifikator" placeholder="identifikator"><br>
      <input type="text" name="passord" placeholder="passord"><br>
      <button>Logg inn</button>
    </form>

  </body>
</html>
