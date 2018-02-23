</main>
<footer>
  <div class="container">
    <p>Footer</p>
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
