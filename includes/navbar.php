<?php include_once "utils/session.php"; ?>

<nav class="navbar navbar-expand navbar-light p-0 flex-column border-bottom">
  <ul class="nav nav-pills flex-column w-100 mb-3">
    <span class="navbar-text text-uppercase">Navigasjon</span>
    <li class="nav-item"><a class="nav-link" href="nyheter.php">Nyheter</a></li>
    <li class="nav-item"><a class="nav-link" href="aktiviteter.php">Aktiviteter</a></li>
    <li class="nav-item"><a class="nav-link" href="bestilling.php">Banebestilling</a></li>
  </ul>
  <ul class="nav nav-pills flex-column w-100 mb-3">
    <span class="navbar-text text-uppercase">Medlemmer</span>
  <?php if ($_SESSION["medlemsnummer"]): ?>
    <li class="nav-item"><a class="nav-link" href="minside.php">Min side</a></li>
    <li class="nav-item"><a class="nav-link" href="faktura.php">Faktura</a></li>
    <li class="nav-item"><a class="nav-link" href="utlogging.php">Logg ut</a></li>
  <?php else: ?>
    <li class="nav-item"><a class="nav-link" href="registrering.php">Bli medlem</a></li>
    <li class="nav-item"><a class="nav-link" href="innlogging.php">Logg inn</a></li>
  <?php endif; ?>
  </ul>
</nav>
