<?php
  $tittel  = "Innlogging - Nederlaget Idrettsklubb";
  include "layout/førInnhold.php";
  include "utils/innlogging.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Logg inn</h1>
<hr>

<div class="w-50">
  <div class="alert alert-primary">
    Logg inn for å få tilgang til alle funksjoner.
  </div>

  <?php if (isset($feil["autentisering"])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
      <span><?= $feil["autentisering"] ?></span>
      <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <form method="post">
    <div class="form-row">
      <div class="form-group col-12">
        <label for="identifikator">E-postadresse</label>
        <input type="text" name="identifikator" id="identifikator" class="form-control" placeholder="E-postadresse" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-12">
        <label for="passord">Passord</label>
        <input type="password" name="passord" id="passord" class="form-control" placeholder="Passord" required>
      </div>
    </div>

    <button class="btn btn-primary mb-3" type="submit">Logg inn</button>

  </form>
</div>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
