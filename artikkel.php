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

<!--Nederlaget IK tapte 4-0 for tabelljumbo Svenseid IL
NIK hold unna lenge for tabelljumboen Svenseid men måtte til slutt
gi tapt for overmakten med scoringer i det 86, 87, 88 og 89. minutt.
Dagens Nederlagsmann ble Bjartmar Olsen med sine 2 selvmål og rødt kort-->



<!--Tennisbanene er åpnet
Med god støtte fra Conrad Pløsen og hans elleville Lamborghinitraktor er endelig sneen
borte fra Tennisbanen. Dette feirer vi med "serveoff" neste lørdag klokka 12
på tennisbanen med kanapeer, det vil bla satt opp egne ladestasjoner for
teslaer i denne anledning. antrekk: lacoste
-->

<!--Orienteringsløpet avbrutt
Orienteringsløpet sist søndag ble avbrutt etter at en løper ved en av postene
løp på en fødende elgku. Hannen tok grep og kastet løperen buskimellom
Løpsadministrasjonen valgte derfor å avbryte løpet med hensyn til den fødende-->


<!-- Årsrapporten for 2017
I riktig nederlagsånd viser det seg at klubben er på kanten av av
økonomisk ruin. utgifter til kanapeer og strøm til lading av el bil er
de største utgiftspostene-->
