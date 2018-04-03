<?php

// Klasse for mellomlagring av objekter.
class Cache {

  // Privat konstruktørmetode - kan ikke lage objekter av klassen utenfra.
  private function __construct() {
    $this->medlem = [];
    $this->idrett = [];
    $this->anlegg = [];
  }

  // Privat metode for å hente cache-objektet.
  private static function getCache() {
    static $cache;
    if ($cache == null)
      $cache = new Cache();
    return $cache;
  }

  // Metode for å hente ut objekter fra valgt "gruppe" med gitt index.
  public static function get($felt, $index) {
    $cache = self::getCache();
    return $cache->{$felt}[$index] ?? null;
  }

  // Metode for å legge inn objekter til valgt "gruppe" med gitt index.
  public static function set($felt, $index, $verdi) {
    $cache = self::getCache();
    $cache->{$felt}[$index] = $verdi;
    return $verdi;
  }

}

?>
