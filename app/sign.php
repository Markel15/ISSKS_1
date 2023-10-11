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
		//header('Location: main.php');
		echo '<script>';
		echo 'if(confirm("Izena eman duzu era egokian, orain hasierako orrira joan nahi duzu?")){';
		echo 'window.location.href = "main.php";';
		echo '}';
		echo '</script>';
	}
	else{
		echo "Errorea SQL-aren exekuzioan: " . mysqli_error($konexioa);
	}
	mysqli_close($konexioa);//Itxi konexioa

?>
