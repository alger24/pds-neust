<?php
require '../php/conn.php';
require '../php/func.php';
require 'udry.php';
session_start();

$user_id = $_SESSION['user_id'];
check_id(1, $user_id, $conn);

try {
    $sql = "
    SELECT * FROM `user_main_tbl`
    LEFT JOIN `user_psl_tbl`
    ON `user_main_tbl`.user_id = `user_psl_tbl`.user_id
    LEFT JOIN `user_card_tbl`
    ON `user_main_tbl`.user_id = `user_card_tbl`.user_id
    LEFT JOIN `user_addr_tbl`
    ON `user_main_tbl`.user_id = `user_addr_tbl`.user_id
    WHERE `user_main_tbl`.user_id=:userid
    ";

    $select = $conn->prepare($sql);
    $select->execute([':userid' => $user_id]);
    $rows = $select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$arr1 = array();
foreach ($rows as $data1) {
    $arr1 = $data1;
}

echo "<h1>Edit Personal Information</h1>
        $user_id<br>";
_userheader("Test");
?>
<!-- Style Sheet Link -->
<link rel="stylesheet" href="css/style-user.css">

<br><a href="uindex.php">UWU go back</a>
<form action="uconfig.php?user_id=<?= $user_id ?>" method="get">
    <fieldset>
        <label for="user_sname">Surname</label>
        <input type="text" name="psl[psl_user_sname]" id="user_sname" value="<?= (isset($arr1['psl_user_sname'])) ? $arr1['psl_user_sname'] : '' ?>">
        <label for="user_fname">First Name</label>
        <input type="text" name="psl[psl_user_fname]" id="user_fname" value="<?= (isset($arr1['psl_user_fname'])) ?  $arr1['psl_user_fname'] : '' ?>">
        <label for="user_mname">Middle Name</label>
        <input type="text" name="user_mname" id="user_mname" value="<?= (isset($arr1['psl_user_mname'])) ?  $arr1['psl_user_mname'] : '' ?>">
        <label for="user_bdate">Date of Birth</label>
        <input type="date" name="user_bdate" id="user_bdate" value="<?= (isset($arr1['psl_user_bdate'])) ?  $arr1['psl_user_bdate'] : '' ?>">
        <label for="plcBirt">Place of Birth</label>
        <input type="text" name="user_bplace" id="user_bplace" value="<?= (isset($arr1['psl_user_bplace'])) ?  $arr1['psl_user_bplace'] : '' ?>">
        <br><br>
        <span>Sex</span>
        <input type="radio" name="user_sex" id="mgender" <?= $arr1['psl_user_sex'] == "male" ? "checked" : "" ?> value="male">
        <label for="mgender">Male</label>
        <input type="radio" name="user_sex" id="fgender" <?= $arr1['psl_user_sex'] == "female" ? "checked" : "" ?> value="female">
        <label for="fgender">Female</label>
        <br><br>
        <span>Civil Status </span>
        <input type="radio" name="user_civil" id="scivil" <?= $arr1['psl_user_civil'] == "single" ? "checked" : "" ?> value="single">
        <label for="scivil">Single</label>
        <input type="radio" name="user_civil" id="mcivil" <?= $arr1['psl_user_civil'] == "married" ? "checked" : "" ?> value="married">
        <label for="mcivil">Married</label>
        <input type="radio" name="user_civil" id="wcivil" <?= $arr1['psl_user_civil'] == "widowed" ? "checked" : "" ?> value="widowed">
        <label for="wcivil">Widowed</label>
        <input type="radio" name="user_civil" id="sepcivil" <?= $arr1['psl_user_civil'] == "seperated" ? "checked" : "" ?> value="separated">
        <label for="sepcivil">Separated</label>
        <br><br>
        <label for="weight">Weight(kg) </label>
        <input type="text" name="user_weight" id="weight" value="<?= (isset($arr1['psl_user_weight'])) ?  $arr1['psl_user_weight'] : '' ?>">
        <label for="height">Height(m) </label>
        <input type="text" name="user_height" id="height" value="<?= (isset($arr1['psl_user_height'])) ?  $arr1['psl_user_height'] : '' ?>">
        <label for="blood">Blood Type </label>
        <input type="text" name="user_blood" id="blood" value="<?= (isset($arr1['psl_user_blood'])) ?  $arr1['psl_user_blood'] : '' ?>">
        <br><br>
        <label for="gsis">GSIS ID No </label>
        <input type="text" name="user_gsis" id="gsis" value="<?= (isset($arr1['card_user_gsis'])) ?  $arr1['card_user_gsis'] : '' ?>">
        <label for="ibig">PAG-IBIG ID No </label>
        <input type="text" name="user_ibig" id="ibig" value="<?= (isset($arr1['card_user_ibig'])) ?  $arr1['card_user_ibig'] : '' ?>">
        <label for="phil">PHILHEALTH No</label>
        <input type="text" name="user_phil" id="phil" value="<?= (isset($arr1['card_user_phil'])) ?  $arr1['card_user_phil'] : '' ?>">
        <label for="sss">SSS No </label>
        <input type="text" name="user_sss" id="sss" value="<?= (isset($arr1['card_user_sss'])) ?  $arr1['card_user_sss'] : '' ?>">
        <label for="tin">TIN No </label>
        <input type="text" name="user_tin" id="tin" value="<?= (isset($arr1['card_user_tin'])) ?  $arr1['card_user_tin'] : '' ?>">
        <label for="mply">AGENCY EMPLOYEE No</label>
        <input type="text" name="user_mply" id="mply" value="<?= (isset($arr1['card_user_mply'])) ?  $arr1['card_user_mply'] : '' ?>">
        <br><br>
        <span>Citizenship<br>(If holder of dual citizenship, please indicate the details.)</span>
        <input type="radio" name="user_ctzn" id="ctzn_filipino" <?= $arr1['psl_user_ctzn'] == "filipino" ? "checked" : "" ?> value="filipino">
        <label for="ctzn_filipino">Filipino</label>
        <br>
        <span>Dual Citizenship</span>
        <input type="radio" name="user_ctzn" id="ctzn_dual_birth" <?= $arr1['psl_user_ctzn'] == "dualBirth" ? "checked" : "" ?> value="dualBirth">
        <label for="ctzn_dual_birth">by birth</label>
        <input type="radio" name="user_ctzn" id="ctzn_dual_natural" <?= $arr1['psl_user_ctzn'] == "dualNatural" ? "checked" : "" ?> value="dualNatural">
        <label for="ctzn_dual_natural">by naturalization</label>
        <label for="ctzn_other">Pls. indicate country </label>
        <input type="text" name="user_ctzn_other" id="ctzn_other" value="<?= (isset($arr1['psl_user_ctzn_other'])) ?  $arr1['psl_user_ctzn_other'] : '' ?>">
        <br><br>
        <span>Residential Address</br></span>
        <label for="user_hbl">House/Block/Lot No. </label>
        <input type="text" name="user_hbl" id="user_hbl" value="<?= (isset($arr1['addr_user_hbl'])) ?  $arr1['addr_user_hbl'] : '' ?>">
        <label for="user_strt">Street </label>
        <input type="text" name="user_strt" id="user_strt" value="<?= (isset($arr1['addr_user_strt'])) ?  $arr1['addr_user_strt'] : '' ?>">
        <label for="user_subdiv">Subdivision/Village </label>
        <input type="text" name="user_subdiv" id="user_subdiv" value="<?= (isset($arr1['addr_user_subdiv'])) ?  $arr1['addr_user_subdiv'] : '' ?>">
        <label for="user_brgy">Barangay </label>
        <input type="text" name="user_brgy" id="user_brgy" value="<?= (isset($arr1['addr_user_brgy'])) ?  $arr1['addr_user_brgy'] : '' ?>">
        <label for="user_city">City/Municipality </label>
        <input type="text" name="user_city" id="user_city" value="<?= (isset($arr1['addr_user_city'])) ?  $arr1['addr_user_city'] : '' ?>">
        <label for="user_prov">Province </label>
        <input type="text" name="user_prov" id="user_prov" value="<?= (isset($arr1['addr_user_prov'])) ?  $arr1['addr_user_prov'] : '' ?>">
        <label for="user_zip">Zip Code </label>
        <input type="text" name=user_zip id="user_zip" value="<?= (isset($arr1['addr_user_zip'])) ?  $arr1['addr_user_zip'] : '' ?>">
        <br><br>
        <label for="user_tel">19. Telephone no. </label>
        <input type="text" name="user_tel" id="user_tel" value="<?= (isset($arr1['psl_user_tel'])) ?  $arr1['psl_user_tel'] : '' ?>">
        <label for="user_mobile">20. Mobile no. </label>
        <input type="text" name="user_mobile" id="user_mobile" value="<?= (isset($arr1['psl_user_mobile'])) ?  $arr1['psl_user_mobile'] : '' ?>">
        <label for="email">21. E-mail address (if any) </label>
        <input type="text" name="user_email" id="email" value="<?= (isset($arr1['main_user_email'])) ?  $arr1['main_user_email'] : '' ?>">
        <button type="submit" name="uedit1-btn">Test</button>
    </fieldset>
</form>

<?php _userfooter(2022); ?>