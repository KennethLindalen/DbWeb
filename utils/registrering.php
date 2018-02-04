<?php

  include_once "../models/Medlem.php";

  function registrerMedlem() {
    $medlem = new Medlem()
  }

  $medlem = new Medlem(123, "Kristian", "Stang", "Romnesvegen 81", 3830, "kristian.sta@gmail.com", "pass")
  $medlem->lagre();
?>
