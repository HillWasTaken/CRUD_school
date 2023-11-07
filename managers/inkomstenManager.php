<?php
require_once "../util/db.php";
class inkomstenManager 
{
  public static function updateinkomsten($soort, $waarde, $datum, $waarborg, $id) {
    global $conn;

    $stmt = $conn->prepare("Update inkomen set inkomen_soort = ?, bedrag = ?, datum = ?, periodiek = ? where id_inkomen = ?;");
    $stmt->bindValue(1, $soort);
    $stmt->bindValue(2, $waarde);
    $stmt->bindValue(3, $datum);
    $stmt->bindValue(4, $waarborg);
    $stmt->bindValue(5, $id);
    $stmt->execute();
    header("location: ./inkomsten.php");
  }
  public static function delInkomsten($id){
    global $conn;

    $stmt = $conn->prepare('delete from inkomen where id_inkomen = ?');
    $stmt->bindValue(1, $id);
    $stmt->execute();
  }
}