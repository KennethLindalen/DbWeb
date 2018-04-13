<?php
  $tittel  = "Artikkel - Nederlaget Idrettsklubb";
  include "layout/førInnhold.php";
  include "kontrollere/artikkel.php";
  include "utils/funksjoner.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4"><?= rens($artikkel->tittel) ?></h1>
<hr>

<div class="col-10">
  <img class="img-fluid" src="<?= rens($artikkel->bildeUrl) ?>">
  <p class="lead my-4"><?= rens($artikkel->undertittel) ?></p>
  <p><?= rens($artikkel->innhold) ?></p>
  <p class="mt-5"><small>Skrevet av <?= $artikkel->getMedlem()->fulltNavn() ?></small></p>
</div>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
