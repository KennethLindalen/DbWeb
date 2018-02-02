<?php

  function getConnection() {
    $hostname = "";
    $username = "";
    $password = "";
    $database = "";
    return mysqli_connect($hostname, $username, $password, $database);
  }

?>
