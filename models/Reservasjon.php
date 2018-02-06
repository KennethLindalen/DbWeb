<?php

include_once "utils/database.php";


class Reservasjon {

  public function __construct($reservasjon = [], $fraDatabase = false) {
    $this->medlemsnummer = $reservasjon["medlemsnummer"];
    $this->anleggskode   = $reservasjon["anleggskode"];
    $this->dato          = $reservasjon["dato"];
    $this->time          = $reservasjon["time"];
    if (!$fraDatabase) $this->valider();
  }

  private function valider() {
    // kast unntak ved feil
  }

}

?>
