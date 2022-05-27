<?php
require 'conn.php';

function _headerIndex($title)
{
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='UTF-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>$title</title>
      <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    </head>
    <body>
    ";
}

function _footerIndex($date)
{
    echo "
    <footer>Copyright &copy; $date</footer>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
    </body>
    </html>
    ";
}

function get_urlmessage()
{
    if (isset($_GET['error'])) {
        $url_msg = $_GET['error'];
        echo "<span style='color: red'>$url_msg</span>";
    } else if (isset($_GET['success'])) {
        $url_smg = $_GET['success'];
        echo "<span style='color: green'>$url_smg</span>";
    } else {
        unset($url_msg);
    }
}

function check_id($role, $id, $conn) {
    switch($role) {
        case 1 :
            try {
                $select = $conn->prepare("SELECT * FROM `user_main_tbl` WHERE `user_id` = ?");
                $select->execute([$id]);
                $result = $select->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
            } finally {
                if (!$result) {
                    die(header("location: ../index.php?error=Warning your trying to access a restricted page!"));
                }
            }
        break;

        case 2 :
            // try {
            //     $select = $conn->prepare("SELECT * FROM `admin_tbl` WHERE `admin_id` = ?");
            //     $select->execute([$id]);
            //     $result = $select->fetch();
            // } catch (PDOException $e) {
            //     echo $e->getMessage();
            // } finally {
            //     if (!$result) {
            //         die(header("location: ../index.php?error=Warning your trying to access a restricted page!"));
            //     }
            // }
        break;

        default :
            echo "Error</br><a href='../index.php'>Go Back</a>";
            // die(header("location: ../index.php"));
    }
}

// WARNING PROTOTYPE/DEPRICATED SECTION

// function multi_insert($uid)
// {
//     require 'conn.php';
//     try {
//         $data = []; //an array
//         $conn->beginTransaction();
//         $insert = $conn->prepare("INSERT INTO `table` (`col`, `col2`, `col3`) VALUES (?,?,?)");
//         for ($i = 0; $i < count($data); $i++) {
//             $insert->execute($data[$i]);
//         }
//         $conn->commit();
//         while($i!=count($table)){
//             $table = ['user_card_tbl', 'user_educbg'];
//             $insert = $conn->prepare("INSERT INTO `$table` (`user_id`) VALUES ('$uid')");      
//             $i++;
//         }
//     } catch (PDOException $e) {
//         echo "<strong>" . $e->getMessage() . "</strong>";
//     } finally {
//         $conn = NULL;
//     }
// }

// function clean_data($data)
// {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }