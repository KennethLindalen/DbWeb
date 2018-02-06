<?php

include_once "utils/database.php";


class Idrett {

  public function __construct($idrett = [], $fraDatabase = false) {
    $this->idrettskode = $idrett["idrettskode"];
    $this->navn        = $idrett["navn"];
    if (!$fraDatabase) $this->valider();
  }

  private function valider() {
    // kast unntak ved feil
  }

}

?>
