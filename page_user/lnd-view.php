<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];


_userheader("Learning and Development View");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
<fieldset disabled="disabled">
        <span>Learning and Development</span>
        <?php
            $getlnd = userSelect($conn, "user_lnd_tbl", $uid, null, null)
        ?>
        <table class="zui-table" width="100%">
            <thead>
                <tr>
                    <th>30. TITLE OF LEARNING AND DEVELOPMENT<br>
                        INTERVENTIONS/TRAINING PROGRAMS<br>
                        (Write in full)</th>
                    <th colspan="2">INCLUSIVE DATES OF ATTENDANCE<br>
                        FROM | TO</th>
                    <th>NUMBER OF HOURS</th>
                    <th>Type of I.D<br>
                        (Managerial/Supervisory/Technical/etc.)</th>
                    <th>CONDUCTED/SPONSORED BY<br>
                        (Write in full)</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($getlnd) {
                    while ($rows = $getlnd->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                        <tr>
                        <td>" . $rows['lnd_user_name'] . "</td>
                        <td>" . $rows['lnd_user_from'] . "</td>
                        <td>" . $rows['lnd_user_to'] . "</td>
                        <td>" . $rows['lnd_user_hr'] . "</td>
                        <td>" . $rows['lnd_user_spon'] . "</td>
                        <td><a href='lnd.php?page_option=2&lnd_id=" . $rows['lnd_id'] . "'>Edit</a><td>
                        <td><a href='lnd.php?page_option=3&lnd_id=" . $rows['lnd_id'] . "'>Delete</a><td>
                        </tr>
                        ";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <td><?= "<a href='lnd.php?page_option=1'>Add</a>" ?></td>
            </tfoot>
        </table>
    </fieldset>
</form>

<?php _userfooter(2022) ?>