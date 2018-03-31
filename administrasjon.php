<?php
  include_once "utils/krevAdmin.php";
  include_once "utils/administrasjon.php";

  $alleMedlemmer = Medlem::finnAlle();
  $alleIdretter  = Idrett::finnAlle();
  $alleAnlegg    = Anlegg::finnAlle();

  $tittel = "Administrasjon - Nederlaget Idrettsklubb";
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

<div id="accordion">
  <div class="card mb-3">
    <div class="card-header" id="medlem-header">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#medlem-body">
          Medlemmer
        </button>
      </h5>
    </div>
    <div id="medlem-body" class="collapse" data-parent="#accordion">
      <div class="card-body p-0">

        <table class="table table-light table-striped table-hover mb-0">
          <thead class="thead-light">
            <tr>
              <th scope="col" style="width: 5%;" class="px-2">ID</th>
              <th scope="col">Navn</th>
              <th scope="col">Adresse</th>
              <th scope="col">Telefon</th>
              <th scope="col">E-postadresse</th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($alleMedlemmer as $medlem): ?>
              <tr>
                <th scope="row" class="px-2"><?= $medlem->medlemsnummer ?></th>
                <td><?= $medlem->fulltNavn() ?></td>
                <td><?= $medlem->fullAdresse() ?></td>
                <td><?= $medlem->telefonnummer ?></td>
                <td><?= $medlem->epost ?></td>
                <td>
                  <form method="post">
                    <input type="hidden" name="operasjon" value="slettMedlem">
                    <input type="hidden" name="medlemsnummer" value="<?= $medlem->medlemsnummer ?>">
                    <button class="badge badge-danger border-0">&minus;</button>
                  </form>
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
    <div id="idrett-body" class="collapse" data-parent="#accordion">
      <div class="card-body p-0">

        <table class="table table-light table-striped table-hover mb-0">
          <thead class="thead-light">
            <tr>
              <th scope="col" style="width: 5%;" class="px-2">ID</th>
              <th scope="col">Navn</th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($alleIdretter as $idrett): ?>
              <tr>
                <th scope="row" class="px-2"><?= $idrett->idrettskode ?></th>
                <td><?= $idrett->navn ?></td>
                <td class="ml-auto">
                  <form method="post">
                    <input type="hidden" name="operasjon" value="slettIdrett">
                    <input type="hidden" name="idrettskode" value="<?= $idrett->idrettskode ?>">
                    <button class="badge badge-danger border-0">&minus;</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <form method="post">
                <input type="hidden" name="operasjon" value="nyIdrett">
                <th class="pl-2">Ny</th>
                <td><input type="text" class="input-min" name="navn" placeholder="Navn"></td>
                <td><button class="badge badge-success border-0">&plus;</button></td>
              </form>
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
    <div id="anlegg-body" class="collapse" data-parent="#accordion">
      <div class="card-body p-0">

        <table class="table table-light table-striped table-hover mb-0">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="pl-2">ID</th>
              <th scope="col">Idrett</th>
              <th scope="col">Navn</th>
              <th scope="col">Åpningstid</th>
              <th scope="col">Stengetid</th>
              <th scope="col">Timepris</th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($alleAnlegg as $anlegg): ?>
              <tr>
                <th class="pl-2"><?= $anlegg->anleggskode ?></th>
                <td><?= $anlegg->getIdrett()->navn ?></td>
                <td><?= $anlegg->navn ?></td>
                <td><?= $anlegg->åpningstid ?>:00</td>
                <td><?= $anlegg->stengetid ?>:00</td>
                <td>kr <?= $anlegg->timepris ?>,-</td>
                <td>
                  <form method="post">
                    <input type="hidden" name="operasjon" value="slettAnlegg">
                    <input type="hidden" name="anleggskode" value="<?= $anlegg->anleggskode ?>">
                    <button class="badge badge-danger border-0">&minus;</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <form method="post">
                <input type="hidden" name="operasjon" value="nyttAnlegg">
                <th class="pl-2">Ny</th>
                <td>
                  <select class="input-min py-0 my-0" name="idrettskode">
                    <?php foreach ($alleIdretter as $idrett): ?>
                      <option value="<?= $idrett->idrettskode ?>">
                        <?= $idrett->navn ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td><input type="text" class="input-min" name="navn" placeholder="Navn"></td>
                <td><input type="text" class="input-min" name="åpningstid" placeholder="Time"></td>
                <td><input type="text" class="input-min" name="stengetid" placeholder="Time"></td>
                <td><input type="text" class="input-min" name="timepris" placeholder="Beløp"></td>
                <td><button class="badge badge-success border-0">&plus;</button></td>
              </form>
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
    <div id="reservasjon-body" class="collapse" data-parent="#accordion">
      <div class="card-body p-0">
        <?php  ?>
      </div>
    </div>
  </div>

</div>

<!-- Innhold stopper her -->
<?php include "layout/etterInnhold.php"; ?>
