<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];


_userheader("Civil Service Elegibility View");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
<fieldset disabled="disabled">
        <span>IV. Civil Service Elegibility</span>
        <?php
            $getcivil = userSelect($conn, "user_civil_tbl", $uid, null, null);
        ?>
        <table class="zui-table" width="100%">
            <thead>
                <tr>
                    <th>27. CAREER SERVICE/RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE BARANGAY ELIGIBILITY/DRIVERS LICENSE</th>
                    <th>RATING (if applicable)</th>
                    <th>DATE EXAMINATION/CONFERMENT</th>
                    <th>PLACE OF EXAMINATION/CONFERMENT</th>
                    <th colspan="2">LICENSE (if applicable)<br>
                        NUMBER | VALIDITY</th>
                    </th>
                    <th colspan="2">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($getcivil) {
                    while ($rows = $getcivil->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                        <tr>
                        <td>" . $rows['civil_user_info'] . "</td>
                        <td>" . $rows['civil_user_rate'] . "</td>
                        <td>" . $rows['civil_user_exam'] . "</td>
                        <td>" . $rows['civil_user_addr'] . "</td>
                        <td>" . $rows['civil_user_lcnnum'] . "</td>
                        <td>" . $rows['civil_user_lcndate'] . "</td>
                        <td><a href='civil.php?page_option=2&civil_id=" . $rows['civil_id'] . "'>Edit</a><td>
                        <td><a href='civil.php?page_option=3&civil_id=" . $rows['civil_id'] . "'>Delete</a><td>
                        </tr>
                        ";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <td><?= "<a href='civil.php?page_option=1'>Add</a>" ?></td>
            </tfoot>
        </table>
    </fieldset>
</form>

<?php _userfooter(2022) ?>