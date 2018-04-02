<?php
	$tittel = "Min side - Nederlaget Idrettsklubb";
	include "utils/krevMedlem.php";
	include "utils/minside.php";
	include "utils/funksjoner.php";
	include "layout/førInnhold.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Min side</h1>
<hr>



<div class="card mb-3">
  <div class="card-header" id="faktura-header">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#faktura-body">
        Faktura
      </button>
    </h5>
  </div>
  <div id="faktura-body" class="collapse">
    <div class="card-body">
      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header" id="endredata-header">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#endredata-body">
        Endre personopplysninger
      </button>
    </h5>
  </div>
  <div id="endredata-body" class="collapse <?= fraArray($_POST, "operasjon") == "endreMedlem" ? "show" : "" ?>">
    <div class="card-body col-7">

			<form method="post" name="endreMedlem" novalidate>

		    <div class="form-row">
			    <div class="form-group col-6">
			      <label for="fornavn">Fornavn</label>
			      <input
			        type="text" class="form-control"
			        name="fornavn" id="fornavn" placeholder="Fornavn"
			        value="<?= $medlem->fornavn ?>">
			      <div class="invalid-feedback"><?= fraArray($feil, "fornavn") ?></div>
			    </div>

		      <div class="form-group col-6">
		        <label for="etternavn">Etternavn</label>
		        <input
		          type="text" class="form-control <?= erGyldig("etternavn") ?>"
		          name="etternavn" id="etternavn" placeholder="Etternavn"
		          value="<?= $medlem->etternavn ?>">
		        <div class="invalid-feedback"><?= fraArray($feil, "etternavn") ?></div>
		      </div>
			  </div>

			  <div class="form-row">
		      <div class="form-group col-12">
		        <label for="adresse">Adresse</label>
		        <input
		          type="text" class="form-control <?= erGyldig("adresse") ?>"
		          name="adresse" id="adresse" placeholder="Adresse"
		          value="<?= $medlem->adresse ?>">
		        <div class="invalid-feedback"><?= fraArray($feil, "adresse") ?></div>
		      </div>
		    </div>

		    <div class="form-row">
		      <div class="form-group col-4">
		        <label for="postnummer">Postnummer</label>
		        <input
		          type="text" class="form-control <?= erGyldig("postnummer") ?>"
		          name="postnummer" id="postnummer" placeholder="Postnummer"
		          value="<?= $medlem->postnummer ?>">
		        <div class="invalid-feedback"><?= fraArray($feil, "postnummer") ?></div>
		      </div>

		      <div class="form-group col-8">
		        <label for="poststed">Sted</label>
		        <input
							type="text" class="form-control"
							name="poststed" id="poststed" placeholder="Sted"
							value="<?= $medlem->poststed ?>" disabled>
		      </div>
		    </div>

		    <div class="form-row">
		      <div class="form-group col-12">
		        <label for="telefonnummer">Telefonnummer</label>
		        <input
		          type="phone" class="form-control <?= erGyldig("telefonnummer") ?>"
		          name="telefonnummer" id="telefonnummer" placeholder="Telefonnummer"
		          value="<?= $medlem->telefonnummer ?>">
		        <div class="invalid-feedback"><?= fraArray($feil, "telefonnummer") ?></div>
		      </div>
		    </div>

		    <div class="form-row">
		      <div class="form-group col-12">
		        <label for="epost">E-postadresse</label>
		        <input
		          type="email" class="form-control <?= erGyldig("epost") ?>"
		          name="epost" id="epost" placeholder="E-postadresse"
		          value="<?= $medlem->epost ?>">
		        <div class="invalid-feedback"><?= fraArray($feil, "epost") ?></div>
		      </div>
		    </div>

		    <div class="row col-12 align-items-center">
					<input type="hidden" name="operasjon" value="endreMedlem">
		      <button class="btn btn-primary col-4" id="endreMedlem">Endre</button>
		      <div class="invalid-feedback col-8 m-0">Alle feltene må være gyldige.</div>
		    </div>
		  </form>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header" id="endrepassord-header">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#endrepassord-body">
        Endre passord
      </button>
    </h5>
  </div>
  <div id="endrepassord-body" class="collapse <?= fraArray($_POST, "operasjon") == "endrePassord" ? "show" : "" ?>">
    <div class="card-body col-6">

			<form method="post" name="endrePassord" novalidate>
				<div class="form-row">
					<div class="form-group col-6">
						<label for="gammeltPassord">Gammelt passord</label>
						<input
							type="password" class="form-control <?= erGyldig("autentisering") ?>"
							name="gammeltPassord" id="gammeltPassord" placeholder="Passord">
						<div class="invalid-feedback"><?= fraArray($feil, "autentisering") ?></div>
					</div>
				</div>

				<div class="form-row">
		      <div class="form-group col-6">
		        <label for="passord">Nytt passord</label>
		        <input
		          type="password" class="form-control <?= erGyldig("passord") ?>"
		          name="passord" id="passord" placeholder="Passord">
		        <div class="invalid-feedback"><?= fraArray($feil, "passord") ?></div>
		      </div>

		      <div class="form-group col-6">
		        <label for="passord2">Gjenta nytt passord</label>
		        <input
		          type="password" class="form-control <?= erGyldig("passord2") ?>"
		          name="passord2" id="passord2" placeholder="Gjenta passord">
		        <div class="invalid-feedback"><?= fraArray($feil, "passord2") ?></div>
		      </div>
		    </div>

				<div class="row col-12 align-items-center">
					<input type="hidden" name="operasjon" value="endrePassord">
					<button class="btn btn-primary col-4" id="endrePassord">Endre</button>
					<div class="invalid-feedback col-8 m-0">Alle feltene må være gyldige.</div>
				</div>
			</form>

    </div>
  </div>
</div>

<script src="js/validerMedlem.js"></script>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
