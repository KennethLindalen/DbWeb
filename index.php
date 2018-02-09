<?php session_start() ?>
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
			<h1><a href="index.html">Nederlaget<br>Idrettsklubb</a></h1>
		</div>
		<!-- Slutt på header container div -->
	</header>
	<nav>
		<div class="container">
			<ul>
				<li><a href="p/nyheter.html">Nyheter</a>
				</li>
				<li><a href="p/aktiviteter.html">Aktiviteter</a>
				</li>
				<li><a href="p/resultater.html">Resultater</a>
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
		<div class="container">
			<article>
				<a href="#">
					<img class="article-image" src="img/loss.jpg">
					<h2 class="article-header">Årsrapporten viser dystre tall</h2>
				</a>
			</article>
			<article>
				<a href="#">
					<img class="article-image" src="img/football.jpg">
					<h2 class="article-header">Nytt nederlag - tapte 4-0 mot Svenseid IL</h2>
				</a>
			</article>
			<article>
				<a href="#">
					<img class="article-image" src="img/moose.jpg">
					<h2 class="article-header">Orienteringsløpet avbrutt av illsint elg</h2>
				</a>
			</article>
			<article>
				<a href="#">
					<img class="article-image" src="img/tennis.jpg">
					<h2 class="article-header">Tennisbanen er åpnet for sesongen</h2>
				</a>
			</article>
		</div>
		<!-- Slutt på main container div -->
	</main>
	<footer>
		<div class="container">
			<p>Hey</p>
			<p>Halla</p>
		</div>
		<!-- Slutt på footer container div -->
	</footer>
	<div id="loginModal" class="modal">
		<div class="modal-content">
			<div class="modal-header"> <span class="closeBtn">
				<h2>Logg inn</h2>
				<h6>Trykk på utsiden av boksen for å lukke</h6>
			</div>
			<!-- Slutt på modal-header div -->
			<div class="modal-body">
				<lh4>Brukernavn(e-post)</h4>
				<input type="text" name="loggInnBrukernavn" value="">
				<br />
				<br />
				<h5>Passord</h5>
				<input type="password" name="loggInnPassord" value="">
			</div>
			<!-- Slutt på modal-body div -->
			<div class="modal-footer">
				<button class="loggInnKnapp" type="submit" name="LoggInnBtn">Logg Inn</button>
			</div>
		</div>
		<!-- Slutt på modal-content div -->
	</div>
	<!-- Slutt på loginModal div -->
	<div id="registrerModal" class="modal">
		<div class="modal-content">

			<div class="modal-header"> <span class="closeBtn">
				<h2>Registrer deg</h2>
				<h6>Trykk på utsiden av boksen for å lukke</h6>
			</div>
			<!--Slutt på modal-header div -->
			<div class="modal-body">
				<div class="container" style="float:right; position:relative; size:50%; font-size: 10px; color: Black;">
						<h4>Brukernavnet kan bare innholde bokstaver, tall, bindestreker og understreker.<br />
						Eposten kan bare innholde bokstaver, tall, bindestreker og understreker.<br />
						Passordet MÅ inneholde små bokstaver, store bokstaver og tall.<br />
						Passordene må være like.</h4>
					</div>
				<!--Slutt på info container div -->
				<div class="container">
				<form method="POST" onsubmit="return (validerRegForm(this));">
					<h4>Brukernavn</h4>
					<input type="text" name="RegistrerBrukernavn" value="">
					<h4>Epost</h4>
					<input type="text" name="RegistrerEpost" value="">
					<h4>Passord</h4>
					<input type="password" name="RegistrerPassord" value="">
					<h4>Passord igjen</h4>
					<input type="password" name="RegistrerPassordIgjen" value="">
					<button class="RegKnapp" type="submit" name="RegKnapp">Registrer deg</button>
				</form>
				</div>
				<!--Slutt på form container div -->
				<div class="validering" style="float: right; width:20%; font-size: 12px;">
						Brukernavnet kan bare innholde bokstaver, tall, bindestreker og understreker
						Eposten kan bare innholde bokstaver, tall, bindestreker og understreker
						Passordet MÅ inneholde små bokstaver, store bokstaver og tall
						Passordene må være like
				</div>
				<!--Slutt på validering div -->
			</div>
			<!-- Slutt på modal-body div -->
			<div class="modal-footer">

			</div>
			<!--Slutt på modal-footer div -->

		</div>
		<!-- Slutt på modal-content div -->
	</div>
	<!-- Slutt på registrerModal div -->
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8" crossorigin="anonymous"></script>
	<!--Skript for jQuery 3.3.1 minified -->
</body>

</html>
