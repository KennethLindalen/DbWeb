<?php
	$tittel = "Min side - Nederlaget Idrettsklubb";
	include "utils/krevMedlem.php";
	include "kontrollere/minside.php";
	include "layout/førInnhold.php";

	include_once "utils/cache.php";
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
  <div id="faktura-body" class="collapse <?= kategoriErValgt("faktura") ?>">
    <div class="card-body">

			<form method="post">
				<div class="row">
					<div class="input-group mb-3 col-6">
						<div class="input-group-prepend">
							<label class="input-group-text" for="velgMåned">Velg måned</label>
						</div>
						<input type="hidden" name="operasjon" value="faktura">
						<input type="month" class="form-control" name="måned" id="velgMåned" value="<?= $valgtMåned ?>">
					</div>
					<div class="input-group mb-3 col-2 offset-4">
						<button name="button" class="btn btn-outline-primary">Vis faktura</button>
					</div>
				</div>
			</form>

			<?php if (isset($reservasjoner)): ?>
				<div class="container">
					<div class="row">
						<table class="table table-sm border mb-0">
							<thead class="thead-light">
								<tr>
									<th colspan="4">Faste kostnader</th>
									<th>Beløp</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="4">Medlemskontingent</td>
									<td>kr 100,-</td>
								</tr>
							</tbody>
							<thead class="thead-light">
								<tr>
									<th colspan="5">Reservasjoner</th>
								</tr>
							</thead>
							<tbody>
								<?php if (sizeof($reservasjoner) == 0): ?>
									<tr>
										<td colspan="5">Ingen reservasjoner denne måned.</td>
									</tr>
								<?php endif; ?>
								<?php foreach ($reservasjoner as $reservasjon): ?>
									<tr>
										<td class="dato" style="width: 20%;"><?= $reservasjon->dato ?></td>
										<td style="width: 20%;"><?= $reservasjon->time ?>:00 - <?= $reservasjon->time + 1 ?>:00</td>
										<td><?= $reservasjon->getAnlegg()->getIdrett()->navn ?></td>
										<td><?= $reservasjon->getAnlegg()->navn ?></td>
										<td style="width: 20%;">kr <?= $reservasjon->getAnlegg()->timepris ?>,-</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
							<thead class="thead-light">
								<tr>
									<th class="border-0" colspan="4">Totalt utestående beløp</th>
									<th class="border-0">kr <?= $sum ?>,-</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			<?php endif; ?>

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
  <div id="endredata-body" class="collapse <?= kategoriErValgt("endreMedlem") ?>">
    <div class="card-body col-7">

			<form method="post" name="endreMedlem" novalidate>

		    <div class="form-row">
			    <div class="form-group col-6">
			      <label for="fornavn">Fornavn</label>
			      <input
			        type="text" class="form-control valideres <?= inputErGyldig("fornavn") ?>"
			        name="fornavn" id="fornavn" placeholder="Fornavn"
			        value="<?= $medlem->fornavn ?>">
			      <div class="invalid-feedback"><?= fraArray($feil, "fornavn") ?></div>
			    </div>

		      <div class="form-group col-6">
		        <label for="etternavn">Etternavn</label>
		        <input
		          type="text" class="form-control valideres <?= inputErGyldig("etternavn") ?>"
		          name="etternavn" id="etternavn" placeholder="Etternavn"
		          value="<?= $medlem->etternavn ?>">
		        <div class="invalid-feedback"><?= fraArray($feil, "etternavn") ?></div>
		      </div>
			  </div>

			  <div class="form-row">
		      <div class="form-group col-12">
		        <label for="adresse">Adresse</label>
		        <input
		          type="text" class="form-control valideres <?= inputErGyldig("adresse") ?>"
		          name="adresse" id="adresse" placeholder="Adresse"
		          value="<?= $medlem->adresse ?>">
		        <div class="invalid-feedback"><?= fraArray($feil, "adresse") ?></div>
		      </div>
		    </div>

		    <div class="form-row">
		      <div class="form-group col-4">
		        <label for="postnummer">Postnummer</label>
		        <input
		          type="text" class="form-control valideres <?= inputErGyldig("postnummer") ?>"
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
		          type="tel" class="form-control valideres <?= inputErGyldig("telefonnummer") ?>"
		          name="telefonnummer" id="telefonnummer" placeholder="Telefonnummer"
		          value="<?= $medlem->telefonnummer ?>">
		        <div class="invalid-feedback"><?= fraArray($feil, "telefonnummer") ?></div>
		      </div>
		    </div>

		    <div class="form-row">
		      <div class="form-group col-12">
		        <label for="epost">E-postadresse</label>
		        <input
		          type="email" class="form-control valideres <?= inputErGyldig("epost") ?>"
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
  <div id="endrepassord-body" class="collapse <?= kategoriErValgt("endrePassord") ?>">
    <div class="card-body col-6">

			<form method="post" name="endrePassord" novalidate>
				<div class="form-row">
					<div class="form-group col-6">
						<label for="gammeltPassord">Gammelt passord</label>
						<input
							type="password" class="form-control <?= inputErGyldig("autentisering") ?>"
							name="gammeltPassord" id="gammeltPassord" placeholder="Passord">
						<div class="invalid-feedback"><?= fraArray($feil, "autentisering") ?></div>
					</div>
				</div>

				<div class="form-row">
		      <div class="form-group col-6">
		        <label for="passord">Nytt passord</label>
		        <input
		          type="password" class="form-control <?= inputErGyldig("passord") ?>"
		          name="passord" id="passord" placeholder="Passord">
		        <div class="invalid-feedback"><?= fraArray($feil, "passord") ?></div>
		      </div>

		      <div class="form-group col-6">
		        <label for="passord2">Gjenta nytt passord</label>
		        <input
		          type="password" class="form-control <?= inputErGyldig("passord2") ?>"
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
<script src="js/behandleDato.js"></script>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
