<?php

include_once(dirname(__FILE__) . "/../models/Medlem.php");

function registrerMedlem() {

}

$medlem = new Medlem(123, "Kristian", "Stang", "Romnesvegen 81", 3830, "kristian.sta@gmail.com", "pass");
$medlem->lagre();

?>
