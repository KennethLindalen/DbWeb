<?php
  $tittel = "Timeplan - Nederlaget Idrettsklubb";
  include "utils/timeplan.php";
  include "layout/førInnhold.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Timeplan</h1>
<hr>

<form method="post">
  <div class="row">
    <div class="input-group mb-3 col-5">
      <div class="input-group-prepend">
        <label class="input-group-text" for="velgIdrett">Idrett</label>
      </div>
      <select class="custom-select" style="height: 100%;" name="idrettskode" id="velgIdrett">
        <?php foreach ($alleIdretter as $idrett): ?>
          <option value="<?= $idrett->idrettskode ?>" <?= erValgt($idrett->idrettskode) ?>>
            <?= $idrett->navn ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="input-group mb-3 col-5">
      <div class="input-group-prepend">
        <label class="input-group-text" for="velgDato">Dato</label>
      </div>
      <input type="date" class="form-control" name="dato" id="velgDato" value="<?= $valgtDato ?>">
    </div>

    <div class="input-group mp-3 col-2 h-100">
      <input type="hidden" name="operasjon" value="søk">
      <button class="btn btn-outline-primary w-100" name="button">Søk</button>
    </div>
  </div>
</form>

<?php if (!empty($feil)): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <p>Feil oppstod under forrige operasjon:</p>
    <ul>
      <?php foreach ($feil as $melding): ?>
        <li><?= $melding ?></li>
      <?php endforeach; ?>
    </ul>
    <button class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
  </div>
<?php elseif ($valgtIdrett): ?>
  <?php foreach ($valgtIdrett->getAnlegg() as $anlegg): ?>

    <div class="card mb-3">
      <div class="card-header" id="anlegg<?= $anlegg->anleggskode ?>-header">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#anlegg<?= $anlegg->anleggskode ?>-body">
            <?= $anlegg->navn ?>
          </button>
        </h5>
      </div>
      <div id="anlegg<?= $anlegg->anleggskode ?>-body" class="collapse">
        <div class="card-body p-0">

          <table class="table table-striped m-0">
            <thead class="thead-light">
              <tr>
                <th style="width: 15%;">Klokkeslett</th>
                <th>Status</th>
                <th>Reservert av</th>
                <th>Timepris</th>
                <th style="width: 15%;"></th>
              </tr>
            </thead>
            <tbody>

              <?php foreach (hentReservasjoner($anlegg, $valgtDato) as $time => $res): ?>
                <tr class="<?= $res ? "text-muted" : "" ?>">
                  <td><?= $time ?>:00 - <?= $time + 1 ?>:00</td>
                  <td><?= $res ? "Reservert" : "Ledig" ?></td>
                  <td><?= $res ? $res->getMedlem()->fulltNavn() : "" ?></td>
                  <td><?= $anlegg->timepris ?>,-</td>
                  <td class="pt-2 pb-1">
                    <?php if ($_SESSION["medlemsnummer"]): ?>
                      <form method="post">
                        <input type="hidden" name="dato" value="<?= $valgtDato ?>">
                        <input type="hidden" name="idrettskode" value="<?= $valgtIdrett->idrettskode ?>">
                        <input type="hidden" name="anleggskode" value="<?= $anlegg->anleggskode ?>">
                        <input type="hidden" name="time" value="<?= $time ?>">
                        <?php if (!$res): ?>
                          <input type="hidden" name="operasjon" value="nyReservasjon">
                          <button class="btn btn-success btn-sm w-100 h-100">Reserver</button>
                        <?php elseif ($res->medlemsnummer == $_SESSION["medlemsnummer"] || $_SESSION["administrator"]): ?>
                          <input type="hidden" name="operasjon" value="slettReservasjon">
                          <button class="btn btn-danger btn-sm w-100 h-100">Kanseller</button>
                        <?php endif; ?>
                      </form>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>


          </table>

        </div>
      </div>
    </div>

  <?php endforeach; ?>
<?php endif; ?>


<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
