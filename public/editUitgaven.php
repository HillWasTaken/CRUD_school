<?php
require_once "../util/queries.php";
require_once "../managers/uitgavenManager.php";

if ($_POST) {
  $id = $_GET['id'];

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
  uitgavenManager::updateUitgaven($id, $vast, $bedrag, $datum, $vast);
}

?>
<html>

<body>
  <a href="./uitgaven.php">terug</a>

  <form method="post">
    <p>Soort uitgaven:</p>
    <input checked type="radio" id="vasteLasten" name="soort" value="vastelasten">
    <label for="vasteLasten">Vaste lasten</label><br>
    <input type="radio" id="huishoudelijk" name="soort" value="huishoudelijk">
    <label for="huishoudelijk">Huishoudelijk</label><br>
    <input type="radio" id="reserveringsuitgaven" name="soort" value="reserveringsuitgaven">
    <label for="reserveringsuitgaven">Reserveringsuitgaven</label><br>
    <br />
    <input type="number" id="bedrag" name="bedrag" step=".01"><br />
    <input type="date" id="datum" name="datum">
    <br />
    <input type="submit" value="Submit">
    <p id="loading" style="display: none;">Loading...</p>
  </form>
</body>

</html>