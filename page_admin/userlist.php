<?php
require '../php/func.php';
require '../php/conn.php';
require 'adry.php';
session_start();

$admin_id = $_SESSION['admin_id'];
check_id(2, $admin_id, $conn);
get_urlmessage();

// BackEnd Code Here!
try {
    $sql = "
    SELECT * FROM `user_main_tbl`
    LEFT JOIN `user_psl_tbl`
    ON `user_main_tbl`.user_id = `user_psl_tbl`.user_id
    ";

    $select = $conn->prepare($sql);
    $select->execute([]);
    $rows = $select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

echo "</br>$admin_id";
_headerAdmin("User List");
?>


<h1>User List</h1>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Unique ID</th>
            <th>Name</th>
            <th colspan="4">Options</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($rows) {
            foreach ($rows as $data1) {
                $arr1 = array();
                $arr1 = $data1;
                $user_id = $arr1["user_id"];
                $i =+ 1;
                echo    "<tr>" .
                        "<td>" . $i . "</td>" .
                        "<td>" . $user_id . "</td>" .
                        "<td>" . $arr1['psl_user_fname'] . " " . substr($arr1['psl_user_mname'], 0, 1). "." . "</td>" .
                        "<td><a href='#?user_id=$user_id'>Edit</a></td>" .
                        "<td><a href='#?user_id=$user_id'>Print</a></td>" .
                        "<td><a href='#?user_id=$user_id'>Delete</a></td>" .
                        "<td><a href='#?user_id=$user_id'>Verify</a></td>" .
                        "</tr>";
            }
        } else {
            echo "The table is empty!";
        }
        ?>
    </tbody>
</table>



<br><br>
<?php _footerAdmin(2022) ?>