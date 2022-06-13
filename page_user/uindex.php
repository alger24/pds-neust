<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];
check_id($conn, $uid, "user");

get_urlmessage();

echo "<h1>HOME</h1>
        $uid<br>";
_userheader("Home");
?>


<?php _userfooter(2022) ?>