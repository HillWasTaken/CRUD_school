<?php
require_once "../handlers/error.php";
require_once "../util/db.php";

if ($_POST) {

  $hashedPass = password_hash($_POST["passwd"], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO gebruiker (voornaam, achternaam, gebruikersnaam, land_id, wachtwoord, isadmin) VALUES (?, ?, ?, ?, ?, 0);");

  $stmt->execute([
    htmlspecialchars($_POST["first_name"]),
    htmlspecialchars($_POST["last_name"]),
    htmlspecialchars($_POST["email"]),
    htmlspecialchars($_POST["land"]),
    $hashedPass,
  ]);

  session_start();
  header("location: ./");
  return;
}

$stmt = $conn->prepare("SELECT * FROM land;");
$stmt->execute();
$countries = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<head>
  <?php require_once "../components/head.php" ?>
  <link rel="stylesheet" href="./css/register.css">
</head>

<body class="bg-dark text-light">
  <main class="main container my-5">
    <form method="POST">
      <div class="row d-flex justify-content-evenly">
        <input class="m-1 col-4" type="text" name="first_name" id="first_name" placeholder="First Name">
        <input class="m-1 col-4" type="text" name="last_name" id="last_name" placeholder="Last Name">
        <input class="m-1 col-4" type="email" name="email" id="email" placeholder="Email">
        <input class="m-1 col-4" type="password" name="passwd" id="passwd" placeholder="Password">
        <select class="col-4" name="land" id="land">
          <option value="" disabled selected>Please select a country</option>
          <?php
          foreach ($countries as $country) {
            echo "<option value=\"$country->id\">$country->naam</option>";
          }
          ?>
        </select>
      </div>
      <div class="d-flex justify-content-evenly">
        <a class="col-4 btn btn-secondary my-1" href="./">Log In</a>
        <input class="col-4 btn btn-success my-1" type="submit" value="Register">
      </div>
    </form>
  </main>
  <div class="d-flex justify-content-center align-center">
  </div>
</body>