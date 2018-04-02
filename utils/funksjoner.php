<?php

// Denne filen inneholder generelle funksjoner og hjelpemidler til bruk overalt på siden.

// Henter ut og renser en verdi fra et array dersom den eksisterer.
function fraArray($arr, $felt) {
  return isset($arr[$felt]) ? rens($arr[$felt]) : "";
}

// Renser output for potensielle skadelige tekststrenger i HTML-sammenheng.
function rens($string) {
  return htmlspecialchars($string);
}

?>
