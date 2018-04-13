<?php

include_once "models/Artikkel.php";

$artikkel = Artikkel::finn($_GET["id"] ?? -1);

if ($artikkel->artikkelkode == null)
  header("Location: error.php?id=4");

?>
