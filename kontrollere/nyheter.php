<?php

// Kontroller for nyhetssiden.
// Tilgjengeliggjør nødvendige data for GUI, slik at artiklene i databasen
// kan vises fram på en oversiktsside. Støtter sidevisning.

// Krever tilgang til artikkelklassen.
include_once "models/Artikkel.php";

// Bestemmer hvor mange artikler som skal vises per side.
// Henter sidenummer fra GET-parameter, defaulter til side 1.
// Henter så 6 artikler fra databasen og tilgjengeliggjør for GUI.
$artiklerPerSide = 6;
$side = isset($_GET["s"]) ? intval($_GET["s"]) : 1;
$alleArtikler = Artikkel::finnAlle(6, ($side - 1) * $artiklerPerSide);

?>
