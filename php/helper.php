<?php

$conn= mysqli_connect("localhost", "root", "","autowebseitedb");
if (!$conn) {
	exit("Sorry, Connection error..");
}

$val= $_GET["value"];

$val_M = mysqli_real_escape_string($conn, $val);

$sql="SELECT markenId, modellbezeichnung FROM modelle WHERE markenId='$val_M'";
$result= mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0) {

	echo "<select>";

	while ($rows= mysqli_fetch_assoc($result)) {
		
		echo "<option>".$rows["modellbezeichnung"]."</option>";
	}

	echo "</select>";
	
} else {
	echo "<select>
			<option>Modell</option>
		</select>";
}




?>