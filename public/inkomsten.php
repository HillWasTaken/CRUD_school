<?php
require_once "../util/db.php";
require_once "../util/queries.php";
require_once "../util/session.php";
try_extend_timer();

$id = $_SESSION['id'];
$gebruikersId = $id;
if ($_POST) {
  $soort = $_POST['soort'];
  $bedrag = $_POST['bedrag'];
  $datum = $_POST['datum'];
  $checked = isset($_POST["periodiek"]) ? 1 : 0;
  queries::insertInkomen($soort, $bedrag, $datum, $checked, $gebruikersId);
}

$inkomen = queries::getInkomsten($id);
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
// var_dump($inkomen);
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
  <div class="container">
    <a href="./" class="btn btn-primary my-2">Terug</a>

    <form method="POST">
      <div class="row">
        <div class="col-3">
          Soort inkomen<br />
          <input type="radio" name="soort" value="1"> Loon<br />
          <input type="radio" name="soort" value="2"> Rente<br />
          <input type="radio" name="soort" value="3"> Kinderbijslag<br />
          <input type="radio" name="soort" value="4"> Subsidie<br />
          <input type="radio" name="soort" value="5"> Bijstand<br />
        </div>
        <div class="col">
          <span class="my-2">Periodiek: <input type="checkbox" name="periodiek"> <br /></span>
          <span class="my-2">Bedrag: <input type="number" name="bedrag" step=".01"> <br /></span>
          <span class="my-2">Datum: <input type="date" name="datum" value=""> <br /></span>
          <span class="my-2"><input class="btn btn-success" type="submit" value="Toevoegen"></span>
        </div>
      </div>
    </form>
    <table class="table table-dark">
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
        foreach ($inkomen as $item) {
          echo "<tr>" .
            "<td>$item->datum</td>" .
            "<td>$item->inkomen_soort</td>" .
            "<td>" . ($item->periodiek == 1 ? "Ja" : "Nee") . "</td>" .
            "<td>$item->bedrag</td>" .
            "<td><a href='./editInkomsten.php?id=$item->id_inkomen' class='btn btn-warning'>Edit</a></td>" .
            "<td><a href='./deleteInkomsten.php?id=$item->id_inkomen' class='btn btn-danger'>Delete</a></td>" .
            "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>