<?php
require_once "../managers/activaManager.php";
require_once "../util/session.php";

$id = $_GET['id'];

if ($_POST) {
  $newSoort = $_POST['soort'];
  $newWaarde = $_POST['bedrag'];
  $newDatum = $_POST['datum'];
  if (isset($_POST['materieel'])) {
    $newWaarborg = "1";
  } else if (!isset($_POST['materieel'])) {
    $newWaarborg = "0";
  }

  activaManager::updateactiva($newSoort, $newWaarde, $newDatum, $newWaarborg, $id);
}

?>
<html>

<body>
  <form method="post">
    <p>Soort activa:</p>
    <input checked type="radio" id="vast" name="soort" value="1">
    <label for="vast">Vaste activa</label><br>
    <input type="radio" id="vlottend" name="soort" value="2">
    <label for="vlottend">Vlottende activa</label><br>
    <br />
    <input type="number" id="bedrag" name="bedrag" step=".01"><br />
    <input type="date" id="datum" name="datum">
    <br />
    <label for="materieel">Materieel?: </label>
    <input type="checkbox" id="materieel" name="materieel">
    <br />
    <input onclick="loading()" type="submit" value="Submit">
    <p id="loading" style="display: none;">Loading...</p>
  </form>
</body>
<script src="./js/loading.js"></script>

</html>