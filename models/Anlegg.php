<?php

include_once "utils/database.php";


class Anlegg {

  public function __construct($anlegg = [], $fraDatabase = false) {
    $this->anleggskode = $anlegg["anleggskode"];
    $this->idrettskode = $anlegg["idrettskode"];
    $this->navn        = $anlegg["navn"];
    $this->åpningstid  = $anlegg["åpningstid"];
    $this->stengetid   = $anlegg["stengetid"];
    $this->timepris    = $anlegg["timepris"];
    if (!$fraDatabase) $this->valider();
  }

  private function valider() {
    // kast unntak ved feil
  }

}

?>
