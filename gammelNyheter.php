<?php
  $tittel = "Nyheter - Nederlaget Idrettsklubb";
  include "layout/førInnhold.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Nyheter</h1>
<hr>

<div class="container">
  <div class="row">

		<div class="col-12 col-lg-6 pb-3">
      <div class="card">
        <a href="#">
          <img class="card-img-top" src="img/football.jpg">
          <div class="card-body">
            <h4 class="card-title">Nytt nederlag</h4>
            <p class="card-text">Tapte 4-0 mot Svenseid IL</p>
          </div>
        </a>
      </div>
    </div>

    <div class="col-12 col-lg-6 pb-3">
      <div class="card">
        <a href="#">
          <img class="card-img-top" src="img/tennis.jpg">
          <div class="card-body">
            <h4 class="card-title">Tennisbanen er åpen</h4>
            <p class="card-text">Sesongen er i gang</p>
          </div>
        </a>
      </div>
    </div>

    <div class="col-12 col-lg-6 pb-3">
      <div class="card">
        <a href="#">
          <img class="card-img-top" src="img/moose.jpg">
          <div class="card-body">
            <h4 class="card-title">Orienteringsløpet avbrutt</h4>
            <p class="card-text">Illsint elg angrep deltakere</p>
          </div>
        </a>
      </div>
    </div>

    <div class="col-12 col-lg-6 pb-3">
      <div class="card">
        <a href="#">
          <img class="card-img-top" src="img/loss.jpg">
          <div class="card-body">
            <h4 class="card-title">Økonomisk krise</h4>
            <p class="card-text">Årsrapporten viser dystre tall</p>
          </div>
        </a>
      </div>
    </div>

  </div>
</div>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
