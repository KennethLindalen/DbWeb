<?php
  $tittel = "Administrasjon - Nederlaget Idrettsklubb";
  include "utils/krevAdmin.php";
  include "utils/funksjoner.php";
  include "kontrollere/administrasjonNyheter.php";
  include "layout/førInnhold.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Administrasjon - Nyheter</h1>
<hr>

<?php if (!empty($feil)): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <p>Feil oppstod under forrige operasjon:</p>
    <ul>
      <?php foreach ($feil as $melding): ?>
        <li><?= $melding ?></li>
      <?php endforeach; ?>
    </ul>
    <button class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
<?php endif; ?>

<div class="card mb-3">
  <div class="card-header" id="nyArtikkel-header">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#nyArtikkel-body">
        Legg til ny artikkel
      </button>
    </h5>
  </div>
  <div id="nyArtikkel-body" class="collapse <?= kategoriErValgt("nyArtikkel") ?>">
    <div class="card-body">

      <form method="post">
        <div class="form-row">
          <div class="form-group col-12">
            <label for="fornavn">Tittel</label>
            <input
              type="text" class="form-control valideres"
              name="tittel" id="tittel" placeholder="Tittel"
              value="<?= sizeof($feil) > 0 ? rens($_POST["tittel"]) : "" ?>">
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-12">
            <label for="fornavn">Undertittel</label>
            <input
              type="text" class="form-control valideres "
              name="undertittel" id="undertittel" placeholder="Undertittel"
              value="<?= sizeof($feil) > 0 ? rens($_POST["undertittel"]) : "" ?>">
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-12">
            <label for="fornavn">Innhold</label>
            <textarea class="form-control valideres" name="innhold" id="innhold" placeholder="Innhold"><?= sizeof($feil) > 0 ? rens($_POST["innhold"]) : "" ?></textarea>
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-12">
            <label for="fornavn">URL for bilde</label>
            <input
              type="text" class="form-control valideres"
              name="bildeUrl" id="bildeUrl" placeholder="URL"
              value="<?= sizeof($feil) > 0 ? rens($_POST["bildeUrl"]) : "" ?>">
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div class="row col-6 align-items-center">
          <input type="hidden" name="operasjon" value="nyArtikkel">
          <button class="btn btn-primary col-4" id="nyArtikkel">Legg til</button>
          <div class="invalid-feedback col-8 m-0">Alle feltene må være gyldige.</div>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header" id="slettArtikkel-header">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#slettArtikkel-body">
        Slett artikkel
      </button>
    </h5>
  </div>
  <div id="slettArtikkel-body" class="collapse <?= kategoriErValgt("slettArtikkel") ?>">
    <div class="card-body mb-0">

      <form method="post">
				<div class="row">
					<div class="input-group mb-3 col-10">
						<div class="input-group-prepend">
							<label class="input-group-text" for="velgArtikkel">Velg artikkel</label>
						</div>
            <select class="custom-select" id="velgArtikkel" name="artikkelkode">
              <?php foreach($alleArtikler as $artikkel): ?>
                <option value="<?= $artikkel->artikkelkode ?>"><?= $artikkel->tittel ?></option>
              <?php endforeach; ?>
            </select>
					</div>
					<div class="input-group mb-3 col-2">
            <input type="hidden" name="operasjon" value="slettArtikkel">
						<button name="button" class="btn btn-outline-primary">Slett</button>
					</div>
				</div>
			</form>

    </div>
  </div>
</div>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
