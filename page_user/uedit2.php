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

echo "<h1>Edit Family Background</h1>
        $user_id<br>";
_userheader("Test");
?>
<!-- Style Sheet Link -->
<link rel="stylesheet" href="css/style-user.css">

<br><a href="uindex.php">UWU go back</a>
<form action="uconfig.php?user_id=<?= $user_id ?>" method="get">
    <fieldset>
      <label for="spous_surname">22. Spouse's Surname </label>
      <input type="text" name="spous_surname" id="spous_surname" value="<?= (isset($arr1['fmly_spous_sname'])) ?  $arr1['fmly_spous_sname'] : '' ?>">
      <label for="spous_firName">First Name </label>
      <input type="text" name="spous_fname" id="spous_fname" value="<?= (isset($arr1['fmly_spous_fname'])) ?  $arr1['fmly_spous_fname'] : '' ?>">
      <label for="spous_midName">Middle Name </label>
      <input type="text" name="spous_mname" id="spous_name" value="<?= (isset($arr1['fmly_spous_mname'])) ?  $arr1['fmly_spous_mname'] : '' ?>">
      <label for="spous_occup">Occupation </label>
      <input type="text" name="spous_occup" id="spous_occup" value="<?= (isset($arr1['fmly_spous_occup'])) ?  $arr1['fmly_spous_occup'] : '' ?>">
      <label for="spous_empl">Employer/Business name </label>
      <input type="text" name="spous_empl" id="spous_empl" value="<?= (isset($arr1['fmly_spous_emplyr_name'])) ?  $arr1['fmly_spous_emplyr_name'] : '' ?>">
      <label for="spous_busines_addr">Business Address</label>
      <input type="text" name="spous_busines_addr" id="spous_busines_addr" value="<?= (isset($arr1['fmly_spous_busines_addr'])) ?  $arr1['fmly_spous_busines_addr'] : '' ?>">
      <label for="spous_telno">Telephone No.</label>
      <input type="text" name="spous_telno" id="spous_telno" value="<?= (isset($arr1['fmly_spous_telno'])) ?  $arr1['fmly_spous_telno'] : '' ?>">
      <br><br>
      <label for="child_name">23. Name of Children </label>
      <input type="text" name="child_name" id="child_name" value="<?= (isset($arr1['fmly_'])) ?  $arr1['fmly_'] : '' ?>">
      <label for="child_bday">Date of birth</label>
      <input type="date" name="child_bday" id="child_bday" value="<?= (isset($arr1['fmly_'])) ?  $arr1['fmly_'] : '' ?>">
      <br><br>
      <label for="sname_fthr">24. Father's Surname </label>
      <input type="text" name="sname_fthr" id="sname_fthr" value="<?= (isset($arr1['fmly_user_sname_fthr'])) ?  $arr1['fmly_user_sname_fthr'] : '' ?>">
      <label for="fname_fthr">First Name </label>
      <input type="text" name="fname_fthr" id="fname_fthr" value="<?= (isset($arr1['fmly_user_fname_fthr'])) ?  $arr1['fmly_user_fname_fthr'] : '' ?>">
      <label for="mname_fthr">Middle Name </label>
      <input type="text" name="mname_fthr" id="mname_fthr" value="<?= (isset($arr1['fmly_user_mname_fthr'])) ?  $arr1['fmly_user_mname_fthr'] : '' ?>">
      <label for="maiden_mthr">25. Mother's Maiden Name </label>
      <input type="text" name="maiden_mthr" id="maiden_mthr" value="<?= (isset($arr1['fmly_user_maiden_mthr'])) ?  $arr1['fmly_user_maiden_mthr'] : '' ?>">
      <label for="sname_mthr">Surname </label>
      <input type="text" name="sname_mthr" id="sname_mthr" value="<?= (isset($arr1['fmly_user_sname_mthr'])) ?  $arr1['fmly_user_sname_mthr'] : '' ?>">
      <label for="mname_mthr">First Name </label>
      <input type="text" name="mname_mthr" id="mname_mthr" value="<?= (isset($arr1['fmly_user_fname_mthr'])) ?  $arr1['fmly_user_fname_mthr'] : '' ?>">
      <label for="mname_mthr">Middle Name </label>
      <input type="text" name="mname_mthr" id="mname_mthr" value="<?= (isset($arr1['fmly_user_mname_mthr'])) ?  $arr1['fmly_user_mname_mthr'] : '' ?>">
      <button type="submit" name="uedit2-btn">Test</button>
    </fieldset>
</form>

<?php _userfooter(2022); ?>