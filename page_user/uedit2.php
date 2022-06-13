<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];
check_id($conn, $uid, "user");

$stmt = userSelect($conn, "user_fmly_tbl", $uid, null, null);
$arr1 = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<h1>Edit Family Background</h1>
        $uid<br>";
_userheader("Test");
?>
<!-- Style Sheet Link -->
<link rel="stylesheet" href="css/style-user.css">

<br><a href="uindex.php">UWU go back</a>
<form action="uconfig.php" method="get">
    <fieldset>
        <label for="spous_surname">Spouse's Surname </label>
        <input type="text" name="fmly[fmly_spous_sname]" id="spous_surname" value="<?= (isset($arr1['fmly_spous_sname'])) ?  $arr1['fmly_spous_sname'] : '' ?>">
        <label for="spous_firName">First Name </label>
        <input type="text" name="fmly[fmly_spous_fname]" id="spous_fname" value="<?= (isset($arr1['fmly_spous_fname'])) ?  $arr1['fmly_spous_fname'] : '' ?>">
        <label for="spous_midName">Middle Name </label>
        <input type="text" name="fmly[fmly_spous_mname]" id="spous_name" value="<?= (isset($arr1['fmly_spous_mname'])) ?  $arr1['fmly_spous_mname'] : '' ?>">
        <label for="spous_occup">Occupation </label>
        <input type="text" name="fmly[fmly_spous_occup]" id="spous_occup" value="<?= (isset($arr1['fmly_spous_occup'])) ?  $arr1['fmly_spous_occup'] : '' ?>">
        <label for="spous_empl">Employer/Business name </label>
        <input type="text" name="fmly[fmly_spous_emplyr_name]" id="spous_empl" value="<?= (isset($arr1['fmly_spous_emplyr_name'])) ?  $arr1['fmly_spous_emplyr_name'] : '' ?>">
        <label for="spous_busines_addr">Business Address</label>
        <input type="text" name="fmly[fmly_spous_busines_addr]" id="spous_busines_addr" value="<?= (isset($arr1['fmly_spous_busines_addr'])) ?  $arr1['fmly_spous_busines_addr'] : '' ?>">
        <label for="spous_telno">Telephone No.</label>
        <input type="text" name="fmly[fmly_spous_telno]" id="spous_telno" value="<?= (isset($arr1['fmly_spous_telno'])) ?  $arr1['fmly_spous_telno'] : '' ?>">
        <br><br>
        <table>
        <span>Name of Children</span>
            <thead>
                <th>No.</th>
                <th>Name of Children</th>
                <th>Date of Birth</th>
                <th>Options</th>
            </thead>
            <tbody>
            <?php
                $getchild = userSelect($conn, "user_child_tbl", $uid, null, null);
                
                $i=0;
                if($getchild){
                    foreach ($getchild as $rows) {
                        $i++;
                        echo "
                        <tr>
                        <td>$i</td>
                        <td>" . $rows['child_user_name'] . "</td>
                        <td>" . $rows['child_user_bdate'] . "</td>
                        <td><a href='child.php?page_option=2&child_id=" . $rows['child_id'] . "'>Edit</a><td>
                        <td><a href='child.php?page_option=3&child_id=" . $rows['child_id'] . "'>Delete</a><td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<td colspan='4'>N/A<td>";
                }
            ?>
            </tbody>
            <tfoot>
                <td><?= "<a href='child.php?page_option=1'>Add Child</a>" ?></td>
            </tfoot>
        </table>
        <br>
        <label for="sname_fthr">24. Father's Surname </label>
        <input type="text" name="fmly[fmly_user_sname_fthr]" id="sname_fthr" value="<?= (isset($arr1['fmly_user_sname_fthr'])) ?  $arr1['fmly_user_sname_fthr'] : '' ?>">
        <label for="fname_fthr">First Name </label>
        <input type="text" name="fmly[fmly_user_fname_fthr]" id="fname_fthr" value="<?= (isset($arr1['fmly_user_fname_fthr'])) ?  $arr1['fmly_user_fname_fthr'] : '' ?>">
        <label for="mname_fthr">Middle Name </label>
        <input type="text" name="fmly[fmly_user_mname_fthr]" id="mname_fthr" value="<?= (isset($arr1['fmly_user_mname_fthr'])) ?  $arr1['fmly_user_mname_fthr'] : '' ?>">
        <br><br>
        <label for="maiden_mthr">25. Mother's Maiden Name </label>
        <input type="text" name="fmly[fmly_user_maiden_mthr]" id="maiden_mthr" value="<?= (isset($arr1['fmly_user_maiden_mthr'])) ?  $arr1['fmly_user_maiden_mthr'] : '' ?>">
        <label for="sname_mthr">Surname </label>
        <input type="text" name="fmly[fmly_user_sname_mthr]" id="sname_mthr" value="<?= (isset($arr1['fmly_user_sname_mthr'])) ?  $arr1['fmly_user_sname_mthr'] : '' ?>">
        <label for="mname_mthr">First Name </label>
        <input type="text" name="fmly[fmly_user_fname_mthr]" id="mname_mthr" value="<?= (isset($arr1['fmly_user_fname_mthr'])) ?  $arr1['fmly_user_fname_mthr'] : '' ?>">
        <label for="mname_mthr">Middle Name </label>
        <input type="text" name="fmly[fmly_user_mname_mthr]" id="mname_mthr" value="<?= (isset($arr1['fmly_user_mname_mthr'])) ?  $arr1['fmly_user_mname_mthr'] : '' ?>">
        <button type="submit" name="uedit2-btn">Test</button>
    </fieldset>
</form>

<?php _userfooter(2022); ?>