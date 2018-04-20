<?php
  $tittel = "Administrasjon - Nederlaget Idrettsklubb";
  include "utils/krevAdmin.php";
  include "kontrollere/administrasjon.php";
  include "layout/førInnhold.php";
?>
<!-- Innhold starter her -->

<h1 class="display-4">Administrasjon</h1>
<hr>

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
<?php endif; ?>


<div class="card mb-3">
  <div class="card-header" id="medlem-header">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#medlem-body">
        Medlemmer
      </button>
    </h5>
  </div>
  <div id="medlem-body" class="collapse">
    <div class="card-body p-0" style="font-size: 0.8rem;">

      <form method="post" id="slettMedlem"></form>

      <table class="table table-light table-striped table-hover mb-0">
        <thead class="thead-light">
          <tr>
            <th style="width: 5%;">ID</th>
            <th>Navn</th>
            <th>Adresse</th>
            <th>Telefon</th>
            <th>E-postadresse</th>
            <th style="width: 5%;"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($alleMedlemmer as $medlem): ?>
            <tr>
              <th><?= $medlem->medlemsnummer ?></th>
              <td><?= $medlem->fulltNavn(true) ?></td>
              <td><?= $medlem->fullAdresse() ?></td>
              <td><?= $medlem->telefonnummer ?></td>
              <td><?= $medlem->epost ?></td>
              <td class="pt-2 pb-1">
                <input type="hidden" name="operasjon" value="slettMedlem" form="slettMedlem">
                <button class="btn btn-danger btn-sm w-100" name="medlemsnummer" value="<?= $medlem->medlemsnummer ?>" form="slettMedlem">
                  &minus;
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header" id="idrett-header">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#idrett-body">
        Idretter
      </button>
    </h5>
  </div>
  <div id="idrett-body" class="collapse">
    <div class="card-body p-0">

      <form method="post" id="slettIdrett"></form>
      <form method="post" id="nyIdrett"></form>

      <table class="table table-light table-striped table-hover mb-0">
        <thead class="thead-light">
          <tr>
            <th style="width: 5%;">ID</th>
            <th>Navn</th>
            <th style="width: 5%;"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($alleIdretter as $idrett): ?>
            <tr>
              <th><?= $idrett->idrettskode ?></th>
              <td><?= $idrett->navn ?></td>
              <td class="ml-auto pt-2 pb-1">
                <input type="hidden" name="operasjon" value="slettIdrett" form="slettIdrett">
                <button class="btn btn-danger btn-sm w-100" name="idrettskode" value="<?= $idrett->idrettskode ?>" form="slettIdrett">
                  &minus;
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <th>Ny</th>
            <td>
              <input type="text" class="input-min" name="navn" placeholder="Navn" form="nyIdrett">
            </td>
            <td class="pt-2 pb-1">
              <input type="hidden" name="operasjon" value="nyIdrett" form="nyIdrett">
              <button class="btn btn-success btn-sm w-100" form="nyIdrett">&plus;</button>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header" id="anlegg-header">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#anlegg-body">
        Anlegg
      </button>
    </h5>
  </div>
  <div id="anlegg-body" class="collapse">
    <div class="card-body p-0">

      <form method="post" id="slettAnlegg"></form>
      <form method="post" id="nyttAnlegg"></form>

      <table class="table table-light table-striped table-hover mb-0">
        <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Idrett</th>
            <th>Navn</th>
            <th>Åpningstid</th>
            <th>Stengetid</th>
            <th>Timepris</th>
            <th style="width: 5%;"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($alleAnlegg as $anlegg): ?>
            <tr>
              <th><?= $anlegg->anleggskode ?></th>
              <td><?= $anlegg->getIdrett()->navn ?></td>
              <td><?= $anlegg->navn ?></td>
              <td><?= $anlegg->åpningstid ?>:00</td>
              <td><?= $anlegg->stengetid ?>:00</td>
              <td>kr <?= $anlegg->timepris ?>,-</td>
              <td class="pt-2 pb-1">
                <input type="hidden" name="operasjon" value="slettAnlegg" form="slettAnlegg">
                <button class="btn btn-danger btn-sm w-100" name="anleggskode" value="<?= $anlegg->anleggskode ?>" form="slettAnlegg">
                  &minus;
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <th>Ny</th>
            <td>
              <select class="input-min py-0 my-0" name="idrettskode" form="nyttAnlegg">
                <?php foreach ($alleIdretter as $idrett): ?>
                  <option value="<?= $idrett->idrettskode ?>">
                    <?= $idrett->navn ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </td>
            <td><input type="text" class="input-min" name="navn" placeholder="Navn" form="nyttAnlegg"></td>
            <td><input type="text" class="input-min" name="åpningstid" placeholder="Time" form="nyttAnlegg"></td>
            <td><input type="text" class="input-min" name="stengetid" placeholder="Time" form="nyttAnlegg"></td>
            <td><input type="text" class="input-min" name="timepris" placeholder="Beløp" form="nyttAnlegg"></td>
            <td class="pt-2 pb-1">
              <input type="hidden" name="operasjon" value="nyttAnlegg" form="nyttAnlegg">
              <button class="btn btn-success btn-sm w-100" form="nyttAnlegg">&plus;</button>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header" id="reservasjon-header">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#reservasjon-body">
        Reservasjoner
      </button>
    </h5>
  </div>
  <div id="reservasjon-body" class="collapse">
    <div class="card-body p-3">
      <p class="mb-0">
        Administratorbrukere kan administrere reservasjoner direkte i timeplanen.
      </p>
    </div>
  </div>
</div>


<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
