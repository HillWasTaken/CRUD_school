<?php
  require_once "../handlers/error.php";
  require_once "../managers/LoginManager.php";

  if ($_POST) {
    $user = LoginManager::getUser($_POST["email"]);
    if ($user == false) {
      throw new Exception("Invalid email or password");
    }

    $is_valid = password_verify($_POST["passwd"], $user->wachtwoord);
    if (!$is_valid) {
      throw new Exception("Invalid email or password");
    }

    session_start();
    $_SESSION["expireStamp"] = time() + 3600;
    $_SESSION['id'] = $user->id_gebruiker;
    header("location: ./");
    return;
  }

  require_once "../components/head.php";

  session_start();
  if (isset($_SESSION["expireStamp"])) {
    // Logged in. Redirect
    header("location: ./home.php");
    return;
  }
?>

<head>
  <?php require_once "../components/head.php" ?>
  <link rel="stylesheet" href="./css/register.css">
</head>

<body class="bg-dark text-light">
  <main class="main container my-5">
    <form method="POST">
      <div class="row d-flex justify-content-evenly">
        <input class="m-1 col-4" type="email" name="email" id="email" placeholder="Email">
        <input class="m-1 col-4" type="password" name="passwd" id="passwd" placeholder="Password">
      </div>
      <div class="d-flex justify-content-evenly">
        <a class="col-4 btn btn-secondary my-1" href="./register.php">Register</a>
        <input class="col-4 btn btn-success my-1" type="submit" value="Log In">
      </div>
    </form>
  </main>
  <?php require "../components/footer.php"; ?>
</body>