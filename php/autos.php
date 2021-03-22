<?php
	
$_db_host = "localhost";
$_db_username = "root";
$_db_passwort = "";
$_db_datenbank = "autowebseitedb";

 $_link = mysqli_connect($_db_host, $_db_username, $_db_passwort,$_db_datenbank);

 if (!$_link)
        {
        # Nein, also das ganze Skript abbrechen !
        die("Keine Verbindung zur Datenbank möglich: " .
            mysql_error());
        }

   echo "Verbindung zur Datenbank erfolgreich.<br>";

   mysqli_select_db( $_link,"autowebseitedb");

 /*  $sql= "
   SELECT 
   		modellId,preis,markenId,erstzulassung
   FROM
   		autos
   WHERE
   		markenId LIKE ''
   ";

   $query = mysqli_query($_link,$sql);

   echo "<ul>";
   WHILE($row = mysqli_fetch_assoc($query))
   {
   	$marke = $row['markenId'];
   	$modell = $row['modellId'];
   	$erstzulassungen = $row['erstzulassung'];
   	$preise = $row['preis'];
   }
   echo "<ul>";
  */
  $_resultat = mysqli_query($_link," SELECT * FROM autos ");

  //$_daten = mysqli_fetch_array($_resultat, MYSQLI_ASSOC);

  // print_r($_daten);
  
  while($_daten = mysqli_fetch_assoc($_resultat)){

  echo "<pre>";

  print_r($_daten);
  echo "<pre>";
 
 }
 mysqli_result($_resultat);

 mysqli_close($_link);

?>