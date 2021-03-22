<?php
if(isset($_POST['submit'])){ 
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt)); 

	$allowed = array('jpg', 'jpeg', 'png', 'pdf');

	if(in_array($fileActualExt, $allowed)){
		if($fileError === 0){
			if($fileSize < 500000){
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = '../verifyPictures/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: betruegermethoden.php?uploadsucess");
			}
			else{
				echo "Ihre Datei ist zu groß! \n Ihre Datei darf nicht größer als 500kB sein! ";
			}
		}
		else{
			echo "Fehler beim Hochladen Ihrer Datei!";
		}
	} 
	else{
		echo "Falsches Format! Bitte laden Sie eine jpg, jpeg, png oder pdf Datei hoch!";
	}
}

?>
