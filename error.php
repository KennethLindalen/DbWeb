<?php
	$feilmeldinger = [
		"0" => "Noe gikk galt.",
		"1" => "Feil ved tilkobling til databasen.",
		"2" => "Du må være innlogget for å vise denne siden.",
		"3" => "Denne siden er kun tilgjengelig for administrator.",
		"4" => "Artikkelen du spurte etter finnes ikke."
	];
	$feilmelding = $feilmeldinger[$_GET["id"] ?? 0] ?? $feilmeldinger[0];

	$tittel = "Feil - Nederlaget Idrettsklubb";
  include "layout/førInnhold.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Oops!</h1>
<hr>
<p><?= $feilmelding ?></p>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
