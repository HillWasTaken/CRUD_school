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
  if (isset($_POST['materieel'])) {
    $checked = "1";
  } else if (!isset($_POST['checked'])) {
    $checked = "0";
  }
  queries::insertActiva($soort, $bedrag, $datum, $checked, $gebruikersId);
}

$result = queries::getActiva($id);

foreach ($result as $u) {
  $activaId = $u->id_activa;
  $activa_soort = $u->id_activa_soort;
  switch ($activa_soort) {
    case 1:
      $activa_soort = "Vaste activa";
      break;
    case 2:
      $activa_soort = "Vlottende activa";
      break;
  }
  $waarde = $u->waarde;
  $date = $u->datum_aankoop;
  $materieel;
  if ($u->materieel == 1) {
    $materieel = "Ja";
  } else {
    $materieel = "Nee";
  }
  $u->materieel = $materieel;
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
  <div class="container my-4">
    <a class="btn btn-primary" href="./">Terug</a>
    <form method="post">
      <span>Soort Activa</span><br />
      <input checked type="radio" id="vast" name="soort" value="1">
      <label for="vast">Vaste activa</label><br>
      <input type="radio" id="vlottend" name="soort" value="2">
      <label for="vlottend">Vlottende activa</label><br>
      <br />
      <input type="number" id="bedrag" name="bedrag" step=".01" placeholder="Bedrag"><br />
      <input type="date" id="datum" name="datum">
      <br />
      <label for="materieel">Materieel?: </label>
      <input type="checkbox" id="materieel" name="materieel">
      <br />
      <input type="submit" value="Verzenden" class="btn btn-success">
    </form>
    <table class="table table-dark">
      <thead>
        <tr>
          <th>Activa Soort</th>
          <th>Waarde</th>
          <th>Datum Aankoop</th>
          <th>Materieel</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($result as $item) {
          echo "<tr>
              <td>$item->id_activa_soort</td>
              <td>$item->waarde</td>
              <td>$item->datum_aankoop</td>
              <td>$item->materieel</td>
              <td><a href='./editActiva.php?id=$item->id_activa' class='btn btn-warning'>Edit</a></td>
              <td><a href='./deleteActiva.php?id=$item->id_activa' class='btn btn-danger'>Delete</a></td>
            </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>