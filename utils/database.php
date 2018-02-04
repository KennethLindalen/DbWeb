<?php

  function getConnection() {
    $hostname = "localhost";
    $username = "v18u130";
    $password = "Pw130";
    $database = "v18db130";
    $conn = mysqli_connect($hostname, $username, $password, $database);
    $conn->set_charset("utf8");
    return $conn;
  }

  function closeConnection($conn) {
    mysql_close($conn);
  }

?>
