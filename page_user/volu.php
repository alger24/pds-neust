<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];

_userheader("volu Experience Page");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>


    <fieldset>

    </fieldset>
    <?php
    $option = $_GET['page_option'];
    switch ($option) {
        case 1: // Add
            echo "
            <h1>Add Voluntary Work Experience</h1>
            <fieldset>
                <table>
                    <thead>
                        <tr>
                            <th>29. NAME & ADDRESS OF ORGANIZATION<br>
                                (Write in full)</th>
                            <th colspan='2'> INCLUSIVE DATES<br>
                                (mm/dd/yyyy)<br>
                                FROM | TO</th>
                            <th>NUMBER OF HOURS</th>
                            <th>POSITION/NATURE OF WORK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='text' name='uvolu[volu_user_name]' id=''></td>
                            <td><input type='date' name='uvolu[volu_user_from]' id=''></td>
                            <td><input type='date' name='uvolu[volu_user_to]' id=''></td>
                            <td><input type='text' name='uvolu[volu_user_hr]' id=''></td>
                            <td><input type='text' name='uvolu[volu_user_posi]' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='addvolu-btn'>Add</button>
            </fieldset>
            ";
            break;

        case 2: // Edit
            $id2 = $_GET['volu_id'];
            $_SESSION['volu_id'] = $id2;
            $stmt = userSelect($conn, "user_volu_tbl", $uid, $id2, "volu_id");
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "
            <h1>Edit Voluntary Work Experience</h1>
            <fieldset>
                <table>
                <thead>
                    <tr>
                        <th>29. NAME & ADDRESS OF ORGANIZATION<br>
                            (Write in full)</th>
                        <th colspan='2'> INCLUSIVE DATES<br>
                            (mm/dd/yyyy)<br>
                            FROM | TO</th>
                        <th>NUMBER OF HOURS</th>
                        <th>POSITION/NATURE OF WORK</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td><input type='text' name='uvolu[volu_user_name]' value='" . $data['volu_user_name'] . "' id=''></td>
                            <td><input type='date' name='uvolu[volu_user_from]' value='" . $data['volu_user_from'] . "' id=''></td>
                            <td><input type='date' name='uvolu[volu_user_to]' value='" . $data['volu_user_to'] . "' id=''></td>
                            <td><input type='text' name='uvolu[volu_user_hr]' value='" . $data['volu_user_hr'] . "' id=''></td>
                            <td><input type='text' name='uvolu[volu_user_posi]' value='" . $data['volu_user_posi'] . "' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='editvolu-btn'>Edit</button>
            </fieldset>
            ";
            break;

        case 3: // Delete
            $id2 = $_GET['volu_id'];
            $_SESSION['volu_id'] = $id2;

            echo "
            <h1>Delete Voluntary Work Experience?</h1>
            <button type='submit' name='deletevolu-btn'>Yes</button>
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