<!DOCTYPE html>
<html>

<?php
		$conn= mysqli_connect("localhost", "root", "","autowebseitedb");
if (!$conn) {
    exit("Sorry, Connection error..");
}
	?>

<head>
	<meta charset="utf-8">
	<title>Autowebseite für An- und Verkauf von KFZs</title>
</head>
<body>
	<?php
	/*
	$sql = "SELECT * FROM auto";

	$query = mysqli_query($conn,$sql) or die("Abfrage erfolglos");

	$output = "";
	while ($row = mysqli_fetch_assoc($query)) {

	$markenname = $row['markenname'];
	$modell = $row['modell'];

		$output .= "<option name='".$modell."' value='clicked'>".$markenname."</option>";
	}
	echo $output;
	*/

	$_resultat = mysqli_query($conn," SELECT * FROM auto ");

  //$_daten = mysqli_fetch_array($_resultat, MYSQLI_ASSOC);

  // print_r($_daten);
  

  while($_daten = mysqli_fetch_assoc($_resultat)){

  echo "<pre>";
  print_r($_daten);
  echo "<pre>";
 
 }
	?>
</body>
</html>
