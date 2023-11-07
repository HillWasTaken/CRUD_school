<?php
  require_once "../managers/schuldManager.php";
  require_once "../util/session.php";

  $id = $_GET['id'];

  if ($_POST) {
    $newSoort = $_POST['soort'];
    $newWaarde = $_POST['waarde'];
    $newDatum = $_POST['datum'];
    if(isset($_POST['borg'])) {
      $newWaarborg = "1";
    } else if (!isset($_POST['borg'])) {
      $newWaarborg = "0";
    }

    schuldManager::updateSchulden($newSoort, $newWaarde, $newDatum, $newWaarborg, $id);
  }

?>
<html>
  <body>
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
      <input onclick="loading()" type="submit" value="Submit">
      <p id="loading" style="display: none;">Loading...</p>
    </form>
  </body>
  <script src="./js/loading.js"></script>
</html>