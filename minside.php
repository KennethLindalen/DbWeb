<?php
	include_once "utils/krevMedlem.php";
	include_once "models/Medlem.php";
	$medlem = Medlem::finn($_SESSION["medlemsnummer"]);

	$tittel = "Min side - Nederlaget Idrettsklubb";
	include "layout/førInnhold.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Min side</h1>
<hr>

<div>
	<p>Medlemsnummer: <?= $medlem->medlemsnummer; ?></p>
	<p>Fornavn: <?= $medlem->fornavn; ?></p>
	<p>Etternavn: <?= $medlem->etternavn; ?></p>
	<p>Adresse: <?= $medlem->adresse; ?></p>
	<p>Postnummer: <?= $medlem->postnummer; ?></p>
	<p>Poststed: <?= $medlem->poststed; ?></p>
	<p>Telefonnummer: <?= $medlem->telefonnummer; ?></p>
	<p>E-postadresse: <?= $medlem->epost; ?></p>
</div>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
