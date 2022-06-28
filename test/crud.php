<?php
include "connDB.php";


class userCRUD extends connDB
{
    // $db = connDB::getInstance();
// $conn = $db->getConnection();
    
    private $id;
    private $conn;

    private function __construct()
    {
        $db = connDB::getInstance();
        $conn = $db->getConnection();
        $this->conn = $conn;
    }

    public function userInsert($tblname, $arr = [], $id1, $id2, $idname)
    {
        if (empty($id2) && empty($idname)) 
        {
            $sql = "INSERT INTO $tblname SET";


        
        }
    }
}
?>