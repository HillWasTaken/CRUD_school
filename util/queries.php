<?php
    require_once "db.php";
    class queries {

        //get queries

        public static function getUserInfo($id) {
            global $conn;

            $stmt = $conn->prepare("Select voornaam, achternaam, gebruikersnaam, isadmin from gebruiker where id_gebruiker = ?;");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        public static function getUserId($username) {
            global $conn;

            $stmt = $conn->prepare("Select id_gebruiker from gebruiker where gebruikersnaam = ?;");
            $stmt->bindValue(1, $username);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        public static function getSoortId($soort) {
            global $conn;

            $stmt = $conn->prepare("select id_uitgaven_soort from uitgaven_soort where soort = ?;");
            $stmt->bindValue(1, $soort);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        public static function getUitgaven($gebruikersId) {
            global $conn;

            $stmt = $conn->prepare('Select * from uitgaven where gebruiker_id_gebruiker = ? order by id_uitgaven DESC;');
            $stmt->bindValue(1, $gebruikersId);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        public static function getInkomsten($id){
            global $conn;

            $stmt = $conn->prepare("select * from inkomen where id_gebruiker = ? order by id_inkomen DESC;");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        public static function getLastInkomen($id) {
            global $conn;

            $stmt = $conn->prepare("select * from inkomen where id_gebruiker = ? order by id_inkomen DESC limit 3; ");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        public static function getLastUitgaven($id) {
            global $conn;

            $stmt = $conn->prepare("select * from uitgaven where gebruiker_id_gebruiker = ? order by id_uitgaven DESC limit 3; ");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        public static function getSchulden($id) {
            global $conn;

            $stmt = $conn->prepare("select * from schuld where id_gebruiker = ?;");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        public static function getActiva($id) {
            global $conn;

            $stmt = $conn->prepare("select * from activa where gebruiker_id_gebruiker = ?;");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }

        //insert queries

        public static function insertUitgaven($soort, $bedrag, $datum, $vasteLast, $gebruikersId) {
            global $conn;

            $stmt = $conn->prepare("Insert into uitgaven (id_uitgaven_soort, bedrag, datum, vaste_uitgaven, gebruiker_id_gebruiker) values (?,?,?,?,?);");
            $stmt->bindValue(1, $soort);
            $stmt->bindValue(2, $bedrag);
            $stmt->bindValue(3, $datum);
            $stmt->bindValue(4, $vasteLast);
            $stmt->bindValue(5, $gebruikersId);
            $stmt->execute();
        }
        public static function insertInkomen($soort, $bedrag, $datum, $periodiek, $id) {
            global $conn;

            $stmt = $conn->prepare("insert into inkomen (inkomen_soort, bedrag, datum, periodiek, id_gebruiker) values (?,?,?,?,?);");
            $stmt->bindValue(1, $soort);
            $stmt->bindValue(2, $bedrag);
            $stmt->bindValue(3, $datum);
            $stmt->bindValue(4, $periodiek);
            $stmt->bindValue(5, $id);
            $stmt->execute();
        }
        public static function insertSchulden($soort, $waarde, $datum, $borg, $id) {
            global $conn;

            $stmt = $conn->prepare("insert into schuld (id_schuld_soort, waarde, datum_schuld, waarborg, id_gebruiker) values (?,?,?,?,?);");
            $stmt->bindValue(1, $soort);
            $stmt->bindValue(2, $waarde);
            $stmt->bindValue(3, $datum);
            $stmt->bindValue(4, $borg);
            $stmt->bindValue(5, $id);
            $stmt->execute();
        }
        public static function insertActiva($soort, $waarde, $datum, $materieel, $id) {
            global $conn;

            $stmt = $conn->prepare("insert into activa (id_activa_soort, waarde, datum_aankoop, materieel, gebruiker_id_gebruiker) values (?,?,?,?,?);");
            $stmt->bindValue(1, $soort);
            $stmt->bindValue(2, $waarde);
            $stmt->bindValue(3, $datum);
            $stmt->bindValue(4, $materieel);
            $stmt->bindValue(5, $id);
            $stmt->execute();
        }
    }