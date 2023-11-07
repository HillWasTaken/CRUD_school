<?php
require_once "../util/queries.php";
require_once "../util/session.php";
try_extend_timer();

$id = $_SESSION['id'];

if ($_POST) {

  $soort = $_POST['soort'];
  $waarde = $_POST['waarde'];
  $datum = $_POST['datum'];
  $borg;
  if (isset($_POST['borg'])) {
    $borg = "1";
  } else if (!isset($_POST['borg'])) {
    $borg = "0";
  }

  queries::insertSchulden($soort, $waarde, $datum, $borg, $id);
}

$result = queries::getSchulden($id);

for ($i = 0; $i < count($result); $i++) {
  $idSchuld = $result[$i]->id_schuld;
  $soort = $result[$i]->id_schuld_soort;
  switch ($soort) {
    case 1:
      $soort = "Opzet";
      break;
    case 2:
      $soort = "Culpa";
      break;
  }
  $waarde = $result[$i]->waarde;
  $datum = $result[$i]->datum_schuld;
  $borg  = $result[$i]->waarborg;
  switch ($borg) {
    case 0:
      $borg = "Nee";
      break;
    case 1:
      $borg = "Ja";
      break;
  }
  $result[$i]->id_schuld_soort = $soort;
  $result[$i]->waarborg = $borg;
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
  <div class="container">
    <a href="./" class="btn btn-primary">Terug</a>
    <form method="post">
      <p>Soort Inkomen:</p>
      <input checked type="radio" id="opzet" name="soort" value="1">
      <label for="opzet">opzet</label><br>
      <input type="radio" id="culpa" name="soort" value="2">
      <label for="culpa">culpa</label><br>
      <br />
      <label for="bedrag">Waarde:</label>
      <input type="number" id="bedrag" name="waarde" step=".01"><br />
      <label for="datum">Datum:</label>
      <input type="date" id="datum" name="datum">
      <label for="borg">Borg:</label>
      <input type="checkbox" id="borg" name="borg">
      <br />
      <input type="submit" value="Verzenden" class="btn btn-success">
    </form>

    <table class="table table-dark">
      <thead>
        <tr>
          <th>Schuld Soort</th>
          <th>Waarde</th>
          <th>Datum Schuld</th>
          <th>Waarborg</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($result as $item) {
          echo "<tr>
              <td>$item->id_schuld_soort</td>
              <td>$item->waarde</td>
              <td>$item->datum_schuld</td>
              <td>$item->waarborg</td>
              <td><a href='./editSchuld.php?id=$item->id_schuld' class='btn btn-warning'>Edit</a></td>
              <td><a href='./delSchuld.php?id=$item->id_schuld' class='btn btn-danger'>Delete</a></td>
            </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>