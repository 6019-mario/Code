<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <title><?php echo $fetch_info['name'] ?> | KfzScout</title>
    <script>
        function marke_modell(str) {

             if (window.XMLHttpRequest) {
              xmlhttp = new XMLHttpRequest();
             } else{
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                }

             xmlhttp.onreadystatechange= function(){
               if (this.readyState==4 && this.status==200) {
                 document.getElementById('poll').innerHTML = this.responseText;
                 }
            }
            xmlhttp.open("GET","helper.php?value="+str, true);
            xmlhttp.send();

}

</script>
</head>
<body>
    <nav class="navbar">
    <a class="navbar-brand" href="#">KfzScout</a>
    <button type="button" class="btn btn-light">
      <a href="logout-user.php">Abmelden</a>
      </button>
    </nav>
    <h2>Willkommen <?php echo $fetch_info['name'] ?></h2>


    <div>
        <button type="button" class="btn btn-light"><a href="new-advertisement.php">Neues Auto inserieren</a></button>
    </div>
    <div style="margin: auto; width: 300px;">

    <select id="SelectA" onchange="marke_modell(this.value);">
        <option>Marke</option>
            <option value="Volkswagen">Volkswagen</option>
            <option value="Bmw">BMW</option>
            <option value="Audi">Audi</option>
            <option value="Mercedes-Benz">Mercedes-Benz</option>
            <option value="Skoda">Skoda</option>
            <option value="Ford">Ford</option>
            <option value="Abarth">Abarth</option>      
            <option value="Alfa Romeo">Alfa Romeo</option>
            <option value="Aston Martin">Aston Martin</option>
            <option value="Bentley">Bentley</option>
            <option value="Bugatti">Bugattti</option>
            <option value="Cadillac">Cadillac</option>
            <option value="Chevrolet">Chevrolet</option>
            <option value="Citroen">Citroen</option>
            <option value="Cupra">Cupra</option>
            <option value="Dacia">Dacia</option>
            <option value="DSAutomobiles">DS Automobiles</option>
            <option value="eGoMobile">e.Go Mobile</option>
            <option value="Ferrari">Ferrari</option>
            <option value="Fiat">Fiat</option>
            <option value="Honda">Honda</option>
            <option value="Hyundai">Hyundai</option>
            <option value="Isuzu">Isuzu</option>
            <option value="Jaguar">Jaguar</option>
            <option value="Jeep">Jeep</option>
            <option value="Kia">Kia</option>
            <option value="Koenigsegg">Königsegg</option>
            <option value="Lada">Lada</option>
            <option value="Lamborghini">Lamborghini</option>
            <option value="Land Rover">Land Rover</option>
            <option value="Lexus">Lexus</option>
            <option value="Lotus">Lotus</option>
            <option value="Maserati">Maserati</option>
            <option value="Mazda">Mazda</option>
            <option value="McLaren">McLaren</option>
    </select>

    <br><br><br><br>

    <div id="poll">
        <select>
            <option>Modell</option>
        </select>
    </div>
   <div class="form-group">
        <input class="form-control button" type="submit" name="search" value="Suchen">
    </div>
</body>
</html>
