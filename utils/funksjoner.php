<?php

// Denne filen inneholder generelle funksjoner og hjelpemidler til bruk overalt på siden.

function fraArray($arr, $felt) {
  return isset($arr[$felt]) ? htmlspecialchars($arr[$felt]) : "";
}

?>
