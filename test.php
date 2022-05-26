<?php
require 'php/conn.php';
require 'php/func.php';
session_start();



_headerIndex("Test");
?>
<br><br>
<form action="page_user/uconfig.php" method="get">
    <input type="text" name="test1[test_fname]" id="" placeholder="Firstname">
    <input type="text" name="test1[test_mname]" id="" placeholder="Middlename">
    <input type="text" name="test1[test_sname]" id="" placeholder="Surname">
    <br>
    <input type="date" name="test2[test_bdate]" id="">
    <input type="text" name="test2[test_pnum]" id="" placeholder="Phone Number">
    <input type="email" name="test2[test_email]" id="" placeholder="Email">
    <button type="submit" name="test-btn">TEST</button>
</form>

<br><br>
<?php _footerIndex(2022); ?>