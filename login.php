<?php
require 'php/func.php';
require 'idry.php';
session_start();

_headerIndex("NEUST PORTAL - LOGIN");
?>


<header></header>
<h1>LOGIN</h1>
<a href="index.php">Go back</a>
<?php 
get_urlmessage();
?>
<form action="php/common.php" method="post" autocomplete="">
  <input type="text" name="user_email" id="" placeholder="Email">
  <input type="password" name="user_pass" id="" placeholder="Password">
  <button type="submit" name="login_btn" value="Login">Login</button>
</form>


<?php _footerIndex(2022); ?>