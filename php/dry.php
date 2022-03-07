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
?>