<?php session_start() ?>
<?php include utils/redir.php; ?>
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
			<p>Logo</p>
			<h1><a href="index.php">Nederlaget<br>Idrettsklubb</a></h1>
		</div>
		<!-- Slutt på header container div -->
	</header>
	<nav>
		<div class="container">
			<ul>
				<li><a href="/nyheter.php">Nyheter</a>
				</li>
				<li><a href="/aktiviteter.php">Aktiviteter</a>
				</li>
				<li><a href="/resultater.php">Resultater</a>
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
