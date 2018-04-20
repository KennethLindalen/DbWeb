<?php
  $tittel = "Nyheter - Nederlaget Idrettsklubb";
  include "kontrollere/nyheter.php";
  include "layout/førInnhold.php";
  include "utils/funksjoner.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Nyheter</h1>
<hr>

<div class="container">
  <div class="row">

    <?php if (sizeof($alleArtikler) == 0): ?>
      <p>Ingen artikler å vise.</p>
    <?php endif; ?>

    <?php foreach ($alleArtikler as $artikkel): ?>
  		<div class="col-12 col-lg-6 pb-3">
        <div class="card">
          <a href="artikkel.php?id=<?= $artikkel->artikkelkode ?>">
            <img class="card-img-top" src="<?= $artikkel->bildeUrl ?>" alt="<?= rens($artikkel->tittel) ?>">
            <div class="card-body">
              <h4 class="card-title"><?= $artikkel->tittel ?></h4>
              <p class="card-text"><?= $artikkel->undertittel ?></p>
            </div>
          </a>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

  <div class="row justify-content-center">
    <?php if ($side > 1): ?>
      <div class="col-2">
        <a href="nyheter.php?s=<?= $side - 1 ?>">Forrige side</a>
      </div>
    <?php endif; ?>
    <?php if (sizeof($alleArtikler) >= $artiklerPerSide): ?>
      <div class="col-2">
        <a href="nyheter.php?s=<?= $side + 1 ?>">Neste side</a>
      </div>
    <?php endif; ?>
  </div>

</div>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
