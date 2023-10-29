<?php

	include 'config.php';
	//sortu mysqli objektua
	$mysqli = sortuMysqli();
	//Datuak lortu
	$izena = $_POST['Izena'];
	$abizenak = $_POST['Abizenak'];
	$NAN = $_POST['NAN'];
	$telefonoa = $_POST['Telefonoa'];
	$jaiodata = $_POST['JaioData'];
	$email = $_POST['Email'];
	$pasahitza = $_POST['pasahitza'];
	$sql = "INSERT INTO ERABILTZAILEA VALUES(?,?,?,?,?,?,?)";
	//mysqli prepared statement-a sortu
    	$stmt = $mysqli->prepare($sql);
    	$stmt->bind_param('sssssss',$izena,$pasahitza,$abizenak,$NAN,$telefonoa,$jaiodata,$email);
    	$stmt->execute();
	if($stmt->affected_rows===1){
		//header('Location: index.php');
		echo '<script>';
		echo 'alert("Izena eman duzu era egokian, orain hasierako orrira bueltatuko zara")';
		echo '</script>';
		echo '<script>window.location.href = "index.php";</script>; ';
	}
	else{
		echo "Errorea SQL-aren exekuzioan: ";
	}
	$stmt->close();

?>
