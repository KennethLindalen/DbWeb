<?php include_once "utils/session.php"; ?>

<nav>
  <div class="container">
    <ul>
      <li><a href="/nyheter.php">Nyheter</a></li>
      <li><a href="/aktiviteter.php">Aktiviteter</a></li>
      <li><a href="/resultater.php">Resultater</a></li>
      <?php if ($_SESSION["medlemsnummer"]): ?>
        <li><a href="/minside.php">Min side</a></li>
        <li><a href="/utlogging.php">Logg ut</a></li>
      <?php else: ?>
        <li><a href="/registrering.php">Bli medlem</a></li>
        <li><a href="/innlogging.php">Logg inn</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
