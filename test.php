<?php
  include_once "models/Medlem.php";
  if ($_SERVER["REQUEST_METHOD"] === "POST")
    $medlem = new Medlem($_POST);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>asdfasdf</title>
  </head>
  <body>

    <form action="test.php" method="post">
      <input type="text" name="fornavn"><br>
      <input type="text" name="etternavn"><br>
      <input type="text" name="adresse"><br>
      <input type="text" name="postnummer"><br>
      <input type="text" name="telefonnummer"><br>
      <input type="email" name="epost"><br>
      <input type="password" name="passord"><br>
      <input type="password" name="passord2"><br>
      <button>Send</button>
    </form>

    <p>
      <?php var_dump($medlem); ?>
    </p>
  </body>
</html>
