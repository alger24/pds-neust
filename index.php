<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="css/style-index.css" rel="Stylesheet" type="text/css">
</head>
<body>

<?php
require 'php/func.php';
session_start();

_headerIndex("NEUST PORTAL - HOME");
?>

<main>
<div class="portal">
  <h1 class="text-gradient">NEUST PORTAL</h1>
  <?php
  get_urlmessage();
  ?>
  <ul>
    <li>
      <a class="btn btn-primary" href="register.php">REGISTER</a>
    </li>
    <li>
      <a class="btn btn-primary" href="login.php">LOGIN</a>
    </li>
    <li>
      <a class="btn btn-primary" href="contact.php">CONTACT US</a>
    </li>
  </ul>
</div>
</main>

<div class="footer">
<?php _footerIndex(2022); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>