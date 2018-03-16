<?php

// Modul som sørger for enkel implementasjon av sesjoner.
// Inkluderes på alle sider som skal ha tilgang til sesjonsvariabler.
// Deklarerer nødvendige sesjonsvariabler og gjør at disse kan brukes direkte
// på andre sider, uten at man trenger å teste om de er definert eller ikke.

// Starter sessions
session_start();

// Brukere er innlogget dersom medlemsnummeret er definert i sesjonen.
$_SESSION["medlemsnummer"] = $_SESSION["medlemsnummer"] ?? false;

?>
