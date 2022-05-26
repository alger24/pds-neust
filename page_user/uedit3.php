<?php
require '../php/conn.php';
require '../php/func.php';
require 'udry.php';
session_start();

$user_id = $_SESSION['user_id'];
check_id(1, $user_id, $conn);

try {
    $sql = "
    SELECT * FROM `user_main_tbl`
    LEFT JOIN `user_psl_tbl`
    ON `user_main_tbl`.user_id = `user_psl_tbl`.user_id
    LEFT JOIN `user_card_tbl`
    ON `user_main_tbl`.user_id = `user_card_tbl`.user_id
    LEFT JOIN `user_addr_tbl`
    ON `user_main_tbl`.user_id = `user_addr_tbl`.user_id
    WHERE `user_main_tbl`.user_id=:userid
    ";

    $select = $conn->prepare($sql);
    $select->execute([':userid' => $user_id]);
    $rows = $select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$arr1 = array();
foreach ($rows as $data1) {
    $arr1 = $data1;
}

echo "<h1>Edit Personal Information</h1>
        $user_id<br>";
_userheader("Test");
?>
<!-- Style Sheet Link -->
<link rel="stylesheet" href="css/style-user.css">

<br><a href="uindex.php">UWU go back</a>
<form action="uconfig.php?user_id=<?= $user_id ?>" method="get">
    <fieldset>
        <span>III. Educational Background <a href="http://" target="_blank" rel="noopener noreferrer">Edit</a></span>
        <table class="zui-table" width="100%">
            <thead>
                <tr>
                    <th>26. Level</th>
                    <th>Name of School<br>(Write in full)</th>
                    <th>Basic Education/Degree/Course<br>(Write in full)</th>
                    <th colspan="2">Period of Attendance</th>
                    <th>Highest Level/Units Eraned</th>
                    <th>Year Graduated</th>
                    <th>Scholarship/Academic Honors Received</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Elementary
                    </td>
                </tr>
                <tr>
                    <td>
                        Secondary
                    </td>
                </tr>
                <tr>
                    <td>
                        Vocational/Trade Course
                    </td>
                </tr>
                <tr>
                    <td>
                        College
                    </td>
                </tr>
                <tr>
                    <td>
                        Graduate Studies
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="submit" name="uedit1-btn">Test</button>
    </fieldset>
</form>

<?php _userfooter(2022); ?>