<?php
require_once "../util/db.php";

class LoginManager
{

  public static function addUser(stdClass $userInfo, bool $isAdmin = false)
  {
    global $conn;
    $stmt = $conn->prepare(
      "
      INSERT INTO gebruiker (
        voornaam,
        achternaam,
        gebruikersnaam,
        land_id,
        wachwoord,
        isadmin
      ) VALUES (?, ?, ?, ?, ?, ?);
      "
    );

    $stmt->execute([
      htmlspecialchars($userInfo->firstName),
      htmlspecialchars($userInfo->lastName),
      htmlspecialchars($userInfo->email),
      $userInfo->countryInfo,
      $userInfo->passwd,
      $isAdmin ? 1 : 0,
    ]);
  }

  public static function getUser(string $email): stdClass|false
  {
    global $conn;
    $stmt = $conn->prepare(
      "SELECT * FROM gebruiker WHERE gebruikersnaam = ?;"
    );

    $stmt->execute([$email]);

    return $stmt->fetchObject();
  }
}
