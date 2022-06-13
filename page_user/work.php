<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];

_userheader("Work Experience Page");
?>

<br><a href="pds-view.php">Go back</a>
<form action='uconfig.php' method='get'>
    <?php
    $option = $_GET['page_option'];
    switch ($option) {
        case 1: // Add
            echo "
            <h1>Add Work Experience</h1>
            <fieldset>
                <table>
                    <thead>
                        <tr>
                            <th scope='col' colspan='2'>28. INCLUSSIVE DATES(mm/dd/yyyy)<br>
                                FROM | TO</th>
                            <th scope='col'> POSITION TITLE<br>
                                (Write in full/Do not abbrevriate)</th>
                            <th scope='col'>DEPARTMENT/AGENCY/OFFICE/COMPANY<br>
                                (Write in full/Do not abbrevriate)</th>
                            <th scope='col'> MONTHLY SALARY</th>
                            <th scope='col'>SALARY/JOB/PAY GRADE
                                (if applicable)&STEP(format'00-0')<br>
                                /INCREMENT</th>
                            <th scope='col'>STATUS OF<br>
                                APPOINTMENT</th>
                            <th scope='col'>GOV'T SERVICE<br>
                                (Y/N)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='date' name='uwork[work_user_from]' id=''></td>
                            <td><input type='date' name='uwork[work_user_to]' id=''></td>
                            <td><input type='text' name='uwork[work_user_title]' id=''></td>
                            <td><input type='text' name='uwork[work_user_depart]' id=''></td>
                            <td><input type='text' name='uwork[work_user_sal]' id=''></td>
                            <td><input type='text' name='uwork[work_user_salgrad]' id=''></td>
                            <td><input type='text' name='uwork[work_user_status]' id=''></td>
                            <td><input type='text' name='uwork[work_user_gov]' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='addWork-btn'>Add</button>
            </fieldset>
            ";
            break;

        case 2: // Edit
            $id2 = $_GET['work_id'];
            $_SESSION['work_id'] = $id2;
            $stmt = userSelect($conn, "user_work_tbl", $uid, $id2, "work_id");
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "
            <h1>Edit Work Experience</h1>
            <fieldset>
                <table>
                        <thead>
                        <tr>
                            <th scope='col' colspan='2'>28. INCLUSSIVE DATES(mm/dd/yyyy)<br>
                                FROM | TO</th>
                            <th scope='col'> POSITION TITLE<br>
                                (Write in full/Do not abbrevriate)</th>
                            <th scope='col'>DEPARTMENT/AGENCY/OFFICE/COMPANY<br>
                                (Write in full/Do not abbrevriate)</th>
                            <th scope='col'> MONTHLY SALARY</th>
                            <th scope='col'>SALARY/JOB/PAY GRADE
                                (if applicable)&STEP(format'00-0')<br>
                                /INCREMENT</th>
                            <th scope='col'>STATUS OF<br>
                                APPOINTMENT</th>
                            <th scope='col'>GOV'T SERVICE<br>
                                (Y/N)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='date' name='uwork[work_user_from]' value='" . $data['work_user_from'] . "' id=''></td>
                            <td><input type='date' name='uwork[work_user_to]' value='" . $data['work_user_to'] . "' id=''></td>
                            <td><input type='text' name='uwork[work_user_title]' value='" . $data['work_user_title'] . "' id=''></td>
                            <td><input type='text' name='uwork[work_user_depart]' value='" . $data['work_user_depart'] . "' id=''></td>
                            <td><input type='text' name='uwork[work_user_sal]' value='" . $data['work_user_sal'] . "' id=''></td>
                            <td><input type='text' name='uwork[work_user_salgrad]' value='" . $data['work_user_salgrad'] . "' id=''></td>
                            <td><input type='text' name='uwork[work_user_status]' value='" . $data['work_user_status'] . "' id=''></td>
                            <td><input type='text' name='uwork[work_user_gov]' value='" . $data['work_user_gov'] . "' id=''></td>
                        </tr>
                    </tbody>
                </table>
                <button type='submit' name='editWork-btn'>Edit</button>
            </fieldset>
            ";
            break;

        case 3: // Delete
            $id2 = $_GET['work_id'];
            $_SESSION['work_id'] = $id2;

            echo "
            <h1>Delete Work Experience?</h1>
            <button type='submit' name='deleteWork-btn'>Yes</button>
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