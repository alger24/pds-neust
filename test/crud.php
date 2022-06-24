<?php
include "connDB.php";
$db = connDB::getInstance();
$conn = $db->getConnection();

class userCRUD {
    public function userInsert($tblname, $arr = [], $id1, $id2, $idname) {
        if(empty($id2) && empty($idname)) {
            $sql = "INSERT INTO $tblname SET";
            foreach(arr)
        }
    }
}
?>