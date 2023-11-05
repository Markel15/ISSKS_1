<?php
	include 'config.php';

	//MySQLi objektua sortu
	$konekzioa = konektatuDatuBasera();

	//Datuak lortu
	$izena = $_POST['Izena'];
	$abizenak = $_POST['Abizenak'];
	$NAN = $_POST['NAN'];
	$telefonoa = $_POST['Telefonoa'];
	$jaiodata = $_POST['JaioData'];
	$email = $_POST['Email'];
	$pasahitza = $_POST['pasahitza'];
	// Ohiko pasahitzen lista lortu fitxategi batetik
	$common_passwords = file('common_passwords.txt', FILE_IGNORE_NEW_LINES);
	// Pasahitza ohiko pasahitzen listarekin konparatu
	if (in_array($pasahitza, $common_passwords)) {
  	// Pasahitza listan badago prozesua amaitu
		echo '<script>';
		echo 'alert("Zure pasahitza oso ohikoa da")';
		echo '</script>';
		echo '<script>window.location.href = "sign.html";</script>; ';
		exit();
  	}
  	// pasahitzaren konplexutasuna konprobatu
	$uppercase = preg_match('@[A-Z]@', $pasahitza);
	$lowercase = preg_match('@[a-z]@', $pasahitza);
	$number    = preg_match('@[0-9]@', $pasahitza);
	if(!$uppercase || !$lowercase || !$number || strlen($pasahitza) < 8) {
    		echo '<script>';
		echo 'alert("Zure pasahitzak ez du konplexutasun nahikorik. 8 karaktereko luzera, hizki bat maiuskulaz eta hizki bat minuskulaz izan behar ditu gutxienez")';
		echo '</script>';
		echo '<script>window.location.href = "sign.html";</script>; ';
		exit();
	}
	$hash = password_hash($pasahitza, PASSWORD_DEFAULT);

	$sql = "INSERT INTO ERABILTZAILEA VALUES(?, ?, ?, ?, ?, ?, ?)";

	//mysqli prepared statement-a sortu
    if ($stmt = $konekzioa->prepare($sql)){
		$stmt->bind_param('sssssss', $izena, $hash, $abizenak, $NAN, $telefonoa, $jaiodata, $email);
    	$stmt->execute();
	}
    	
	if ($stmt->affected_rows === 1) {
		//header('Location: index.php');
		echo '<script>';
		echo 'alert("Izena eman duzu era egokian, orain hasierako orrira bueltatuko zara")';
		echo '</script>';
		echo '<script>window.location.href = "index.php";</script>; ';
	}
	else {
		echo "Errorea SQL-aren exekuzioan, izan daiteke NAN-a edo Izena duplikatuta izatea ";
	}

	$stmt->close();
?>
