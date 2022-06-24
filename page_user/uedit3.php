<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];
check_id($conn, $uid, "user");

echo "<h1>Edit Educational Background</h1>
        $uid<br>";
_userheader("Test");
?>
<!-- Style Sheet Link -->
<link rel="stylesheet" href="css/style-user.css">

<br><a href="uindex.php">Go back</a>
<form action="uconfig.php" method="get">
    <fieldset>
        <span>Educational Background</span>
        <table class="zui-table" width="100%">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Name of School<br>(Write in full)</th>
                    <th>Basic Education/Degree/Course<br>(Write in full)</th>
                    <th colspan="2">Period of Attendance
                        <br>From To
                    </th>
                    <th>Highest Level/Units Eraned</th>
                    <th>Year Graduated</th>
                    <th>Scholarship/Academic Honors Received</th>
                </tr>
            </thead>
            <?php
            // Thissss is selects everything
            $data1 = userSelect($conn, "user_elembg_tbl", $uid, null, null);
            foreach ($data1 as $rows) {
                $arr1 = $rows;
            }
            $data2 = userSelect($conn, "user_secobg_tbl", $uid, null, null);
            foreach ($data2 as $rows) {
                $arr2 = $rows;
            }
            $data3 = userSelect($conn, "user_vocabg_tbl", $uid, null, null);
            foreach ($data3 as $rows) {
                $arr3 = $rows;
            }
            $data4 = userSelect($conn, "user_collbg_tbl", $uid, null, null);
            foreach ($data4 as $rows) {
                $arr4 = $rows;
            }
            $data5 = userSelect($conn, "user_gradbg_tbl", $uid, null, null);
            foreach ($data5 as $rows) {
                $arr5 = $rows;
            }



            ?>
            <tbody>
                <tr>
                    <td>
                        Elementary
                    </td>
                    <td><input type="text" name="elembg[elembg_user_name]" id="" value="<?= (isset($arr1['elembg_user_name'])) ? $arr1['elembg_user_name'] : '' ?>"></td>
                    <td><input type="text" name="elembg[elembg_user_degre]" id="" value="<?= (isset($arr1['elembg_user_degre'])) ? $arr1['elembg_user_degre'] : '' ?>"></td>
                    <td><input type="date" name="elembg[elembg_user_pfrom]" id="" value="<?= (isset($arr1['elembg_user_pfrom'])) ? $arr1['elembg_user_pfrom'] : '' ?>"></td>
                    <td><input type="date" name="elembg[elembg_user_pto]" id="" value="<?= (isset($arr1['elembg_user_pto'])) ? $arr1['elembg_user_pto'] : '' ?>"></td>
                    <td><input type="text" name="elembg[elembg_user_earn]" id="" value="<?= (isset($arr1['elembg_user_earn'])) ? $arr1['elembg_user_earn'] : '' ?>"></td>
                    <td><input type="text" name="elembg[elembg_user_grad]" id="" value="<?= (isset($arr1['elembg_user_grad'])) ? $arr1['elembg_user_grad'] : '' ?>"></td>
                    <td><input type="text" name="elembg[elembg_user_reci]" id="" value="<?= (isset($arr1['elembg_user_reci'])) ? $arr1['elembg_user_reci'] : '' ?>"></td>
                </tr>
                <tr>
                    <td>
                        Secondary
                    </td>
                    <td><input type="text" name="secobg[secobg_user_name]" id="" value="<?= (isset($arr2['secobg_user_name'])) ? $arr2['secobg_user_name'] : '' ?>"></td>
                    <td><input type="text" name="secobg[secobg_user_degre]" id="" value="<?= (isset($arr2['secobg_user_degre'])) ? $arr2['secobg_user_degre'] : '' ?>"></td>
                    <td><input type="date" name="secobg[secobg_user_pfrom]" id="" value="<?= (isset($arr2['secobg_user_pfrom'])) ? $arr2['secobg_user_pfrom'] : '' ?>"></td>
                    <td><input type="date" name="secobg[secobg_user_pto]" id="" value="<?= (isset($arr2['secobg_user_pto'])) ? $arr2['secobg_user_pto'] : '' ?>"></td>
                    <td><input type="text" name="secobg[secobg_user_earn]" id="" value="<?= (isset($arr2['secobg_user_earn'])) ? $arr2['secobg_user_earn'] : '' ?>"></td>
                    <td><input type="text" name="secobg[secobg_user_grad]" id="" value="<?= (isset($arr2['secobg_user_grad'])) ? $arr2['secobg_user_grad'] : '' ?>"></td>
                    <td><input type="text" name="secobg[secobg_user_reci]" id="" value="<?= (isset($arr2['secobg_user_reci'])) ? $arr2['secobg_user_reci'] : '' ?>"></td>
                </tr>
                <tr>
                    <td>
                        Vocational/Trade Course
                    </td>
                    <td><input type="text" name="vocabg[vocabg_user_name]" id="" value="<?= (isset($arr3['vocabg_user_name'])) ? $arr3['vocabg_user_name'] : '' ?>"></td>
                    <td><input type="text" name="vocabg[vocabg_user_degre]" id="" value="<?= (isset($arr3['vocabg_user_degre'])) ? $arr3['vocabg_user_degre'] : '' ?>"></td>
                    <td><input type="date" name="vocabg[vocabg_user_pfrom]" id="" value="<?= (isset($arr3['vocabg_user_pfrom'])) ? $arr3['vocabg_user_pfrom'] : '' ?>"></td>
                    <td><input type="date" name="vocabg[vocabg_user_pto]" id="" value="<?= (isset($arr3['vocabg_user_pto'])) ? $arr3['vocabg_user_pto'] : '' ?>"></td>
                    <td><input type="text" name="vocabg[vocabg_user_earn]" id="" value="<?= (isset($arr3['vocabg_user_earn'])) ? $arr3['vocabg_user_earn'] : '' ?>"></td>
                    <td><input type="text" name="vocabg[vocabg_user_grad]" id="" value="<?= (isset($arr3['vocabg_user_grad'])) ? $arr3['vocabg_user_grad'] : '' ?>"></td>
                    <td><input type="text" name="vocabg[vocabg_user_reci]" id="" value="<?= (isset($arr3['vocabg_user_reci'])) ? $arr3['vocabg_user_reci'] : '' ?>"></td>
                </tr>
                <tr>
                    <td>
                        College
                    </td>
                    <td><input type="text" name="collbg[collbg_user_name]" id="" value="<?= (isset($arr4['collbg_user_name'])) ? $arr4['collbg_user_name'] : '' ?>"></td>
                    <td><input type="text" name="collbg[collbg_user_degre]" id="" value="<?= (isset($arr4['collbg_user_degre'])) ? $arr4['collbg_user_degre'] : '' ?>"></td>
                    <td><input type="date" name="collbg[collbg_user_pfrom]" id="" value="<?= (isset($arr4['collbg_user_pfrom'])) ? $arr4['collbg_user_pfrom'] : '' ?>"></td>
                    <td><input type="date" name="collbg[collbg_user_pto]" id="" value="<?= (isset($arr4['collbg_user_pto'])) ? $arr4['collbg_user_pto'] : '' ?>"></td>
                    <td><input type="text" name="collbg[collbg_user_earn]" id="" value="<?= (isset($arr4['collbg_user_earn'])) ? $arr4['collbg_user_earn'] : '' ?>"></td>
                    <td><input type="text" name="collbg[collbg_user_grad]" id="" value="<?= (isset($arr4['collbg_user_grad'])) ? $arr4['collbg_user_grad'] : '' ?>"></td>
                    <td><input type="text" name="collbg[collbg_user_reci]" id="" value="<?= (isset($arr4['collbg_user_reci'])) ? $arr4['collbg_user_reci'] : '' ?>"></td>
                </tr>
                <tr>
                    <td>
                        Graduate Studies
                    </td>
                    <td><input type="text" name="gradbg[gradbg_user_name]" id="" value="<?= (isset($arr5['gradbg_user_name'])) ? $arr5['gradbg_user_name'] : '' ?>"></td>
                    <td><input type="text" name="gradbg[gradbg_user_degre]" id="" value="<?= (isset($arr5['gradbg_user_degre'])) ? $arr5['gradbg_user_degre'] : '' ?>"></td>
                    <td><input type="date" name="gradbg[gradbg_user_pfrom]" id="" value="<?= (isset($arr5['gradbg_user_pfrom'])) ? $arr5['gradbg_user_pfrom'] : '' ?>"></td>
                    <td><input type="date" name="gradbg[gradbg_user_pto]" id="" value="<?= (isset($arr5['gradbg_user_pto'])) ? $arr5['gradbg_user_pto'] : '' ?>"></td>
                    <td><input type="text" name="gradbg[gradbg_user_earn]" id="" value="<?= (isset($arr5['gradbg_user_earn'])) ? $arr5['gradbg_user_earn'] : '' ?>"></td>
                    <td><input type="text" name="gradbg[gradbg_user_grad]" id="" value="<?= (isset($arr5['gradbg_user_grad'])) ? $arr5['gradbg_user_grad'] : '' ?>"></td>
                    <td><input type="text" name="gradbg[gradbg_user_reci]" id="" value="<?= (isset($arr5['gradbg_user_reci'])) ? $arr5['gradbg_user_reci'] : '' ?>"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" name="uedit3-btn">Test</button>
    </fieldset>
</form>

<?php _userfooter(2022); ?>