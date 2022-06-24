<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
    require 'uconfig.php';
    $uid = $_SESSION['user_id'];
    $_SESSION['user_id'] = $uid;
    
    $getImg = userSelect($conn, "user_otherimg_tbl", $uid, null, null);
    $img = $getImg->fetch(PDO::FETCH_ASSOC);
?>
<body>
    <form action="uconfig.php" method="post" enctype="multipart/form-data">
        <?php 
            if(!empty($img['otherimg_path_1'])) {
                echo "
                <img src='". $img['otherimg_path_1'] ."' alt='otherimg_path_1' width='10%' height='10%'>
                <br>
                <a href='uconfig.php?del-img=1'>Delete User ID</a>
                <br>
                ";
            } else {
                echo "ID: <input type='file' name='otherimg_path_1' multiple id=''><br>";
            }
        ?> 
        Signiture: <input type="file" name="otherimg_path_2" multiple id=""><br>
        Thumbmark: <input type="file" name="otherimg_path_3" multiple id=""><br>
        Signiture Oath: <input type="file" name="otherimg_path_4" multiple id=""><br>
        <img src="" alt="">
        <button type="submit" name="upload-img">Upload</button>
    </form>

    <br><br>

    <form action="uconfig.php" method="get" enctype="multipart/form-data">
        <input type="text" name="img_num" id="">

        <button type="submit" name="delete-img">Delete</button>
    </form>

    <a href="uconfig.php?img_num=2">Delete Test</a>
</body>
</html>