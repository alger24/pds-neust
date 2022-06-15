<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];

_userheader("lnd Experience Page");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
    <?php
    $option = $_GET['page_option'];
    switch ($option) {
        case 1: // Add
            echo "
            <h1>Add Learning Development</h1>
            <fieldset>
                <table>
                    <thead>
                        <tr>
                            <th>30. TITLE OF LEARNING AND DEVELOPMENT<br>
                                INTERVENTIONS/TRAINING PROGRAMS<br>
                                (Write in full)</th>
                            <th colspan='2'>INCLUSIVE DATES OF ATTENDANCE<br>
                                FROM | TO</th>
                            <th>NUMBER OF HOURS</th>
                            <th>Type of I.D<br>
                                (Managerial/Supervisory/Technical/etc.)</th>
                            <th>CONDUCTED/SPONSORED BY<br>
                                (Write in full)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='text' name='ulnd[lnd_user_name]' id=''></td>
                            <td><input type='date' name='ulnd[lnd_user_from]' id=''></td>
                            <td><input type='date' name='ulnd[lnd_user_to]' id=''></td>
                            <td><input type='text' name='ulnd[lnd_user_hr]' id=''></td>
                            <td><input type='text' name='ulnd[lnd_user_type]' id=''></td>
                            <td><input type='text' name='ulnd[lnd_user_spon]' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='addlnd-btn'>Add</button>
            </fieldset>
            ";
            break;

        case 2: // Edit
            $id2 = $_GET['lnd_id'];
            $_SESSION['lnd_id'] = $id2;
            $stmt = userSelect($conn, "user_lnd_tbl", $uid, $id2, "lnd_id");
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "
            <h1>Edit Learning and Development</h1>
            <fieldset>
                <table>
                <thead>
                    <tr>
                        <th>30. TITLE OF LEARNING AND DEVELOPMENT<br>
                        INTERVENTIONS/TRAINING PROGRAMS<br>
                        (Write in full)</th>
                        <th colspan='2'>INCLUSIVE DATES OF ATTENDANCE<br>
                            FROM | TO</th>
                        <th>NUMBER OF HOURS</th>
                        <th>Type of I.D<br>
                            (Managerial/Supervisory/Technical/etc.)</th>
                        <th>CONDUCTED/SPONSORED BY<br>
                            (Write in full)</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td><input type='text' name='ulnd[lnd_user_name]' value='" . $data['lnd_user_name'] . "' id=''></td>
                            <td><input type='date' name='ulnd[lnd_user_from]' value='" . $data['lnd_user_from'] . "' id=''></td>
                            <td><input type='date' name='ulnd[lnd_user_to]' value='" . $data['lnd_user_to'] . "' id=''></td>
                            <td><input type='text' name='ulnd[lnd_user_hr]' value='" . $data['lnd_user_hr'] . "' id=''></td>
                            <td><input type='text' name='ulnd[lnd_user_type]' value='" . $data['lnd_user_type'] . "' id=''></td>
                            <td><input type='text' name='ulnd[lnd_user_spon]' value='" . $data['lnd_user_spon'] . "' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='editlnd-btn'>Edit</button>
            </fieldset>
            ";
            break;

        case 3: // Delete
            $id2 = $_GET['lnd_id'];
            $_SESSION['lnd_id'] = $id2;

            echo "
            <h1>Delete lndntary Work?</h1>
            <button type='submit' name='deletelnd-btn'>Yes</button>
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