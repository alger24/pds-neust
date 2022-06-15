<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];

_userheader("Other Information Page");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
    <?php
    $option = $_GET['page_option'];
    switch ($option) {
        case 1: // Add
            echo "
            <h1>Add Other Information</h1>
            <fieldset>
                <table>
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
                        <tr>
                            <td><input type='text' name='uother1[other1_user_skills]' id=''></td>
                            <td><input type='text' name='uother1[other1_user_recog]' id=''></td>
                            <td><input type='text' name='uother1[other1_user_member]' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='addother1-btn'>Add</button>
            </fieldset>
            ";
            break;

        case 2: // Edit
            $id2 = $_GET['other1_id'];
            $_SESSION['other1_id'] = $id2;
            $stmt = userSelect($conn, "user_other1_tbl", $uid, $id2, "other1_id");
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "
            <h1>Edit Learning and Development</h1>
            <fieldset>
                <table>
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
                        <tr>
                            <td><input type='text' name='uother1[other1_user_skills]' value='" . $data['other1_user_skills'] . "' id=''></td>
                            <td><input type='text' name='uother1[other1_user_recog]' value='" . $data['other1_user_recog'] . "' id=''></td>
                            <td><input type='text' name='uother1[other1_user_member]' value='" . $data['other1_user_member'] . "' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='editother1-btn'>Edit</button>
            </fieldset>
            ";
            break;

        case 3: // Delete
            $id2 = $_GET['other1_id'];
            $_SESSION['other1_id'] = $id2;

            echo "
            <h1>Delete Other Information?</h1>
            <button type='submit' name='deleteother1-btn'>Yes</button>
            <a href='pds-view.php'>No</a> 
            ";
            break;

        default:
            echo "error";
            break;
    }
    ?>
</form>



<?php _userfooter(2022) ?>