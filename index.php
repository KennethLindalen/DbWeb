<?php

include_once "models/Medlem.php";

$medlem = new Medlem(null, "Kristian", "Stang", "Romnesvegen 81", "3830", "90096892", "kristian.sta@gmail.com", "pass");
$medlem->lagre();

$a = new Medlem(array(
  "medlemsnummer" => null,
  "fornavn" => "Kristian",
  "etternavn" => "Stang",
  "adresse" => "Romnesvegen 81",
  "postnummer" => "3830",
  "telefonnummer" => "90096892",
  "epost" => "kristian.sta@gmail.com",
  "passord" => "passord"
));

var_dump($a);

?>
