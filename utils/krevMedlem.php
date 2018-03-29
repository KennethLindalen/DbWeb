<?php

// Modul for beskyttelse av sider som krever innlogging.
// Må inkluderes på begynnelsen av alle beskyttede sider.

// Må ha tilgang til sessions
include_once "utils/session.php";

// Dersom bruker ikke er logget inn, redirect til error-siden.
if (!$_SESSION["medlemsnummer"])
  header("Location: error.php?id=2");

?>
