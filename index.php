<?php

include_once "models/Medlem.php";

$a = var_dump($_POST);

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
      <button>faen</button>
    </form>

    <p><?php echo $a ?></p>
  </body>
</html>
