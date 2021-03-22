<?php 

	$conn = mysqli_connect("localhost", "root", "", "autowebseitedb") or die("Verbindung fehlgeschlagen");

	if($_POST['type'] == ""){
		$sql = "SELECT * FROM marken";

		$query = mysqli_query($conn,$sql) or die("Abfrage erfolglos");

		$str = "";
		while ($row = mysqli_fetch_assoc($query)) {
			$str .= "<option value='{$row['markenId']}'>{$row['markenname']}</option>";
		}
	}else if($_POST['type'] == "modellData"){

		$sql = "SELECT * FROM modelle WHERE marken = {$_POST['id']}";

		$query = mysqli_query($conn,$sql) or die("Abfrage erfolglos");

		$str = "";
		while ($row = mysqli_fetch_assoc($query)) {
			$str .= "<option value='{$row['modellId']}'>{$row['modell']}</option>";
		}
	}

	echo $str;
?>