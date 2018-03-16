<?php include_once "utils/beskyttet.php"; ?>
<?php include_once "models/Medlem.php"; ?>
<?php $medlem = Medlem::finn($_SESSION["medlemsnummer"]);	?>

<!DOCTYPE html>
<html>
	<?php include "includes/head.php"; ?>
	<body>
		<?php include "includes/header.php"; ?>
		<?php include "includes/navbar.php"; ?>
		<main>
			<div class="container">
				<h1>Min side</h1>
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

			</div>
		</main>
		<?php include "includes/footer.php"; ?>
	</body>
</html>
