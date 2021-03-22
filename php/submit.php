<?php
if(isset($_POST['get_option']))
{
 $host = 'localhost';
 $user = 'root';
 $pass = '';
 mysqli_connect($host, $user, $pass);
 mysqli_select_db('autowebseitedb');

 $state = $_POST['get_option'];
 $find=mysqli_query("select modell from modell where markenname='$markenname'");
 while($row=mysqli_fetch_array($find))
 {
  echo "<option>".$row['modell']."</option>";
 }
 exit;
}
?>