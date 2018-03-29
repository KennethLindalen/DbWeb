<?php

// Modul for beskyttelse av sider som krever administratorrettigheter.
// Må inkluderes på begynnelsen av alle administratorsider.

// Må ha tilgang til sessions
include_once "utils/session.php";

// Dersom bruker ikke er administrator, redirect til error-siden.
if (!$_SESSION["administrator"])
  header("Location: error.php?id=3");

?>
