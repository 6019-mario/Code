<?php

session_start();
session_destroy();

echo 'Sie wurden erfolgreich abgemeldet';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>  <?php echo $name ?>| Home</title>
   
</head>
<body>
    <nav class="navbar">
    <a class="navbar-brand" href="home.php">KfzScout</a>
    <button type="button" class="btn btn-light">

      <a href="login-user.php">Anmelden</a>
      </button>
    </nav>
   	<?php 
   	header('Location: login-user.php');
   	?>
</body>
</html>
