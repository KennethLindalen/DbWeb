<?php
  // Krever tilgang til sesjonsvariabler for å avgjøre om bruker er innlogget.
  include_once "utils/session.php";

  // Klassenavn "active" settes på navlinken som tilsvarer siden bruker er på.
  function erAktiv($side) {
    return $side == basename($_SERVER["SCRIPT_NAME"], ".php") ? "active" : "";
  }
?>

<nav class="navbar navbar-expand navbar-light p-0 flex-column border-bottom">

  <ul class="nav nav-pills flex-column w-100 mb-3">
    <span class="navbar-text text-uppercase">Navigasjon</span>
    <li class="nav-item">
      <a class="nav-link <?= erAktiv("nyheter") ?>" href="nyheter.php">Nyheter</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= erAktiv("aktiviteter") ?>" href="aktiviteter.php">Aktiviteter</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= erAktiv("timeplan") ?>" href="timeplan.php">Timeplan</a>
    </li>
  </ul>

  <?php if ($_SESSION["administrator"]): ?>
    <ul class="nav nav-pills flex-column w-100 mb-3">
      <span class="navbar-text text-uppercase">Administrator</span>
      <li class="nav-item">
        <a class="nav-link <?= erAktiv("administrasjon") ?>" href="administrasjon.php">Administrasjon</a>
      </li>
    </ul>
  <?php endif; ?>

  <ul class="nav nav-pills flex-column w-100 mb-3">
    <span class="navbar-text text-uppercase">Medlemmer</span>
  <?php if ($_SESSION["medlemsnummer"]): ?>
    <li class="nav-item">
      <a class="nav-link <?= erAktiv("minside") ?>" href="minside.php">Min side</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="utlogging.php">Logg ut</a>
    </li>
  <?php else: ?>
    <li class="nav-item">
      <a class="nav-link <?= erAktiv("registrering") ?>" href="registrering.php">Bli medlem</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= erAktiv("innlogging") ?>" href="innlogging.php">Logg inn</a>
    </li>
  <?php endif; ?>
  </ul>

</nav>
