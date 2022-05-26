<?php
require 'conn.php';
require 'func.php';
session_start();

// User Registration v1.0
if (isset($_POST['register_btn'])) {
    $uid = bin2hex(random_bytes(11));

    $psl_user_sname = $_POST['user_sname'];
    $psl_user_fname = $_POST['user_fname'];
    $psl_user_mname = $_POST['user_mname'];
    $psl_user_bdate = $_POST['user_bday'];
    $addr_user_brgy = $_POST['user_brgy'];
    $addr_user_city = $_POST['user_city'];
    $addr_user_prov = $_POST['user_prov'];
    $main_user_email = $_POST['user_email'];
    $main_user_pass = $_POST['user_pass'];

    $str1 = ucfirst($psl_user_fname);
    $str2 = ucfirst($psl_user_sname);
    $str3 = "A user named: $str1 $str2, has just created an account.";

    try {
        $sql = "
        INSERT INTO `user_main_tbl` (`user_id`, `main_user_email`, `main_user_pass`, `main_created`) VALUES (:userid, :main_user_email, :main_user_pass, NOW());
        INSERT INTO `user_psl_tbl` (`user_id`, `psl_user_sname`, `psl_user_fname`, `psl_user_mname`, `psl_user_bdate`) VALUES (:userid, :psl_user_sname, :psl_user_fname, :psl_user_mname, :psl_user_bdate);
        INSERT INTO `user_addr_tbl` (`user_id`, `addr_user_brgy`, `addr_user_city`, `addr_user_prov`) VALUES (:userid, :addr_user_brgy, :addr_user_city, :addr_user_prov);
        INSERT INTO `user_card_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_educbg_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_fmly_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_lnd_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_other1_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_other2_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_proof_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_ref_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_service_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_vlntry_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `user_work_tbl` (`user_id`) VALUES (:userid);
        INSERT INTO `activity_log` (`act_time`, `act_text`) VALUES (NOW(), :act_text);
        ";

        $insert = $conn->prepare($sql);
        $insert->execute([
            ':userid' => $uid,
            ':main_user_email' => $main_user_email,
            ':main_user_pass' => $main_user_pass,
            ':psl_user_sname' => $psl_user_sname,
            ':psl_user_fname' => $psl_user_fname,
            ':psl_user_mname' => $psl_user_mname,
            ':psl_user_bdate' => $psl_user_bdate,
            ':addr_user_brgy' => $addr_user_brgy,
            ':addr_user_city' => $addr_user_city,
            ':addr_user_prov' => $addr_user_prov,
            ':act_text' => $str3
        ]);
    } catch (PDOException $e) {
        echo "<br>" . $e->getMessage();
    } finally {
        $conn = NULL;
    }

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

if (isset($_GET['user_pds_btn'])) {
    $uid = $_SESSION['user_id'];
    $psl_user_sname = $_GET['user_sname'];
    $psl_user_fname = $_GET['user_fname'];
    $psl_user_mname = $_GET['user_mname'];
    $psl_user_bdate = $_GET['user_bdate'];
    $psl_user_bplace = $_GET['user_bplace'];
    $psl_user_sex = $_GET['user_sex'];
    $psl_user_civil = $_GET['user_civil'];
    $psl_user_height = $_GET['user_height'];
    $psl_user_weight = $_GET['user_weight'];
    $psl_user_blood = $_GET['user_blood'];
    $psl_user_ctzn = $_GET['user_ctzn'];
    $psl_user_tel = $_GET['user_tel'];
    $psl_user_mobile = $_GET['user_mobile'];
    $card_user_gsis = $_GET['user_gsis'];
    $card_user_ibig = $_GET['user_ibig'];
    $card_user_phil = $_GET['user_phil'];
    $card_user_sss = $_GET['user_sss'];
    $card_user_tin = $_GET['user_tin'];
    $card_user_mply = $_GET['user_mply'];
    $addr_user_hbl = $_GET['user_hbl'];
    $addr_user_strt = $_GET['user_strt'];
    $addr_user_subdiv = $_GET['user_subdiv'];
    $addr_user_brgy = $_GET['user_brgy'];
    $addr_user_city = $_GET['user_city'];
    $addr_user_prov = $_GET['user_prov'];
    $addr_user_zip = $_GET['user_zip'];

    $str1 = ucfirst($psl_user_fname);
    $str2 = ucfirst($psl_user_sname);
    $str3 = "A user named: $str1 $str2, has just modify/updated their personal data.";

    try {
        $sql = "
        UPDATE `user_main_tbl` SET `main_user_email`=:main_user_email, `main_modified`=NOW() WHERE `user_main_tbl`.`user_id`=:userid;
        UPDATE `user_psl_tbl` SET `psl_user_sname`=:psl_user_sname, `psl_user_fname`=:psl_user_fname, `psl_user_mname`=:psl_user_mname, `psl_user_bdate`=:psl_user_bdate, `psl_user_bplace`=:psl_user_bplace, `psl_user_sex`=:psl_user_sex, `psl_user_civil`=:psl_user_civil, `psl_user_height`=:psl_user_height, `psl_user_weight`=:psl_user_weight, `psl_user_blood`=:psl_user_blood, `psl_user_ctzn`=:psl_user_ctzn, `psl_user_tel`=:psl_user_tel, `psl_user_mobile`=:psl_user_mobile WHERE `user_psl_tbl`.`user_id`=:userid;
        UPDATE `user_card_tbl` SET `card_user_gsis`=:card_user_gsis, `card_user_ibig`=:card_user_ibig, `card_user_phi`l=:card_user_phil, `card_user_sss`=:card_user_sss, `card_user_tin`=:card_user_tin, `card_user_mply`=:card_user_mply WHERE `user_card_tbl`.`user_id`=:userid;
        UPDATE `user_addr_tbl` SET `addr_user_hbl`=:addr_user_hbl, `addr_user_strt`=:addr_user_strt, `addr_user_subdiv`=:addr_user_subdiv, `addr_user_brgy`=:addr_user_brgy, `addr_user_city`=:addr_user_city, `addr_user_prov`=:addr_user_prov, `addr_user_zip`=:addr_user_zip WHERE `user_addr_tbl`.`user_id`=:userid;
        INSERT INTO `activity_log` (`act_time`, `act_text`) VALUES (NOW(), :act_text);
        ";

        $update = $conn->prepare($sql);
        $update->execute([
            ':userid' => $uid,
            ':main_user_email' => $main_user_email,
            ':psl_user_sname' => $psl_user_sname,
            ':psl_user_fname' => $psl_user_fname,
            ':psl_user_mname' => $psl_user_mname,
            ':psl_user_bdate' => $psl_user_bdate,
            ':psl_user_bplace' => $psl_user_bplace,
            ':psl_user_sex' => $psl_user_sex,
            ':psl_user_civil' => $psl_user_civil,
            ':psl_user_height' => $psl_user_height,
            ':psl_user_weight' => $psl_user_weight,
            ':psl_user_blood' => $psl_user_blood,
            ':psl_user_ctzn' => $psl_user_ctzn,
            ':psl_user_tel' => $psl_user_tel,
            ':psl_user_mobile' => $psl_user_mobile,
            ':card_user_gsis' => $card_user_gsis,
            ':card_user_ibig' => $card_user_ibig,
            ':card_user_phil' => $card_user_phil,
            ':card_user_sss' => $card_user_sss,
            ':card_user_tin' => $card_user_tin,
            ':card_user_mply' => $card_user_mply,
            ':addr_user_hbl' => $addr_user_hbl,
            ':addr_user_strt' => $addr_user_strt,
            ':addr_user_subdiv' => $addr_user_subdiv,
            ':addr_user_brgy' => $addr_user_brgy,
            ':addr_user_city' => $addr_user_city,
            ':addr_user_prov' => $addr_user_prov,
            ':addr_user_zip' => $addr_user_zip,
            ':act_text' => $str3
        ]);
    } catch (PDOException $e) {
        echo "<br>" . $e->getMessage();
    } finally {
        $conn = NULL;
        
    }
    echo 'Success';
    // Disable redirect if record user doesn't appear on the database
    // header("Location: ../index.php?success=You're registered! YAY!");
}

// redirect unauthorized access
// header("location: ../index.php?error=Oops, looks like your trying to access a restricted page!");
// die();