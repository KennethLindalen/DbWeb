<?php
  $tittel = "Registrering - Nederlaget Idrettsklubb";
  include "layout/førInnhold.php";
  include "utils/registrering.php";
  include "utils/funksjoner.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Registrering</h1>
<hr>

<div class="w-50">
  <div class="alert alert-primary">
    Fyll ut skjemaet for å bli medlem i klubben. <br> Medlemskap koster kr 100,- per måned.
  </div>

  <form method="post" name="nyttMedlem" novalidate>
    <div class="form-row">

      <div class="form-group col-6">
        <label for="fornavn">Fornavn</label>
        <input
          type="text" class="form-control valideres <?= erGyldig("fornavn") ?>"
          name="fornavn" id="fornavn" placeholder="Fornavn"
          value="<?= fraArray($_POST, "fornavn") ?>">
        <div class="invalid-feedback"><?= fraArray($feil, "fornavn") ?></div>
      </div>

      <div class="form-group col-6">
        <label for="etternavn">Etternavn</label>
        <input
          type="text" class="form-control valideres <?= erGyldig("etternavn") ?>"
          name="etternavn" id="etternavn" placeholder="Etternavn"
          value="<?= fraArray($_POST, "etternavn") ?>">
        <div class="invalid-feedback"><?= fraArray($feil, "etternavn") ?></div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-12">
        <label for="adresse">Adresse</label>
        <input
          type="text" class="form-control valideres <?= erGyldig("adresse") ?>"
          name="adresse" id="adresse" placeholder="Adresse"
          value="<?= fraArray($_POST, "adresse") ?>">
        <div class="invalid-feedback"><?= fraArray($feil, "adresse") ?></div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-4">
        <label for="postnummer">Postnummer</label>
        <input
          type="text" class="form-control valideres <?= erGyldig("postnummer") ?>"
          name="postnummer" id="postnummer" placeholder="Postnummer"
          value="<?= fraArray($_POST, "postnummer") ?>">
        <div class="invalid-feedback"><?= fraArray($feil, "postnummer") ?></div>
      </div>

      <div class="form-group col-8">
        <label for="poststed">Sted</label>
        <input type="text" class="form-control" name="poststed" id="poststed" placeholder="Sted" disabled>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-12">
        <label for="telefonnummer">Telefonnummer</label>
        <input
          type="phone" class="form-control valideres <?= erGyldig("telefonnummer") ?>"
          name="telefonnummer" id="telefonnummer" placeholder="Telefonnummer"
          value="<?= fraArray($_POST, "telefonnummer") ?>">
        <div class="invalid-feedback"><?= fraArray($feil, "telefonnummer") ?></div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-12">
        <label for="epost">E-postadresse</label>
        <input
          type="email" class="form-control valideres <?= erGyldig("epost") ?>"
          name="epost" id="epost" placeholder="E-postadresse"
          value="<?= fraArray($_POST, "epost") ?>">
        <div class="invalid-feedback"><?= fraArray($feil, "epost") ?></div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-6">
        <label for="passord">Passord</label>
        <input
          type="password" class="form-control valideres <?= erGyldig("passord") ?>"
          name="passord" id="passord" placeholder="Passord">
        <div class="invalid-feedback"><?= fraArray($feil, "passord") ?></div>
      </div>

      <div class="form-group col-6">
        <label for="passord2">Gjenta passord</label>
        <input
          type="password" class="form-control valideres <?= erGyldig("passord2") ?>"
          name="passord2" id="passord2" placeholder="Gjenta passord">
        <div class="invalid-feedback"><?= fraArray($feil, "passord2") ?></div>
      </div>

    </div>

    <div class="form-group row col-12 align-items-center">
      <button class="btn btn-primary col-4" id="nyttMedlem">Bli medlem</button>
      <div class="invalid-feedback col-8 m-0">Alle feltene må være gyldige.</div>
    </div>
  </form>

</div>

<script src="js/validerMedlem.js"></script>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
