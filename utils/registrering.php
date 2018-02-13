<?php

function registrerMedlem($medlem) {
  try {
    return new Medlem($_POST);
  } catch (Exception $e) {
    return $e;
  }
}

?>
