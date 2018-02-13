<?php
  include_once "models/Medlem.php";
  $feil = [];
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try
      { $medlem = new Medlem($_POST); }
    catch (Exception $e)
      { $feil = json_decode($e->getMessage(), true); }

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
      <input type="text" name="fornavn" value="<?php echo $_POST['fornavn'] ?>"><?php if (isset($feil["fornavn"])) echo $feil["fornavn"]; ?><br>
      <input type="text" name="etternavn"><?php if (isset($feil["etternavn"])) echo $feil["etternavn"]; ?><br>
      <input type="text" name="adresse"><?php if (isset($feil["adresse"])) echo $feil["adresse"]; ?><br>
      <input type="text" name="postnummer"><?php if (isset($feil["postnummer"])) echo $feil["postnummer"]; ?><br>
      <input type="text" name="telefonnummer"><?php if (isset($feil["telefonnummer"])) echo $feil["telefonnummer"]; ?><br>
      <input type="email" name="epost"><?php if (isset($feil["epost"])) echo $feil["epost"]; ?><br>
      <input type="password" name="passord"><?php if (isset($feil["passord"])) echo $feil["passord"]; ?><br>
      <input type="password" name="passord2"><?php if (isset($feil["passord2"])) echo $feil["passord2"]; ?><br>
      <button>Send</button>
    </form>

    <p>
      <?php var_dump($feil); ?>
    </p>
  </body>
</html>
