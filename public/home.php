<?php
require_once "../components/head.php";
require_once "../util/queries.php";
require_once "../util/session.php";
try_extend_timer();

$id = $_SESSION['id'];

$info = queries::getUserInfo($id)[0];
$inkomen = queries::getLastInkomen($id);
$uitgaven = queries::getLastUitgaven($id);
for ($i = 0; $i < count($inkomen); $i++) {
  $inkomstenId = $inkomen[$i]->id_inkomen;
  $soort = $inkomen[$i]->inkomen_soort;
  switch ($soort) {
    case 1:
      $soort = "Loon";
      break;
    case 2:
      $soort = "Rente";
      break;
    case 3:
      $soort = "Kinderbijslag";
      break;
    case 4:
      $soort = "Subsidie";
      break;
    case 5:
      $soort = "Bijstand";
      break;
  }
  $bedrag = $inkomen[$i]->bedrag;
  $date = $inkomen[$i]->datum;
  $periodiek = $inkomen[$i]->periodiek;
  if ($periodiek == 0) {
    $periodiek = "Nee";
  } else if ($periodiek == 1) {
    $periodiek = "Ja";
  }
  $inkomen[$i]->inkomen_soort = $soort;
  $inkomen[$i]->periodiek = $periodiek;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../components/head.php" ?>
  <link rel="stylesheet" href="./css/home.css">
  <script src="https://cdn.jsdelivr.net/npm/jdenticon@3.2.0/dist/jdenticon.min.js" async integrity="sha384-yBhgDqxM50qJV5JPdayci8wCfooqvhFYbIKhv0hTtLvfeeyJMJCscRfFNKIxt43M" crossorigin="anonymous">
  </script>
</head>

<body class="bg-dark text-light">
  <main>
    <div class="my-5 d-flex flex-row justify-content-between">
      <div class="col-4 p-1 border rounded c800">
        <h4>Inkomen Totaal: <?php echo array_reduce($inkomen, function ($carry, $item) {
                              return $carry + $item->bedrag;
                            }, 0); ?></h4>
        <table class="w-100 m-0 table table-dark">
          <thead>
            <tr>
              <th>Datum</th>
              <th>Soort Inkomen</th>
              <th>Periodiek</th>
              <th>Bedrag</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = array_slice($inkomen, 0, 5);
            foreach ($i as $item) {
              echo "<tr>" .
                "<td>$item->datum</td>" .
                "<td>$item->inkomen_soort</td>" .
                "<td>" . ($item->periodiek == 1 ? "Ja" : "Nee") . "</td>" .
                "<td>$item->bedrag</td>" .
                "</tr>";
            }
            ?>
          </tbody>
        </table>
        <div class="position-relative">
          <a href="./inkomsten.php" class="btn btn-primary position-absolute">Meer Inkomen</a>
        </div>
      </div>
      <div class="col-4 p-1 border rounded c800">
        <h4>Uitgaven Totaal: <?php echo array_reduce($uitgaven, function ($carry, $item) {
                                return $carry + $item->bedrag;
                              }, 0); ?></h4>
        <table class="w-100 m-0 table table-dark">
          <thead>
            <tr>
              <th>Datum</th>
              <th>Soort Uitgaven</th>
              <th>Periodiek</th>
              <th>Bedrag</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $u = array_slice($uitgaven, 0, 5);
            foreach ($u as $item) {
              echo "<tr>" .
                "<td>$item->datum</td>" .
                "<td>$item->id_uitgaven_soort</td>" .
                "<td>" . ($item->vaste_uitgaven == 1 ? "Ja" : "Nee") . "</td>" .
                "<td>$item->bedrag</td>" .
                "</tr>";
            }
            ?>
          </tbody>
        </table>
        <div class="position-relative">
          <a href="./uitgaven.php" class="btn btn-primary position-absolute">Meer Uitgaven</a>
        </div>
      </div>
      <div class="text-decoration-none text-center">
        <a class="text-decoration-none text-white text-decoration-bold" href="./user.php">
          <div class="p-1 border rounded">
            <svg data-jdenticon-value="<?php echo $info->gebruikersnaam; ?>" width="80" height="80"></svg>
            <h2><?php echo "$info->voornaam $info->achternaam"; ?></h2>
          </div>
        </a>
        <a class="my-1 btn btn-warning" href="./logout.php">Uitloggen</a>
      </div>
    </div>
    <div class="my-5 col-2 text-center mx-auto p-1 border rounded c800">
      <h4><a href="./activa.php" class="btn btn-primary">Activa</a></h4>
      <h4><a href="./schuld.php" class="btn btn-primary">Schuld</a></h4>
    </div>
  </main>
</body>

</html>