<?php
  $tittel = "Registrering - Nederlaget Idrettsklubb";
  include "layout/førInnhold.php";
  include "utils/registrering.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Registrering</h1>
<hr>

<div class="w-50">
  <div class="alert alert-primary">
    Fyll ut skjemaet for å bli medlem i klubben. <br> Medlemskap koster kr 100,- per måned.
  </div>

  <form method="post" novalidate>
    <div class="form-row">

      <div class="form-group col-6">
        <label for="fornavn">Fornavn</label>
        <input
          type="text" class="form-control <?= erGyldig("fornavn") ?>"
          name="fornavn" id="fornavn" placeholder="Fornavn"
          value="<?= $_POST["fornavn"] ?? "" ?>">
        <div class="invalid-feedback"><?= $feil["fornavn"] ?? "" ?></div>
      </div>

      <div class="form-group col-6">
        <label for="etternavn">Etternavn</label>
        <input
          type="text" class="form-control <?= erGyldig("etternavn") ?>"
          name="etternavn" id="etternavn" placeholder="Etternavn"
          value="<?= $_POST["etternavn"] ?? "" ?>">
        <div class="invalid-feedback"><?= $feil["etternavn"] ?? "" ?></div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-12">
        <label for="adresse">Adresse</label>
        <input
          type="text" class="form-control <?= erGyldig("adresse") ?>"
          name="adresse" id="adresse" placeholder="Adresse"
          value="<?= $_POST["adresse"] ?? "" ?>">
        <div class="invalid-feedback"><?= $feil["adresse"] ?? "" ?></div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-4">
        <label for="postnummer">Postnummer</label>
        <input
          type="text" class="form-control <?= erGyldig("postnummer") ?>"
          name="postnummer" id="postnummer" placeholder="Postnummer"
          value="<?= $_POST["postnummer"] ?? "" ?>">
        <div class="invalid-feedback"><?= $feil["postnummer"] ?? "" ?></div>
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
          type="phone" class="form-control <?= erGyldig("telefonnummer") ?>"
          name="telefonnummer" id="telefonnummer" placeholder="Telefonnummer"
          value="<?= $_POST["telefonnummer"] ?? "" ?>">
        <div class="invalid-feedback"><?= $feil["telefonnummer"] ?? "" ?></div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-12">
        <label for="epost">E-postadresse</label>
        <input
          type="email" class="form-control <?= erGyldig("epost") ?>"
          name="epost" id="epost" placeholder="E-postadresse"
          value="<?= $_POST["epost"] ?? "" ?>">
        <div class="invalid-feedback"><?= $feil["epost"] ?? "" ?></div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col-6">
        <label for="passord">Passord</label>
        <input
          type="password" class="form-control <?= erGyldig("passord") ?>"
          name="passord" id="passord" placeholder="Passord">
        <div class="invalid-feedback"><?= $feil["passord"] ?? "" ?></div>
      </div>

      <div class="form-group col-6">
        <label for="passord2">Gjenta passord</label>
        <input
          type="password" class="form-control <?= erGyldig("passord2") ?>"
          name="passord2" id="passord2" placeholder="Gjenta passord">
        <div class="invalid-feedback"><?= $feil["passord2"] ?? "" ?></div>
      </div>

    </div>

    <div class="form-group row col-12 align-items-center">
      <button class="btn btn-primary col-4" id="submit">Bli medlem</button>
      <div class="invalid-feedback col-8 m-0">Alle feltene må være gyldige.</div>
    </div>
  </form>

</div>

<script src="js/validerRegistrering.js"></script>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
