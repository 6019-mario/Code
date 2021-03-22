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
		<form>

			<div id="content">
				<label>Marke : </label>
				<select id="marke" name="markenname">
					<option value="">Marke auswählen</option>
				</select>
				<br><br>
				<label>Modell : </label>
				<select id="modell"  name="modell">
					<option value="">Modell auswählen</option>
				</select>

			</div>

			<div>
				<label>Erstzulassung :</label>

				<select name="erstzulassung">
					<!-- geht von 1980 -->
					<option value="" disabled selected>JJJJ</option>
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
				<input type="number" name="kilometerstand">
			</div>

			<div>
				<label>Leistung :</label>
				<input type="number" name="leistung">
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
  				<input type="radio" id="Schaltgetriebe" name="getriebeart" value="Schaltgetriebe">
 				<label for="Schaltgetriebe">Schaltgetriebe</label><br>
 				<input type="radio" id="Automatik" name="getriebeart" value="Automatik">
 				<label for="Automatik">Automatik</label><br>
 				<input type="radio" id="Halbautomatik" name="getriebeart" value="Halbautomatik">
  				<label for="Halbautomatik">Halbautomatik</label>
			</div>
			<div>
				<label>Anzahl an Türen :</label><br>
  				<input type="radio" id="3" name="anztueren" value="3">
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

				$query = mysqli_query($conn,$sql) or die("Abfrage erfolglos");

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
			<!-- Farbe -->
			<select>
				<option disabled selected>Farbe auswählen</option>
				<?php
        		$sql = "SELECT * FROM farbe";

				$query = mysqli_query($conn,$sql) or die("Abfrage erfolglos");

				$output = "";
				while ($row = mysqli_fetch_assoc($query)) {

				$farbe = $row['farbe'];
				$columnname = $row['columnname'];

					$output .= "<option name='".$columnname."' value='clicked'>".$farbe."</option>";
				}
				echo $output;
        		?>
        	</select>
        </div>
        <form>
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

      	<button type="submit" formaction="sucheAusgeben.php">Suchen</button>

		</body>
	</html>