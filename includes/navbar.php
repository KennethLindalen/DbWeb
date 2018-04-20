<?php
  // Krever tilgang til sesjonsvariabler for å avgjøre om bruker er innlogget.
  include_once "utils/session.php";

  // Klassenavn "active" settes på navlinken som tilsvarer siden bruker er på.
  function erAktiv($side) {
    return $side == basename($_SERVER["SCRIPT_NAME"], ".php") ? "active" : "";
  }
?>

<nav class="navbar navbar-expand navbar-light p-0 flex-column border-bottom align-items-start">

  <span class="navbar-text text-uppercase">Navigasjon</span>
  <ul class="nav nav-pills flex-column w-100 mb-3">
    <li class="nav-item">
      <a class="nav-link <?= erAktiv("nyheter") ?>" href="nyheter.php">Nyheter</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= erAktiv("timeplan") ?>" href="timeplan.php">Timeplan</a>
    </li>
  </ul>

  <?php if ($_SESSION["administrator"]): ?>
    <span class="navbar-text text-uppercase">Administrator</span>
    <ul class="nav nav-pills flex-column w-100 mb-3">
      <li class="nav-item">
        <a class="nav-link <?= erAktiv("administrasjon") ?>" href="administrasjon.php">Administrasjon</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= erAktiv("administrasjon-nyheter") ?>" href="administrasjon-nyheter.php">Endre nyheter</a>
      </li>
    </ul>
  <?php endif; ?>

  <span class="navbar-text text-uppercase">Medlemmer</span>
  <ul class="nav nav-pills flex-column w-100 mb-3">
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
