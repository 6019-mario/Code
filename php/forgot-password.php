<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Passwort vergessen</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Passwort vergessen</h2>
                    <p class="text-center">Geben Sie Ihre Email ein</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email-Addresse eingeben" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Passwort zurücksetzen">
                    </div>
                    <p><a href="home.php">Zurück zur Webseite</p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
