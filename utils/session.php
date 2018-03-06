<?php

session_start();

$_SESSION["medlemsnummer"] = $_SESSION["medlemsnummer"] ?? false;
$_SESSION["erInnlogget"]   = $_SESSION["erInnlogget"]   ?? false;

?>
