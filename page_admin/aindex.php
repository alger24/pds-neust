<?php
require '../php/func.php';
require 'adry.php';
session_start();

_headerDefaultAdmin("ADMIN - LOGIN");
?>


<header></header>
<h1>ADMIN - LOGIN</h1>
<a href="../index.php">Go back</a>
<?php
get_urlmessage();
?>
<form action="../php/common.php" method="post" autocomplete="off">
  <input type="text" name="admin_name" id="" placeholder="Name">
  <input type="password" name="admin_pass" id="" placeholder="Password">
  <button type="submit" name="login_admin_btn" value="Login">Login</button>
</form>


<?php _footerDefaultAdmin(2022); ?>