<?php

include_once "models/Artikkel.php";

$artiklerPerSide = 6;
$side = isset($_GET["s"]) ? intval($_GET["s"]) : 1;
$alleArtikler = Artikkel::finnAlle(6, ($side - 1) * $artiklerPerSide);

?>
