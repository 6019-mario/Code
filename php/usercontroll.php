<?php 
session_start();
require "helper.php";

if(isset($_POST['signup'])){
    $markenname = mysqli_real_escape_string($con, $_POST['markenname']);
}
?>