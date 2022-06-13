<?php
require 'php/func.php';
require 'idry.php';
session_start();

_headerIndex("NUEST PORTAL - REGISTER");
?>


<header></header>

<h1>REGISTER</h1>
<a href="index.php">Go back</a>
<?php 
get_urlmessage();
?>
<form action="php/common.php" method="POST" autocomplete="off">
  <input type="text" name="psl[psl_user_fname]" id="" placeholder="First name" maxlength="12" required>
  <input type="text" name="psl[psl_user_mname]" id="" placeholder="Middle name" maxlength="12" required>
  <input type="text" name="psl[psl_user_sname]" id="" placeholder="Sur name" maxlength="12" required><br>
  <input type="text" name="addr[addr_user_brgy]" id="" placeholder="Barangay" maxlength="" required>
  <input type="text" name="addr[addr_user_city]" id="" placeholder="City" maxlength="" required>
  <input type="text" name="addr[addr_user_prov]" id="" placeholder="Province" maxlength="" required><br>
  <input type="date" name="psl[psl_user_bdate]" id="" required>
  <input type="email" name="main[main_user_email]" id="" placeholder="Email" maxlength="50" required>
  <input type="password" name="main[main_user_pass]" id="" placeholder="Password" maxlength="24" required><br>
  <button type="submit" name="register_btn" value="Register">Register</button>
</form>


<?php _footerIndex(2022); ?>