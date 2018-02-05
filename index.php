<?php

include_once "utils/database.php";

$db = new Database();

var_dump($db->getRow("SELECT * FROM ?", ["Medlem"]));

?>
