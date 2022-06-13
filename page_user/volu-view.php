<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];


_userheader("Voluntary Work View");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
<fieldset disabled="disabled">
        <span>Voluntary Work</span>
        <?php
            $getvolu = userSelect($conn, "user_volu_tbl", $uid, null, null)
        ?>
        <table class="zui-table" width="100%">
            <thead>
                <tr>
                    <th>29. NAME & ADDRESS OF ORGANIZATION<br>
                        (Write in full)</th>
                    <th colspan="2"> INCLUSIVE DATES<br>
                        (mm/dd/yyyy)<br>
                        FROM | TO</th>
                    <th>NUMBER OF HOURS</th>
                    <th>POSITION/NATURE OF WORK</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($getvolu) {
                    while ($rows = $getvolu->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                        <tr>
                        <td>" . $rows['volu_user_name'] . "</td>
                        <td>" . $rows['volu_user_from'] . "</td>
                        <td>" . $rows['volu_user_to'] . "</td>
                        <td>" . $rows['volu_user_hr'] . "</td>
                        <td>" . $rows['volu_user_posi'] . "</td>
                        <td><a href='work.php?page_option=2&volu_id=" . $rows['volu_id'] . "'>Edit</a><td>
                        <td><a href='work.php?page_option=3&volu_id=" . $rows['volu_id'] . "'>Delete</a><td>
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