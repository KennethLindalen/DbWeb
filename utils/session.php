<?php

// Modul som sørger for enkel implementasjon av sesjoner.
// Inkluderes på alle sider som må ha tilgang til sesjonsvariabler.

// Starter sessions
session_start();

// Definerer nødvendige sesjonsvariabler. Gjør at variablene kan brukes direkte
// på andre sider, uten at man trenger å teste om de er definert eller ikke.
$_SESSION["medlemsnummer"] = $_SESSION["medlemsnummer"] ?? false;

?>
