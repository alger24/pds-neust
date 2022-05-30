<?php
require 'conn.php';

function get_urlmessage()
{
    if (isset($_GET['error'])) {
        $url_msg = $_GET['error'];
        echo "<span style='color: red'>$url_msg</span>";
    } else if (isset($_GET['success'])) {
        $url_smg = $_GET['success'];
        echo "<span style='color: green'>$url_smg</span>";
    } else {
        unset($url_msg);
    }
}

function check_id($conn, $uid, $role = "") {
    switch($role) {
        case "user" :
            try {
                $select = $conn->prepare("SELECT `user_id` FROM `user_main_tbl` WHERE `user_id` = ?");
                $select->execute([$uid]);
                $result = $select->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
            } finally {
                if (!$result) {
                    die(header("location: ../index.php?error=Warning your trying to access a restricted page!"));
                }
            }
        break;

        case "admin" :
            // try {
            //     $select = $conn->prepare("SELECT * FROM `admin_tbl` WHERE `admin_id` = ?");
            //     $select->execute([$id]);
            //     $result = $select->fetch();
            // } catch (PDOException $e) {
            //     echo $e->getMessage();
            // } finally {
            //     if (!$result) {
            //         die(header("location: ../index.php?error=Warning your trying to access a restricted page!"));
            //     }
            // }
        break;

        default :
            echo "Error</br><a href='../index.php'>Go Back</a>";
            // die(header("location: ../index.php"));
    }
}

function insertActivity($conn, $str=""){
    $sql = "INSERT INTO activity_log (act_time, act_text) VALUES ";
    $sql .= "(NOW(), :act_text)";
    $act = $conn->prepare($sql);
    $act->bindValue(':act_text', $str)->execute();
}


// function clean_data($data)
// {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }