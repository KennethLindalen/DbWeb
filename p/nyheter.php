<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Nederlaget IK - Nyheter</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bungee+Hairline|Open+Sans+Condensed:300|Open+Sans">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/modal.css">
	<script src="../skript/modal.js"></script>
</head>

<body>
	<header>
		<div class="container">
			<p>Logo</p>
			<h1><a href="../index.php">Nederlaget<br>Idrettsklubb</a></h1>
		</div>
		<!-- Slutt på header container div -->
	</header>
	<nav>
		<div class="container">
			<ul>
				<li><a href="nyheter.php">Nyheter</a>
				</li>
				<li><a href="aktiviteter.php">Aktiviteter</a>
				</li>
				<li><a href="resultater.php">Resultater</a>
				</li>
				<li><a href="#" onClick="openRegistrerModal()">Bli medlem</a>
				</li>
				<li><a href="#" onClick="openLoginModal()">Logg inn</a>
				</li>
			</ul>
		</div>
		<!-- Slutt på nav cointainer div -->
	</nav>
	<main>
		<div class="container">
			<article>
				<a href="#">
					<img class="article-image" src="../img/loss.jpg">
					<h2 class="article-header">Årsrapporten viser dystre tall</h2>
				</a>
			</article>
			<article>
				<a href="#">
					<img class="article-image" src="../img/football.jpg">
					<h2 class="article-header">Nytt nederlag - tapte 4-0 mot Svenseid IL</h2>
				</a>
			</article>
			<article>
				<a href="#">
					<img class="article-image" src="../img/moose.jpg">
					<h2 class="article-header">Orienteringsløpet avbrutt av illsint elg</h2>
				</a>
			</article>
			<article>
				<a href="#">
					<img class="article-image" src="../img/tennis.jpg">
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
			<div class="modal-header"> <span class="closeBtn"></span>
				<h2>Logg inn</h2>
				<h6>Trykk på utsiden av boksen for å lukke</h6>
			</div>
			<!-- Slutt på modal-header div -->
			<div class="modal-body">
				<h4>Brukernavn(e-post)</h4>
				<input type="text" name="loggInnBrukernavn" value="">
				<br />
				<br />
				<h5>Passord</h5>
				<input type="password" name="loggInnPassord" value="">
			</div>
			<!-- Slutt på modal-body div -->
			<div class="modal-footer">
				<button class="loggInnKnapp" type="button" name="LoggInnBtn">Logg Inn</button>
			</div>
			<!-- Slutt på modal-footer div -->
		</div>
		<!-- Slutt på modal-content div -->
	</div>
	<!-- Slutt på openLoginModal div -->
	<div id="registrerModal" class="modal">
		<div class="modal-content">
			<div class="modal-header"> <span class="closeBtn"></span>
				<h2>Registrer deg</h2>
				<h6>Trykk på utsiden av boksen for å lukke</h6>
			</div>
			<!-- Slutt på modal-header div -->
			<div class="modal-body">
				<h4>Brukernavn(e-post)</h4>
				<input type="text" name="RegistrerBrukernavn" value="">
				<br />
				<h4>Epost</h4>
				<input type="text" name="RegistrerBrukernavn" value="">
				<br />
				<h4>Passord</h4>
				<input type="password" name="RegistrerPassord" value="">
				<br />
				<h4>Passord igjen</h4>
				<input type="password" name="RegistrerPassordIgjen" value="">
			</div>
			<<!-- Slutt på modal-body div -->
				<div class="modal-footer">
					<button class="RegKnapp" type="button" name="RegKnapp">Registrer deg</button>
				</div>
				<!-- Slutt på modal-footer div -->
		</div>
		<!-- Slutt på modal-content div -->
	</div>
	<!-- Slutt på registrerModal div -->
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8" crossorigin="anonymous"></script>
	<!--Skript for jQuery 3.3.1 minified -->
</body>

</html>