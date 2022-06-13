<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];

_userheader("Civil Service Elegibility Page");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
    <?php
    $option = $_GET['page_option'];
    switch ($option) {
        case 1: // Add
            echo "
            <h1>Add Civil Service Elegibility</h1>
            <fieldset>
                <table>
                    <thead>
                        <tr>
                            <th>CAREER SERVICE/RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE BARANGAY ELIGIBILITY/DRIVERS LICENSE</th>
                            <th>RATING (if applicable) </th>
                            <th>DATE EXAMINATION/CONFERMENT</th>
                            <th>PLACE OF EXAMINATION/CONFERMENT</th>
                            <th colspan='2'>LICENSE (if applicable)<br>
                                NUMBER | VALIDITY</th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='text' name='ucivil[civil_user_info]' id='' required></td>
                            <td><input type='text' name='ucivil[civil_user_rate]' id=''></td>
                            <td><input type='date' name='ucivil[civil_user_exam]' id=''></td>
                            <td><input type='text' name='ucivil[civil_user_addr]' id='' ></td>
                            <td><input type='text' name='ucivil[civil_user_lcnnum]' id=''></td>
                            <td><input type='date' name='ucivil[civil_user_lcndate]' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='addCivil-btn'>Add</button>
            </fieldset>
            ";
            break;

        case 2: // Edit
            $id2 = $_GET['civil_id'];
            $_SESSION['civil_id'] = $id2;
            $stmt = userSelect($conn, "user_civil_tbl", $uid, $id2, "civil_id");
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "
            <h1>Edit Civil Service Elegibility</h1>
            <fieldset>
                <table>
                    <thead>
                        <tr>
                            <th>CAREER SERVICE/RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE BARANGAY ELIGIBILITY/DRIVERS LICENSE</th>
                            <th>RATING (if applicable) </th>
                            <th>DATE EXAMINATION/CONFERMENT</th>
                            <th>PLACE OF EXAMINATION/CONFERMENT</th>
                            <th colspan='2'>LICENSE (if applicable)<br>
                                NUMBER | VALIDITY</th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='text' name='ucivil[civil_user_info]' id='' value='" . $data['civil_user_info'] . "' required></td>
                            <td><input type='text' name='ucivil[civil_user_rate]' id='' value='" . $data['civil_user_rate'] . "'></td>
                            <td><input type='date' name='ucivil[civil_user_exam]' id='' value='" . $data['civil_user_exam'] . "'></td>
                            <td><input type='text' name='ucivil[civil_user_addr]' id='' value='" . $data['civil_user_addr'] . "'></td>
                            <td><input type='text' name='ucivil[civil_user_lcnnum]' id='' value='" . $data['civil_user_lcnnum'] . "'></td>
                            <td><input type='date' name='ucivil[civil_user_lcndate]' id='' value='" . $data['civil_user_lcndate'] . "'></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='editCivil-btn'>Add</button>
            </fieldset>
            ";
            break;

        case 3: // Delete
            $id2 = $_GET['civil_id'];
            $_SESSION['civil_id'] = $id2;

            echo "
            <h1>Delete Civil Service Elegibility</h1>
            <button type='submit' name='deleteCivil-btn'>Yes</button>
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