<?php

include_once "utils/database.php";

$db = new Database();

echo $db->getRow("SELECT * FROM Medlem");

?>
