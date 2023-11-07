<?php
  require_once "../util/db.php";
  class uitgavenManager 
  {
    public static function updateUitgaven($id, $soort, $bedrag, $datum, $vast) {
      global $conn;

      $stmt = $conn->prepare("update uitgaven set id_uitgaven_soort = ?, bedrag = ?, datum = ?, vaste_uitgaven = ? where id_uitgaven = ?;");
      $stmt->bindValue(1, $soort);
      $stmt->bindValue(2, $bedrag);
      $stmt->bindValue(3, $datum);
      $stmt->bindValue(4, $vast);
      $stmt->bindValue(5, $id);
      $stmt->execute();
      header("Location: ./uitgaven.php");
    }
    public static function delUitgaven($id){
      global $conn;

      $stmt = $conn->prepare("delete from uitgaven where id_uitgaven = ?");
      $stmt->bindValue(1, $id);
      $stmt->execute();
    }
  } 