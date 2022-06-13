<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];


_userheader("Work Experience View");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
<fieldset disabled="disabled">
        <span>Work Experience</span>
        <?php
        $getwork = userSelect($conn, "user_work_tbl", $uid, null, null);
        ?>
        <table class="zui-table" width="100%">
            <thead>
                <tr>
                    <th scope="col" colspan="2">28. INCLUSSIVE DATES(mm/dd/yyyy)<br>
                        FROM | TO</th>
                    <th scope="col"> POSITION TITLE<br>
                        (Write in full/Do not abbrevriate)</th>
                    <th scope="col">DEPARTMENT/AGENCY/OFFICE/COMPANY<br>
                        (Write in full/Do not abbrevriate)</th>
                    <th scope="col"> MONTHLY SALARY</th>
                    <th scope="col">SALARY/JOB/PAY GRADE
                        (if applicable)&STEP(format"00-0")<br>
                        /INCREMENT</th>
                    <th scope="col">STATUS OF<br>
                        APPOINTMENT</th>
                    <th scope="col">GOV'T SERVICE<br>
                        (Y/N)</th>
                    <th colspan="2">Option</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($getwork) {
                    while ($rows = $getwork->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                        <tr>
                        <td>" . $rows['work_user_from'] . "</td>
                        <td>" . $rows['work_user_to'] . "</td>
                        <td>" . $rows['work_user_title'] . "</td>
                        <td>" . $rows['work_user_depart'] . "</td>
                        <td>" . $rows['work_user_sal'] . "</td>
                        <td>" . $rows['work_user_salgrad'] . "</td>
                        <td>" . $rows['work_user_status'] . "</td>
                        <td>" . $rows['work_user_gov'] . "</td>
                        <td><a href='work.php?page_option=2&work_id=" . $rows['work_id'] . "'>Edit</a><td>
                        <td><a href='work.php?page_option=3&work_id=" . $rows['work_id'] . "'>Delete</a><td>
                        </tr>
                        ";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <td><?= "<a href='work.php?page_option=1'>Add</a>" ?></td>
            </tfoot>
        </table>
    </fieldset>
</form>

<?php _userfooter(2022) ?>