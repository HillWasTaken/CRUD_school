<?php
require_once "../util/db.php";
class activaManager 
{
  public static function updateactiva($soort, $waarde, $datum, $waarborg, $id) {
    global $conn;

    $stmt = $conn->prepare("Update activa set id_activa_soort = ?, waarde = ?, datum_aankoop = ?, materieel = ? where id_activa = ?;");
    $stmt->bindValue(1, $soort);
    $stmt->bindValue(2, $waarde);
    $stmt->bindValue(3, $datum);
    $stmt->bindValue(4, $waarborg);
    $stmt->bindValue(5, $id);
    $stmt->execute();
    header("location: ./activa.php");
  }
  public static function delActiva($id) {
    global $conn;

    $stmt = $conn->prepare("delete from activa where id_activa = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
  }
}