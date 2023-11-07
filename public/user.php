<?php
require_once "../util/session.php";
require_once "../managers/userManager.php";
$id = $_SESSION['id'];

$result = userManager::getUserInfo($id);

$firstname = $result[0]->voornaam;
$lastname = $result[0]->achternaam;
if ($result[0]->isadmin == "1") {
  $admin = "admin";
} else {
  $admin = "geen admin";
}
$username = $result[0]->gebruikersnaam;
$country = $result[0]->land_id;

if ($_POST) {
  $newFirstname = $_POST['firstname'];
  $newLastname = $_POST['lastname'];
  $newEmail = $_POST['email'];
  $newCountry = $_POST['land'];
  if ($newFirstname == null || $newLastname == null || $newEmail == null || $newCountry == null) {
    echo "<script>alert('vul alle velden in');</script>";
  }
  $usernameCheck = userManager::checkUsername();
  var_dump($usernameCheck);
  foreach ($usernameCheck as $check) {
    if ($newEmail == $check->gebruikersnaam) {
      echo "<script>alert('Email is al in gebruik');</script>";
      $newEmail = null;
    } else {
      userManager::updateUserInfo($newFirstname, $newLastname, $newEmail, $newCountry, $id);
      header('location: ./');
    }
  }
}
?>

<html>

<head>
  <?php require_once "../components/head.php" ?>
  <link rel="stylesheet" href="./css/home.css">
  <script src="https://cdn.jsdelivr.net/npm/jdenticon@3.2.0/dist/jdenticon.min.js" async integrity="sha384-yBhgDqxM50qJV5JPdayci8wCfooqvhFYbIKhv0hTtLvfeeyJMJCscRfFNKIxt43M" crossorigin="anonymous">
  </script>
  <script src="./js/showEditForm.js"></script>
</head>

<body class="bg-dark text-light">
  <div class="container my-4">
    <a href="./" class="btn btn-primary my-1">Terug</a>
    <?php
    echo "
    <p>Goede dag $firstname $lastname</p>
    <p>Gebruikersnaam: $username</p>
    <p>Admin Status: $admin</p>
    <p>Land: $country</p>
    <button class='btn btn-secondary' onclick='toggleEdit()'>Bewerken</button>
  ";

    ?>
    <div id="editForm">
      <form method="post">
        <label for="firstname">Voornaam</label><br />
        <input type="text" id="firstname" name="firstname"><br />
        <label for="lastname">achternaam</label><br />
        <input type="text" id="lastname" name="lastname">
        <br />
        <label for="email">Email</label><br />
        <input type="email" id="email" name="email"><br />
        <select name="land" id="land">
          <option>Land...</option>
          <?php
          $landen = userManager::getLand();
          var_dump($landen);
          foreach ($landen as $land) {
            echo "<option value=$land->id>$land->naam</option>";
          }
          ?>
        </select>
        <input type="submit" value="Save">
      </form>
    </div>
  </div>

</body>

</html>