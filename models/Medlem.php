<?php

class Medlem {

  private $medlemsnummer;
  private $fornavn;
  private $etternavn;

  public static function søk() {

  }

  public function lagre() {
    query("INSERT INTO faen");
  }

}

  $passordHash = password_hash("passord", PASSWORD_BCRYPT);
  echo password_verify("passord", $passordHash);

?>
