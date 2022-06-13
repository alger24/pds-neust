<?php
require 'conn.php';
require 'func.php';
session_start();

// User Registration v1.0
if (isset($_POST['register_btn'])) {
    $uid = "user" . bin2hex(random_bytes(7));
    $main = $_POST['main'];
    $psl = $_POST['psl'];
    $addr = $_POST['addr'];

    try {
        foreach ($main as $key => $value) {
            $columns[] = "{$key}";
            $fields[] = ":{$key}";
        }
        $sql = "INSERT INTO user_main_tbl (user_id, ";
        $sql .= implode(", ", $columns) . ", main_created) VALUES (:user_id, ";
        $sql .= implode(", ", $fields) . ", NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":user_id", $uid);
        foreach ($main as $key2 => $value2) {
            $stmt->bindValue(":".$key2, $value2);
        }
        $stmt->execute();
    } catch (PDOException $e) {
        echo "<br>" . $e->getMessage();
    }

    userRegister($conn, $psl, "user_psl_tbl", $uid);
    userRegister($conn, $addr, "user_addr_tbl", $uid);

    // WARNING INITIALIIZE ID OF USER IN NEEDED TABLE!!!!
    
    // // Insert registration activity to the log
    // $str1 = ucfirst($psl['psl_user_fname']) . " " . ucfirst($psl['psl_user_sname']);
    // $str2 = "User named: $str1," . " has just created an account.";
    // try {
    //     $sql = "INSERT INTO activity_log (act_time, act_text) VALUES ";
    //     $sql .= "(NOW(), :act_text)";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindValue(':act_text', $str2);
    //     $stmt->execute();
    // } catch (PDOException $e) {
    //     echo "<br>" . $e->getMessage();
    // }

    // try {
    //     $sql = "
    //     INSERT INTO `user_main_tbl` (`user_id`, `main_user_email`, `main_user_pass`, `main_created`) VALUES (:userid, :main_user_email, :main_user_pass, NOW());
    //     INSERT INTO `user_psl_tbl` (`user_id`, `psl_user_sname`, `psl_user_fname`, `psl_user_mname`, `psl_user_bdate`) VALUES (:userid, :psl_user_sname, :psl_user_fname, :psl_user_mname, :psl_user_bdate);
    //     INSERT INTO `user_addr_tbl` (`user_id`, `addr_user_brgy`, `addr_user_city`, `addr_user_prov`) VALUES (:userid, :addr_user_brgy, :addr_user_city, :addr_user_prov);

    //     INSERT INTO `user_card_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_educbg_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_fmly_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_lnd_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_other1_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_other2_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_proof_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_ref_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_service_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_vlntry_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `user_work_tbl` (`user_id`) VALUES (:userid);
    //     INSERT INTO `activity_log` (`act_time`, `act_text`) VALUES (NOW(), :act_text);
    //     ";

    //     $insert = $conn->prepare($sql);
    //     $insert->execute([
    //         ':userid' => $uid,
    //         ':main_user_email' => $main_user_email,
    //         ':main_user_pass' => $main_user_pass,
    //         ':psl_user_sname' => $psl_user_sname,
    //         ':psl_user_fname' => $psl_user_fname,
    //         ':psl_user_mname' => $psl_user_mname,
    //         ':psl_user_bdate' => $psl_user_bdate,
    //         ':addr_user_brgy' => $addr_user_brgy,
    //         ':addr_user_city' => $addr_user_city,
    //         ':addr_user_prov' => $addr_user_prov,
    //         ':act_text' => $str3
    //     ]);
    // } catch (PDOException $e) {
    //     echo "<br>" . $e->getMessage();
    // } finally {
    //     $conn = NULL;
    // }

    // Disable redirect if record user doesn't appear on the database
    header("Location: ../index.php?success=You're registered! YAY!");
}

// user login w/ admin exit
if (isset($_POST['login_btn'])) {
    $main_user_email = $_POST['user_email'];
    $main_user_pass = $_POST['user_pass'];

    //redirect to admin login page
    if ("admin" === $main_user_email && "admin" === $main_user_pass) {
        die(header("Location: ../page_admin/aindex.php"));
    }

    try {
        $select = $conn->prepare("SELECT `user_id` FROM `user_main_tbl` WHERE `main_user_email` = :main_user_email AND `main_user_pass` = :main_user_pass");
        $select->execute([
            ':main_user_email' => $main_user_email,
            ':main_user_pass' => $main_user_pass
        ]);
        $result = $select->fetchColumn();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $_SESSION['user_id'] = $result;
    header("Location: ../page_user/uindex.php?success=Welcome back!");
}

//  NOTE: FINISH ADMIN AFTER USER!!! login admin
if (isset($_POST['login_admin_btn'])) {
    $admin_name = $_POST['admin_name'];
    $admin_pass = $_POST['admin_pass'];

    try {
        $select = $conn->prepare("SELECT `admin_id` FROM `admin_tbl` WHERE `admin_name` = :admin_name AND `admin_pass` = :admin_pass");
        $select->execute([
            ':admin_name' => $admin_name,
            ':admin_pass' => $admin_pass
        ]);
        $result = $select->fetchColumn();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // echo $result;
    $_SESSION['admin_id'] = $result;
    header("Location: ../page_admin/ahome.php?success=Welcome back, Admin!");
}


// redirect unauthorized access
// header("location: ../index.php?error=Oops, looks like your trying to access a restricted page!");
// die();