<?php

include_once "models/Medlem.php";

$medlem = new Medlem("Kristian", "Stang", "Romnesvegen 81", "3830", "90096892", "kristian.sta@gmail.com", "pass");
$medlem->lagre();

?>
