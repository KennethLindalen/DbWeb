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
			<h1><a href="index.php">Nederlaget<br>Idrettsklubb</a></h1>
		</div>
		<!-- Slutt på header container div -->
	</header>
	<nav>
		<div class="container">
			<ul>
				<li><a href="p/nyheter.php">Nyheter</a>
				</li>
				<li><a href="p/aktiviteter.php">Aktiviteter</a>
				</li>
				<li><a href="p/resultater.php">Resultater</a>
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
				<h4>Brukernavn(e-post)</h4>
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
					</div>
				<!--Slutt på info container div -->
				<div class="container">
					<form id="myForm" method="POST" action="...">
							<p>Username: <input id="field_username" title="Username must not be blank and contain only letters, numbers and underscores." type="text" required pattern="\w+" name="username"></p>
							<p>Password: <input id="field_pwd1" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1"></p>
							<p>Confirm Password: <input id="field_pwd2" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2"></p>
							<p><input type="submit" value="Submit"></p>
					</form>
				</div>
				<!--Slutt på form container div -->
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

	<script type="text/javascript">

  document.addEventListener("DOMContentLoaded", function() {

    // JavaScript form validation

    var checkPassword = function(str)
    {
      var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
      return re.test(str);
    };

    var checkForm = function(e)
    {
      if(this.username.value == "") {
        alert("Error: Username cannot be blank!");
        this.username.focus();
        e.preventDefault(); // equivalent to return false
        return;
      }
      re = /^\w+$/;
      if(!re.test(this.username.value)) {
        alert("Error: Username must contain only letters, numbers and underscores!");
        this.username.focus();
        e.preventDefault();
        return;
      }
      if(this.pwd1.value != "" && this.pwd1.value == this.pwd2.value) {
        if(!checkPassword(this.pwd1.value)) {
          alert("The password you have entered is not valid!");
          this.pwd1.focus();
          e.preventDefault();
          return;
        }
      } else {
        alert("Error: Please check that you've entered and confirmed your password!");
        this.pwd1.focus();
        e.preventDefault();
        return;
      }
      alert("Both username and password are VALID!");
    };

    var myForm = document.getElementById("myForm");
    myForm.addEventListener("submit", checkForm, true);

    // HTML5 form validation

    var supports_input_validity = function()
    {
      var i = document.createElement("input");
      return "setCustomValidity" in i;
    }

    if(supports_input_validity()) {
      var usernameInput = document.getElementById("field_username");
      usernameInput.setCustomValidity(usernameInput.title);

      var pwd1Input = document.getElementById("field_pwd1");
      pwd1Input.setCustomValidity(pwd1Input.title);

      var pwd2Input = document.getElementById("field_pwd2");

      // input key handlers

      usernameInput.addEventListener("keyup", function(e) {
        usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
      }, false);

      pwd1Input.addEventListener("keyup", function(e) {
        this.setCustomValidity(this.validity.patternMismatch ? pwd1Input.title : "");
        if(this.checkValidity()) {
          pwd2Input.pattern = RegExp.escape(this.value);
          pwd2Input.setCustomValidity(pwd2Input.title);
        } else {
          pwd2Input.pattern = this.pattern;
          pwd2Input.setCustomValidity("");
        }
      }, false);

      pwd2Input.addEventListener("keyup", function(e) {
        this.setCustomValidity(this.validity.patternMismatch ? pwd2Input.title : "");
      }, false);

    }

  }, false);

</script>

</body>

</html>
