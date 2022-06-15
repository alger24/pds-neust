<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];


_userheader("Other Information View");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
    <fieldset disabled="disabled">
        <span>Other Information</span>
        <?php
        $getother1 = userSelect($conn, "user_other1_tbl", $uid, null, null)
        ?>
        <table class="zui-table" width="100%">
            <thead>
                <tr>
                    <th>31. SPECIAL SKILLS and HOBBIES</th>
                    <th>32. NON-ACADEMIC DISTINCTIONS/RECOGNITION<br>
                        (Write in full)</th>
                    <th>33. MEMBERSHIO IN ASSOCIATION/ORGANIZATION<br>
                        (Write in full)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($getother1) {
                    while ($rows = $getother1->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                        <tr>
                        <td>" . $rows['other1_user_skills'] . "</td>
                        <td>" . $rows['other1_user_recog'] . "</td>
                        <td>" . $rows['other1_user_member'] . "</td>
                        <td><a href='other1.php?page_option=2&other1_id=" . $rows['other1_id'] . "'>Edit</a><td>
                        <td><a href='other1.php?page_option=3&other1_id=" . $rows['other1_id'] . "'>Delete</a><td>
                        </tr>
                        ";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <td><?= "<a href='other1.php?page_option=1'>Add</a>" ?></td>
            </tfoot>
        </table>
    </fieldset>
</form>

<?php _userfooter(2022) ?>