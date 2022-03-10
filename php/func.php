<?php
function _header($title) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='UTF-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>$title</title>
    </head>
    <body>
    ";
}

function _footer($date) {
    echo "
    <footer>Copyright &copy; $date</footer>
    </body>
    </html>
    ";
}

function clean_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function check_msg($msg)
{
    switch ($msg) {
        case 1:
            return $msg = "<br><span style='color: red;'>Oops, looks like your trying to access a restricted page!</span>";
            break;
        case 2:
            return $msg = "<br><span style='color: green;'>You're now registered! YAY!</span>";
            break;
        case 3:
            return $msg = "<br><span style='color: red;'>Wrong email or password.</span>";
            break;
        default:
            session_unset();
            break;
    }
}
