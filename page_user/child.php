<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];

_userheader("Child Page");
?>

<br><a href="uedit2.php">Go back</a>
<form action='uconfig.php' method='get'>
    <?php
    $option = $_GET['page_option'];
    switch ($option) {
        case 1:
            echo "
            <h1>Add Child</h1>
            <fieldset>
                <input type='text' name='uchild[child_user_name]' id='' placeholder='Child Full Name' required>
                <input type='date' name='uchild[child_user_bdate]' id='' required>
                <button type='submit' name='addChild-btn'>Add</button>
            </fieldset>
            ";
            break;

        case 2:
            $id2 = $_GET['child_id'];
            $_SESSION['child_id'] = $id2;
            $stmt = userSelect($conn, "user_child_tbl", $uid, $id2, "child_id");
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo "
            <h1>Edit Child</h1>
            <fieldset>
                <input type='text' name='uchild[child_user_name]' id='' value='" . $data['child_user_name'] . "' required>
                <input type='date' name='uchild[child_user_bdate]' id='' value='" . $data['child_user_bdate'] . "' required>
                <button type='submit' name='editChild-btn'>Test</button>
            </fieldset>
            ";
            break;

        case 3:
            $id2 = $_GET['child_id'];
            $_SESSION['child_id'] = $id2;
            
            echo "
            <h1>Delete Child</h1>
            <button type='submit' name='deleteChild-btn'>Yes</button>
            <a href='uedit2.php'>No</a> 
            ";
            break;

        default:
            echo "error";
            break;
    }
    ?>
</form>



<?php _userfooter(2022) ?>