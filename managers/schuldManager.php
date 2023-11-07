<?php
require_once "../util/db.php";
class schuldManager 
{
  public static function updateSchulden($soort, $waarde, $datum, $waarborg, $id) {
    global $conn;

    $stmt = $conn->prepare("Update schuld set id_schuld_soort = ?, waarde = ?, datum_schuld = ?, waarborg = ? where id_schuld = ?;");
    $stmt->bindValue(1, $soort);
    $stmt->bindValue(2, $waarde);
    $stmt->bindValue(3, $datum);
    $stmt->bindValue(4, $waarborg);
    $stmt->bindValue(5, $id);
    $stmt->execute();
    header("location: ./schuld.php");
  }
  public static function delSchuld($id) {
    global $conn;

    $stmt = $conn->prepare("delete from schuld where id_schuld = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
  }
}