<?php
require 'php/conn.php';
require 'php/func.php';
require 'idry.php';
session_start();

// Ignore this..
// ALTER TABLE `user_collbg_tbl` ADD `collbg_id` VARCHAR(11) NULL AFTER `user_id`, ADD `collbg_user_name` VARCHAR(24) NULL AFTER `collbg_id`, ADD `collbg_user_degre` VARCHAR(24) NULL AFTER `collbg_user_name`, ADD `collbg_user_pfrom` DATE NULL AFTER `collbg_user_degre`, ADD `collbg_user_pto` DATE NULL AFTER `collbg_user_pfrom`, ADD `collbg_user_earn` VARCHAR(24) NULL AFTER `collbg_user_pto`, ADD `collbg_user_grad` DATE NULL AFTER `collbg_user_earn`, ADD `collbg_user_reci` VARCHAR(24) NULL AFTER `collbg_user_grad`;



_headerIndex("Test");
?>

<?= $elembg_id = "elem".bin2hex(random_bytes(7));?>


<?php _footerIndex(2022); ?>