    <?php 
    session_start();
    require "connection.php";
    $email = "";
    $name = "";
    $errors = array();

    //if user signup button
    if(isset($_POST['signup'])){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Passwörter stimmen nict überein!";
        }
        $email_check = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $email_check);
        if(mysqli_num_rows($res) > 0){
            $errors['email'] = "Die von Ihnen eingegebene E-Mail ist bereits vorhanden!";
        }
        if(count($errors) === 0){
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "notverified";
            $insert_data = "INSERT INTO users (name, email, password, code, status)
                            values('$name', '$email', '$encpass', '$code', '$status')";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check){
                $subject = "Email Verifikationscode";
                $message = "Ihr Verifizierungscode ist $code";
                $sender = "Von: kfzscout1@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "Wir haben Ihnen eine Verifizierungsmail an $email gesendet";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: user-otp.php');
                    exit();
                }else{
                $errors['db-error'] = "Fehler beim Code!";

            }
        }else{
                $errors['db-error'] = "Fehler beim Einfügen der Daten in die Datenbank!";
            }
        }

    }
        //if user click verification code submit button
        if(isset($_POST['check'])){
            $_SESSION['info'] = "";
            $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
            $check_code = "SELECT * FROM users WHERE code = $otp_code";
            $code_res = mysqli_query($con, $check_code);
            if(mysqli_num_rows($code_res) > 0){
                $fetch_data = mysqli_fetch_assoc($code_res);
                $fetch_code = $fetch_data['code'];
                $email = $fetch_data['email'];
                $code = 0;
                $status = 'verified';
                $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
                $update_res = mysqli_query($con, $update_otp);
                if($update_res){
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    header('location: home.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Fehler beim Aktualisieren des Codes!";
                }
            }else{
                $errors['otp-error'] = "Sie haben einen falschen Code eingegeben!";
            }
        }

        //if user click login button
        if(isset($_POST['login'])){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $check_email = "SELECT * FROM users WHERE email = '$email'";
            $res = mysqli_query($con, $check_email);
            if(mysqli_num_rows($res) > 0){
                $fetch = mysqli_fetch_assoc($res);
                $fetch_pass = $fetch['password'];
                if(password_verify($password, $fetch_pass)){
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $status = $fetch['status'];
                    if($status == 'verified'){
                      $_SESSION['email'] = $email;
                        header('location: home.php');
                    }else{
                        $info = "Es sieht so aus, als hätten Sie Ihre E-Mail-Adresse noch nicht verifiziert - $email";
                        $_SESSION['info'] = $info;
                        header('location: user-otp.php');
                    }
                }else{
                    $errors['email'] = "Falsche Email oder Passwort!";
                }
            }else{
                $errors['email'] = "Es sieht so aus, als wären Sie noch kein Mitglied! Klicken Sie auf den unteren Link, um sich anzumelden";
            }
        }

        //if user click continue button in forgot password form
        if(isset($_POST['check-email'])){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $check_email = "SELECT * FROM users WHERE email='$email'";
            $run_sql = mysqli_query($con, $check_email);
            if(mysqli_num_rows($run_sql) > 0){
                $code = rand(999999, 111111);
                $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
                $run_query =  mysqli_query($con, $insert_code);
                if($run_query){
                    $subject = "Passwort zurücksetzen";
                    $message = "Ihr Code zum Zurücksetzen des Passworts lautet $code";
                    $sender = "Von: kfzscout1@gmail.com";
                    if(mail($email, $subject, $message, $sender)){
                        $info = "Sie haben eine Email von uns bekommen $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        header('location: reset-code.php');
                        exit();
                    }else{
                        $errors['otp-error'] = "Fehler werden dem Senden des Codes!";
                    }
                }else{
                    $errors['db-error'] = "Etwas ist schiefgegangen!";
                }
            }else{
                $errors['email'] = "Diese E-Mail-Adresse existiert nicht!";
            }
        }

        //if user click check reset otp button
        if(isset($_POST['check-reset-otp'])){
            $_SESSION['info'] = "";
            $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
            $check_code = "SELECT * FROM users WHERE code = $otp_code";
            $code_res = mysqli_query($con, $check_code);
            if(mysqli_num_rows($code_res) > 0){
                $fetch_data = mysqli_fetch_assoc($code_res);
                $email = $fetch_data['email'];
                $_SESSION['email'] = $email;
                $info = "Bitte erstellen Sie ein neues Passwort, dass Sie auf keiner anderen Seite verwenden.";
                $_SESSION['info'] = $info;
                header('location: new-password.php');
                exit();
            }else{
                $errors['otp-error'] = "Sie haben einen falschen Code eingegeben!";
            }
        }

        //if user click change password button
        if(isset($_POST['change-password'])){
            $_SESSION['info'] = "";
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
            if($password !== $cpassword){
                $errors['password'] = "Passwort stimmt nicht überein!";
            }else{
                $code = 0;
                $email = $_SESSION['email']; //getting this email using session
                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
                $run_query = mysqli_query($con, $update_pass);
                if($run_query){
                    $info = "Ihr Passwort wurde geändert. Jetzt können Sie sich mit Ihrem neuen Passwort anmelden.";
                    $_SESSION['info'] = $info;
                    header('Location: password-changed.php');
                }else{
                    $errors['db-error'] = "Fehler beim Ändern Ihres Passworts!";
                }
            }
        }
        
       //if login now button click
        if(isset($_POST['login-now'])){
            header('Location: login-user.php');
        }

        //if user click insert 
        if(isset($_POST['insert'])){

           $select = "SELECT columnname from schreibweise";           
                $query = mysqli_query($con,$select) or die("Abfrage erfolglos");

        $columns = "";
        $values = "";
        while ($row = mysqli_fetch_assoc($query)) {

            $columnname = $row['columnname'];
            $columnname = trim($columnname);
            $temp = 0;

            if($columns == ""){
                $columns .= $columnname;
            }else{
                $columns .= ','.$columnname;
            }

            if(isset ($_POST[$columnname])) {
                $temp = 1;

            }
            if($values == ""){
                $values .= $temp;
            }else{
                $values .= ','.$temp;
            }
        }
      

            $countfiles = count($_FILES['file']['name']);

            $markenname = mysqli_real_escape_string($con, $_REQUEST['markenname']);
            $modell = mysqli_real_escape_string($con, $_REQUEST['modell']);
            $erstzulassung = mysqli_real_escape_string($con, $_REQUEST['erstzulassung']);
            $kilometerstand = mysqli_real_escape_string($con, $_REQUEST['kilometerstand']);
            $leistung = mysqli_real_escape_string($con, $_REQUEST['leistung']);
            $kraftstoff = mysqli_real_escape_string($con, $_REQUEST['kraftstoff']);
            $preis = mysqli_real_escape_string($con, $_REQUEST['preis']);
            $getriebeart = mysqli_real_escape_string($con, $_REQUEST['getriebeart']);
            $anztueren = mysqli_real_escape_string($con, $_REQUEST['anztueren']);
            $farbe = mysqli_real_escape_string($con, $_REQUEST['farbe']);

            $dirname = uniqid();
            mkdir("uploads/$dirname");

            for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['file']['name'][$i];

            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i],"uploads/$dirname/".$filename);
            }

            $insert = "INSERT INTO auto (imageurl, markenname, modell, erstzulassung, kilometerstand, leistung, kraftstoff, getriebeart, anztueren, farbe, preis) VALUES ('$dirname', '$markenname', '$modell', '$erstzulassung', '$kilometerstand', '$leistung', '$kraftstoff', '$getriebeart', '$anztueren', '$farbe', '$preis')";
            mysqli_query($con,$insert);


            $autoId = mysqli_insert_id($con);

            $sql = "INSERT INTO ausstattung (autoId, $columns) VALUES ($autoId, $values)";
            mysqli_query($con, $sql);
      
    }     
        else {
                echo "Diesen Dateityp kann man nicht hochladen";
                    
                }




 ?>