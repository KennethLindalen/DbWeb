<?php

include_once "utils/session.php";

if (!$_SESSION["medlemsnummer"])
  header("Location: error.php?id=2");

?>
