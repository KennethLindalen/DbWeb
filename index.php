<?php

include_once "models/Medlem.php";

$medlem = new Medlem("Kristian", "Stang", "Romnesvegen 81", "", "90096892", "kristian.sta@gmail.com", "pass");
var_dump($medlem);
$medlem->lagre();

?>
