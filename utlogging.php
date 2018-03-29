<?php

// Modul for utlogging av brukere.

// Må ha tilgang til sesjonsvariabler.
include_once "utils/session.php";

// Fjerner medlemsnummeret fra sesjonen - bruker logges ut.
// Redirigerer deretter til hovedsiden.
$_SESSION["medlemsnummer"] = false;
$_SESSION["administrator"] = false;
header("Location: /");

?>
