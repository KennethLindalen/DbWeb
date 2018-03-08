<?php

$feilmeldinger = [
	"0" => "Noe gikk galt",
	"1" => "Feil ved tilkobling til databasen",
	"2" => "Denne siden er kun tilgjengelig for klubbens medlemmer"
];

$feilmelding = $feilmeldinger[$_GET["id"] ?? 0] ?? $feilmeldinger[0];

?>

<!DOCTYPE html>
<html>
	<?php include "includes/head.php"; ?>
	<body>
		<?php include "includes/header.php"; ?>
		<?php include "includes/navbar.php"; ?>
		<main>
			<div class="container">
				<p><?= $feilmelding ?></p>
			</div>
		</main>
		<?php include "includes/footer.php"; ?>
	</body>
</html>
