<?php session_start() ?>
<?php // include utils/redir; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Nederlaget IK - Nyheter</title>


	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bungee+Hairline|Open+Sans+Condensed:300|Open+Sans">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/modal.css">
	<script src="skript/modal.js"></script>
	<script src="skript/validering/validerFornavn.js"></script>
</head>

<body>
	<header>
		<div class="container">
			<img class="article-image" src="img/logo.jpg" height="100" width="200">
			<h1><a href="index">Nederlaget<br>Idrettsklubb</a></h1>
		</div>
		<!-- Slutt på header container div -->
	</header>
	<nav>
		<div class="container">
			<ul>
				<li><a href="/nyheter">Nyheter</a></li>
				<li><a href="/aktiviteter">Aktiviteter</a></li>
				<li><a href="/resultater">Resultater</a>
				</li>
				<li><a href="#" onClick="openRegistrerModal()">Bli medlem</a>
				</li>
				<li><a href="#" onClick="openLoginModal()">Logg inn</a>
				</li>
			</ul>
		</div>
		<!-- Slutt på nav container div -->
	</nav>
	<main>
