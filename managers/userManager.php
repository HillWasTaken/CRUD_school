<?php
require_once "../util/db.php";
class userManager
{
  public static function getUserInfo($id)
  {
    global $conn;

    $stmt = $conn->prepare("select voornaam, achternaam, isadmin, gebruikersnaam, land_id from gebruiker where id_gebruiker = ?;");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
  }
  public static function getLand()
  {
    global $conn;

    $stmt = $conn->prepare("select * from land;");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
  }
  public static function checkUsername()
  {
    global $conn;

    $stmt = $conn->prepare('select gebruikersnaam from gebruiker;');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
  }
  public static function updateUserInfo($voornaam, $achternaam, $email, $land_id, $id)
  {
    global $conn;

    $stmt = $conn->prepare('update gebruiker set voornaam = ?, achternaam = ?, gebruikersnaam = ?, land_id = ? where id_gebruiker = ?;');
    $stmt->bindValue(1, $voornaam);
    $stmt->bindValue(2, $achternaam);
    $stmt->bindValue(3, $email);
    $stmt->bindValue(4, $land_id);
    $stmt->bindValue(5, $id);
    $stmt->execute();
  }
}
