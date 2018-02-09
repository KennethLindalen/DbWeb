<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Nederlaget IK</title>
	<link href="https://fonts.googleapis.com/css?family=Bungee+Hairline|Open+Sans+Condensed:300|Open+Sans" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<link href="../css/modal.css" rel="stylesheet" type="text/css">
	<script src="../skript/modal.js"></script>
</head>

<body>
	<header>
		<div class="container">
			<p>Logo</p>
			<h1><a href="../index.php">Nederlaget<br>
			Idrettsklubb</a>
			</h1>
		</div>
		<!-- Slutt på header container div -->
	</header>
	<nav>
		<div class="container">
			<ul>
				<li>	<a href="nyheter.php">Nyheter</a>
				</li>
				<li>	<a href="aktiviteter.php">Aktiviteter</a>
				</li>
				<li>	<a href="resultater.php">Resultater</a>
				</li>
				<li>	<a href="#" onclick="openRegistrerModal()">Bli medlem</a>
				</li>
				<li>	<a href="#" onclick="openLoginModal()">Logg inn</a>
				</li>
			</ul>
		</div>
		<!-- Slutt på nav container div -->
	</nav>
	<main>
		<div class="container">
			<div class="card">
				<div class="card-body">
					<h3>Fotballturnering for barn 10-14år!</h3>
					<h6>Vi inviterer til Fotballturnering for barn. Pølser og sjokolademelk til alle</h6>
					<p>Fredag 14.06.17</p>
				</div>
				<!-- Slutt på card-body div -->
			</div>
			<!-- Slutt på card div -->
			<div class="card">
				<div class="card-body">
					<h3>Pølsefest!</h3>
					<h6>Vi skal grille pølser.</h6>
					<p>Torsdag 13.06.22</p>
				</div>
				<!-- Slutt på card-body div -->
			</div>
			<!-- Slutt på card div -->
			<div class="card">
				<div class="card-body">
					<h3>Spionering på Svenseid IL</h3>
					<h6>Svenseid IL kan ikke slå oss lenger, vi må lære hvordan de trener!</h6>
					<p>Når enn de har trenings</p>
				</div>
				<!-- Slutt på card-body div -->
			</div>
			<!-- Slutt på card div -->
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
	<div class="modal" id="loginModal">
		<div class="modal-content">
			<div class="modal-header">	<span class="closeBtn"></span>
				<h2>Logg inn</h2>
				<h6>Trykk på utsiden av boksen for å lukke</h6>
			</div>
			<!-- Slutt på modal-header div -->
			<div class="modal-body">
				<h4>Brukernavn(e-post)</h4>
				<input name="loggInnBrukernavn" type="text" value="">
				<br>
				<br>
				<h5>Passord</h5>
				<input name="loggInnPassord" type="password" value="">
			</div>
			<!-- Slutt på modal-body div -->
			<div class="modal-footer">
				<button class="loggInnKnapp" name="LoggInnBtn" type="button">Logg Inn</button>
			</div>
			<!-- Slutt på modal-footer div -->
		</div>
		<!-- Slutt på modal-content div -->
	</div>
	<!-- Slutt på loginModal div -->
	<div class="modal" id="registrerModal">
		<div class="modal-content">
			<div class="modal-header">	<span class="closeBtn"></span>
				<h2>Registrer deg</h2>
				<h6>Trykk på utsiden av boksen for å lukke</h6>
			</div>
			<!-- Slutt på modal-header div -->
			<div class="modal-body">
				<h4>Brukernavn(e-post)</h4>
				<input name="RegistrerBrukernavn" type="text" value="">
				<br>
				<h4>Epost</h4>
				<input name="RegistrerBrukernavn" type="text" value="">
				<br>
				<h4>Passord</h4>
				<input name="RegistrerPassord" type="password" value="">
				<br>
				<h4>Passord igjen</h4>
				<input name="RegistrerPassordIgjen" type="password" value="">
			</div>
			<!-- Slutt på modal-body div -->
			<div class="modal-footer">
				<button class="RegKnapp" name="RegKnapp" type="button">Registrer deg</button>
			</div>
			<!-- Slutt på modal-footer div -->
		</div>
		<!-- Slutt på modal-content div -->
	</div>
	<!-- Slutt på registrerModal div -->
	<script crossorigin="anonymous" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8" src="http://code.jquery.com/jquery-3.3.1.min.js">
	</script>
	<!--Skript for jQuery 3.3.1 minified -->
</body>

</html>
