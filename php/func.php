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


// User Registration
function userRegister($conn, $arr1=[], $tblname, $uid)
{
  if(empty($arr1)){
    exit();
  }

  try {
    foreach ($arr1 as $key => $value) {
      $columns[] = "{$key}";
      $fields[] = ":{$key}";
    }

    $sql = "INSERT INTO $tblname ";
    $sql .= "(user_id, " . implode(", ", $columns) . ")";
    $sql .= " VALUES (:user_id, " . implode(", ", $fields) . ")";
    
    // echo $sql;
    $stmt = $conn->prepare($sql);
    foreach ($arr1 as $key2 => $value2) {
        $stmt->bindValue(":".$key2, $value2);
    }
    $stmt->bindValue(':user_id', $uid);
    
    $stmt->execute();
  } catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
  }
}

// function clean_data($data)
// {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }