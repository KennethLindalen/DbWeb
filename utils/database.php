<?php

  function getConnection() {
    $hostname = "localhost";
    $username = "v18u130";
    $password = "Pw130";
    $database = "v18db130";
    return mysqli_connect($hostname, $username, $password, $database);
  }

?>
