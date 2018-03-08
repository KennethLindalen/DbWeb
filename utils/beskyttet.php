<?php

include_once "utils/session.php";

if (!$_SESSION["erInnlogget"])
  header("Location: error.php?id=2");

?>
