<?php
require '../php/func.php';
// require '../php/conn.php';
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "test";

// Check connection
try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


if(isset($_GET['test-btn'])){
    $array1 = $_GET['test1'];
    $array2 = $_GET['test2'];

    $keys = array_keys($array1);
    $vals = array_values($array1);
    
    print_r($keys);
    print_r($vals);
    echo "<a href='../test.php'>Go back</a>";

    foreach($array1 as $key => $value){
        // echo "$key (key) = $value (value)<br>";
    }
    // try {
    //     $sql = "
    //     INSERT INTO `test_tbl` (`user_id`, `main_user_email`, `main_user_pass`, `main_created`) VALUES (:userid, :main_user_email, :main_user_pass, NOW());
    //     ";

    //     $insert = $conn->prepare($sql);
    //     $insert->execute([
    //     ]);
    // } catch (PDOException $e) {
    //     echo "<br>" . $e->getMessage();
    // } finally {
    //     $conn = NULL;
    // }

    // // Disable redirect if record user doesn't appear on the database
    // header("Location: ../index.php?success=You're registered! YAY!");
}

if(isset($_GET['uedit1-btn'])){
    $newarr = array_splice($_GET, 0, null, true);
    print_r($newarr);


    foreach($_GET as $key => $value) {
        
    }
}

