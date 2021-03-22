<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="js/jquery.js"></script>

	    <meta charset="UTF-8">
	    <title>Select Option Dropdown</title>
	    <?php 

		$connection = mysqli_connect('localhost', 'root', '', 'autowebseitedb');

		?>
	</head>
	<body>
		<form action="controllerUserData.php" method="POST" enctype="multipart/form-data">
	 	
	 	<label>Wählen Sie die hochzuladenden Dateien von Ihrem Rechner aus:
	    	<input name="file[]" type="file"  multiple required>
	 	</label>  
	 	<br>
			<div id="content">
				<label>Marke : </label>
				<select id="marke" name="markenname" required>
					<option value="">Marke auswählen</option>
				</select>
				<br><br>
				<label>Modell : </label>
				<select id="modell"  name="modell" required>
					<option value="">Modell auswählen</option>
				</select>

			</div>
			<div>
				<label>Erstzulassung :</label>

				<select name="erstzulassung">
					<!-- geht von 1980 -->
					<option value="" disabled selected>Bitte auswählen</option>
					<option value="2000">2000</option>
					<option value="2001">2001</option>
					<option value="2002">2002</option>
					<option value="2003">2003</option>
					<option value="2004">2004</option>
					<option value="2005">2005</option>
					<option value="2006">2006</option>
					<option value="2007">2007</option>
					<option value="2008">2008</option>
					<option value="2009">2009</option>
					<option value="2010">2010</option>
					<option value="2011">2011</option>
					<option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
				</select>
			</div>

			<div>
				<label>Kilometerstand :</label>
				<input type="number" name="kilometerstand" min="0" required>
			</div>

			<div>
				<label>Leistung :</label>
				<input type="number" name="leistung" min="1" required>
			</div>

			<div>
				<label>Kraftstoff:</label>

				<select name="kraftstoff" required>
					<option disabled selected>Auswählen</option>
					<option value="Benzin">Benzin</option>
					<option value="Diesel">Diesel</option>
					<option value="Elektro">Elektro</option>
					<option value="Wasserstoff">Wasserstoff</option>
					<option value="Autogas">Autogas(LPG)</option>
					<option value="Erdgas">Erdgas(CNG)</option>
					<option value="ElektroBenzin">Elektro/Benzin</option>
				</select>
			</div>
			<div>
				<label>Getriebeart :</label><br>
  				<input type="radio" id="Schaltgetriebe" name="getriebeart" value="Schaltgetriebe" required>
 				<label for="Schaltgetriebe">Schaltgetriebe</label><br>
 				<input type="radio" id="Automatik" name="getriebeart" value="Automatik">
 				<label for="Automatik">Automatik</label><br>
 				<input type="radio" id="Halbautomatik" name="getriebeart" value="Halbautomatik">
  				<label for="Halbautomatik">Halbautomatik</label>
			</div>
			<div>
				<label>Anzahl an Türen :</label><br>
  				<input type="radio" id="3" name="anztueren" value="3" required>
 				<label for="3">2/3</label><br>
 				<input type="radio" id="5" name="anztueren" value="5">
 				<label for="5">4/5</label><br>
 				<input type="radio" id="7" name="anztueren" value="7">
  				<label for="7">6/7</label>
			</div>

			<div>
				<label>Ausstattung : </label>


        		<?php
        		$sql = "SELECT * FROM schreibweise";

				$query = mysqli_query($connection,$sql) or die("Abfrage erfolglos");

				$output = "";
				while ($row = mysqli_fetch_assoc($query)) {
				$schreibweise = $row['schreibweise'];
				$columnname = $row['columnname'];

					$output .= "<label><input type='checkbox' name='".$columnname."' value='clicked'>".$schreibweise."</label>";
				}
				echo $output;
        		?>
			</div>
			<div>
				<label>Farbe : </label>
				<br>
  				<input type="radio" id="beige" name="farbe" value="beige" required>
 				<label for="beige">Beige</label>
 				<input type="radio" id="blau" name="farbe" value="blau">
 				<label for="blau">Blau</label>
 				<input type="radio" id="bronze" name="farbe" value="bronze">
  				<label for="bronze">Bronze</label>
 				<input type="radio" id="gelb" name="farbe" value="gelb">
  				<label for="gelb">Gelb</label>
  				<input type="radio" id="grau" name="farbe" value="grau">
  				<label for="grau">Grau</label>
  				<input type="radio" id="gruen" name="farbe" value="gruen">
  				<label for="gruen">Grün</label>
  				<input type="radio" id="rot" name="farbe" value="rot">
  				<label for="rot">Rot</label><br>
  				<input type="radio" id="schwarz" name="farbe" value="schwarz">
  				<label for="schwarz">Schwarz</label>
  				<input type="radio" id="silber" name="farbe" value="silber">
  				<label for="silber">Silber</label>
  				<input type="radio" id="violett" name="farbe" value="violett">
  				<label for="violett">Violett</label>
  				<input type="radio" id="weiss" name="farbe" value="weiss">
  				<label for="weiss">Weiss</label>
  				<input type="radio" id="orange" name="farbe" value="orange">
  				<label for="orange">Orange</label>
  				<input type="radio" id="gold" name="farbe" value="gold">
  				<label for="gold">Gold</label>
  
			</div>



			<div>
				<label>Preis:</label>
				<input type="number" name="preis" min="1" required>
			</div>

	  		<input type="submit" name="insert" value="INSERT DATA">
	  </form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		function loadData(type, category_id){
			$.ajax({
				url : "load-cs.php",
				type : "POST",
				data: {type : type, id: category_id},
				success : function(data){

					if(type == "modellData"){
						$("#modell").html(data);
					}else{
					$("#marke").append(data);
					}
				}
			});
		}
		
		loadData();

		$("#marke").on("change",function(){
			var marke = $("#marke").val();


				loadData("modellData", marke);

		})
	});

</script>
</body>
</html>



