<?php
require_once "../util/db.php";
require_once "../util/queries.php";
require_once "../util/session.php";
try_extend_timer();

$id = $_SESSION['id'];
$gebruikersId = $id;
if ($_POST) {
  $soort = $_POST['soort'];
  $soortId = queries::getSoortId($soort);
  $idSoort = $soortId[0]->id_uitgaven_soort;
  $bedrag = $_POST['bedrag'];
  $datum = $_POST['datum'];
  $vast;
  if ($soortId[0]->id_uitgaven_soort == 1) {
    $vast = 1;
  } else {
    $vast = 0;
  }
  queries::insertUitgaven($idSoort, $bedrag, $datum, $vast, $gebruikersId);
}

$uitgaven = queries::getLastUitgaven($id);
for ($i = 0; $i < count($uitgaven); $i++) {
  $uitgavenId = $uitgaven[$i]->id_uitgaven;
  $bedrag = $uitgaven[$i]->bedrag;
  $date = $uitgaven[$i]->datum;
  $vast = $uitgaven[$i]->vaste_uitgaven;
  if ($vast == 0) {
    $vast = "Nee";
  } else if ($vast == 1) {
    $vast = "Ja";
  }
  $uitgaven[$i]->vaste_uitgaven = $vast;
}
?>

<html>

<head>
  <?php require_once "../components/head.php" ?>
  <link rel="stylesheet" href="./css/home.css">
  <script src="https://cdn.jsdelivr.net/npm/jdenticon@3.2.0/dist/jdenticon.min.js" async integrity="sha384-yBhgDqxM50qJV5JPdayci8wCfooqvhFYbIKhv0hTtLvfeeyJMJCscRfFNKIxt43M" crossorigin="anonymous">
  </script>
</head>

<body class="bg-dark text-light">
  <div class="container">
    <a class="btn btn-primary my-2" href="./">Terug</a>

    <form method="post">
      <div class="row">
        <div class="col-3">
          <span>Soort Uitgaven</span><br />
          <input type="radio" name="soort" value="vastelasten"> Vaste Lasten<br />
          <input type="radio" id="huishoudelijk" name="soort" value="huishoudelijk"> Huishoudelijk<br />
          <input type="radio" id="reserveringsuitgaven" name="soort" value="reserveringsuitgaven"> Reservering

        </div>
        <div class="col">
          <span class="my-2">Periodiek: <input type="checkbox" name="periodiek"> <br /></span>
          <input type="number" id="bedrag" name="bedrag" step=".01" placeholder="Bedrag"><br />
          <input type="date" id="datum" name="datum">
          <br />
          <input type="submit" class="btn btn-success" value="Verzenden">
        </div>
      </div>
    </form>

    <table class="table table-dark">
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
        foreach ($uitgaven as $item) {
          echo "<tr>" .
            "<td>$item->datum</td>" .
            "<td>$item->id_uitgaven_soort</td>" .
            "<td>" . ($item->vaste_uitgaven == 1 ? "Ja" : "Nee") . "</td>" .
            "<td>$item->bedrag</td>" .
            "<td><a href='./editUitgaven.php?id=$item->id_uitgaven' class='btn btn-warning'>Edit</a></td>" .
            "<td><a href='./deleteUitgaven.php?id=$item->id_uitgaven' class='btn btn-danger'>Delete</a></td>" .
            "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>