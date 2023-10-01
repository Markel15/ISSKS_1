<?php

	include 'config.php';

	$konexioa = konektatuDatuBasera();
	//Datuak lortu
	$izena = $_POST['Izena'];
	$abizenak = $_POST['Abizenak'];
	$NAN = $_POST['NAN'];
	$telefonoa = $_POST['Telefonoa'];
	$jaiodata = $_POST['JaioData'];
	$email = $_POST['Email'];
	$pasahitza = $_POST['pasahitza'];
	$sql = "INSERT INTO ERABILTZAILEA VALUES('$izena','$pasahitza', '$abizenak','$NAN','$telefonoa','$jaiodata','$email')";
	if(mysqli_query($konexioa,$sql)){
		echo "Datuak ondo gorde dira.";
	}
	else{
		echo "Errorea SQL-aren exekuzioan: " . mysqli_error($konexioa);
	}
	mysqli_close($konexioa);//Itxi konexioa

?>
