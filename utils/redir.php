<?php

//Ikke ferdig ennå, og tungvindt laget. Skal bli fresha opp litt senere. Må bare først fikse .htaccess

$aktiviteter = $_GET("aktiviteter");
$nyheter = $_GET("nyheter");
$resultater = $_GET("resultater");
$admin = $_GET("admin");

if (isset($_GET['aktiviteter'])) {
    echo $_GET['aktiviteter'];
} elseif (isset($_GET['nyheter']){
    echo $_GET['nyheter'];
}elseif (isset($_GET['resultater']){
    echo $_GET['resultater'];
}elseif (isset($_GET['admin']){
    echo $_GET['admin'];
}
 ?>
