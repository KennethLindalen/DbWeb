<?php

include_once "utils/session.php";

session_destroy();
header("Location: /");

?>
