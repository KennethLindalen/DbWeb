<?php

class Idrett {

  private $idrettskode;
  private $idrettsnavn;
  private $anlegg;

  public function __construct($idrettskode, $idrettsnavn) {
    $this->idrettskode = $idrettskode;
    $this->idrettsnavn = $idrettsnavn;
  }

  public function lagre() {

  }

}

?>
