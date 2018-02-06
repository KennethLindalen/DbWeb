<?php

include_once "models/Medlem.php";

if ($_POST) {
  $medlem = new Medlem($_POST);
  var_dump($medlem);
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>asdfasdf</title>
  </head>
  <body>

    <form action="index.php" method="post">
      <input type="text" name="fornavn">
      <input type="text" name="etternavn">
      <input type="password" name="passord">
      <button>faen</button>
    </form>

    <p><?php echo $a ?></p>
  </body>
</html>
