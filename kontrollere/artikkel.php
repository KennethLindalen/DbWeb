<?php

// Kontroller for artikkelsiden.
// Tilgjengeliggjør nødvendige data for GUI.

// Krever tilgang til artikkelklassen.
include_once "models/Artikkel.php";

// Henter en artikkel gitt ved id fra GET-parameter.
$artikkel = Artikkel::finn($_GET["id"] ?? -1);

// Omdirigerer til feilside dersom artikkelen ikke finnes.
if ($artikkel->artikkelkode == null)
  header("Location: error.php?id=4");

// Henter forfatteren av artikkelen som et medlemsobjekt.
// Vil være "Administrator" dersom den opprinnelige forfatteren er slettet.
$forfatter = $artikkel->medlemsnummer ? $artikkel->getMedlem()->fulltNavn() : "Administrator";

?>
