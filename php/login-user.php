<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Anmelden</title>
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Anmelden</h2>
                    <p class="text-center">mit Ihrer Email und Passwort</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email-Addresse" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Passwort" required>
                    </div>
                    <div class="link forget-pass text-left">
                       <a href="forgot-password.php">Passwort vergessen</a>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Anmelden">
                    </div>
                    <div class="link login-link text-center">Noch nicht registriert? 
                     <a href="signup-user.php">Registrieren</a>
                  </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
