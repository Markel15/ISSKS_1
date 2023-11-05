<?php

    include 'config.php';
    $konexioa = konektatuDatuBasera();
    $mysqli = sortuMysqli();
    //Datuak lortu
    session_start();
    $erab = $_SESSION['erabiltzailea'];//erabiltzailearen balioa lortu
    if(!isset($erab)){//Erasotzaile bat zuzenan sartzen saiatzen bada, ez da balioa existituko
    	header('Location: login.html');
    }
    $sql="SELECT * FROM ERABILTZAILEA WHERE Izena=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $erab);
    $stmt->execute();
    $result=$stmt->get_result();
    if(mysqli_num_rows($result)===0){//Erabiltzaile Izena ez bada existitzen
    	die('Erabiltzailea ez da aurkitu');
    }
    $stmt->close();
    $row=mysqli_fetch_assoc($result);
    $erab = $row['Izena'];
    $abizenak=$row['Abizenak'];
    $NANgordeta=$row['NAN'];
    $telefonoa=$row['Telefonoa'];
    $jaiodata=$row['Jaiotzedata'];
    $email=$row['email'];
    
    if(isset($_POST['submit'])){
    	$izena=$_POST['Izena'];
    	$abizenak=$_POST['Abizenak'];
    	$NAN=$_POST['NAN'];
    	$telefonoa=$_POST['Telefonoa'];
    	$jaiodata=$_POST['JaioData'];
    	$email=$_POST['Email'];
    	$pasahitza=$_POST['pasahitza'];
    	// Ohiko pasahitzen lista lortu fitxategi batetik
	$common_passwords = file('common_passwords.txt', FILE_IGNORE_NEW_LINES);
	// Pasahitza ohiko pasahitzen listarekin konparatu
	if (in_array($pasahitza, $common_passwords)) {
  	// Pasahitza listan badago prozesua amaitu
		echo '<script>';
		echo 'alert("Zure pasahitza oso ohikoa da")';
		echo '</script>';
		echo '<script>window.location.href = "aldatu.php";</script>; ';
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
		echo '<script>window.location.href = "aldatu.php";</script>; ';
		exit();
	}
	$hash = password_hash($pasahitza, PASSWORD_DEFAULT);
    	if($NANgordeta==$NAN){
    	    $sql2 = "UPDATE ERABILTZAILEA SET Izena=?,Pasahitza_hash=?,Gatza=?,Abizenak=?,NAN=?,Telefonoa=?,Jaiotzedata=?,email=? WHERE NAN=?";
    	    $stmt = $mysqli->prepare($sql2);
    	    $stmt->bind_param('sssssssss',$izena,$hash,$gatza,$abizenak,$NAN,$telefonoa,$jaiodata,$email,$NAN);
    	    $stmt->execute();
    	    if(mysqli_stmt_errno($stmt)===0){// 0 ez bada, errore bat gertatu da.
    	        $stmt->close();
    		echo '<script>';
		echo 'if(confirm("Informazioa gorde da era egokian. Hasierako orrira joan nahi duzu?")){';
		echo 'window.location.href = "index.php";';
		echo '}';
		echo '</script>';
    	    }
    	     else{
    		die(" MYSQL errorea");
    	    }
    	} 
    	else{
    	    die("Ezin da beste erabiltzaile baten datuak aldatu");
    	}
    }
    mysqli_close($konexioa);
?>

<! DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>San Mamés Liburutegia</title>
</head>
<body>
    <header>
        <div id="div_goiburua">
            <h1 id="izenburua">Datuak aldatu</h1>
        </div>
    </header>
    <div id="div_sign">
    	<form method="post" id="formul" class="login_formularioa">
        	<div class="div_formularioa">
                		<input type="text" class="borde_ez" id="Izena" name="Izena" placeholder="Izena" pattern ="[A-Za-záéíóúñÁÉÍÓÚÑ\s]+" required title="Textua bakarrik onartzen da" value="<?php echo $erab ?>">
            		</div>
            		<div class="div_formularioa">
                		<input type="text" class="borde_ez" id="Abizenak" name="Abizenak" placeholder="Abizena" pattern ="[A-Za-záéíóúñÁÉÍÓÚÑ\s]+" required title="Textua bakarrik onartzen da" value="<?php echo $abizenak ?>">
            		</div>
            		<div class="div_formularioa">
                		<input type="text" class="borde_ez" id="NAN" name="NAN" placeholder="NAN" pattern="^[0-9]{8}-[A-Z]$" required title="formatua: 11111111-Z" value="<?php echo $NANgordeta ?>" readonly> <!-- Ezin da aldatu gakoa (readonly) -->
            		</div>
                <div class="div_formularioa">
                		<input type="text" class="borde_ez" id="Telefonoa" name="Telefonoa" placeholder="Telefonoa" pattern="[0-9]{9}" required title ="9 zenbaki izan behar dira"value="<?php echo $telefonoa ?>">
            		</div>
            		<div class="div_formularioa">
                		<input type="text" class="borde_ez" id="JaioData" name="JaioData" placeholder="Jaiotze-Data(uuuu-hh-ee)" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required title="uuuu-mm-dd formatua" value="<?php echo $jaiodata ?>">
            		</div>
            		<div class="div_formularioa">
                		<input type="email" class="borde_ez" id="Email" name="Email" placeholder="Email" required title="formatu egokia: adibidea@zerbitzaria.extensioa" value="<?php echo $email ?>">
            		</div>
            		<div class="div_formularioa">
                		<input type="password" class="borde_ez" id="pasahitza" name="pasahitza" placeholder="Pasahitza" required>
            		</div>
            		<div class="div_formularioa">
                		<button type="submit" id="iz_em_bot" name="submit">Datuak aldatu</button>
             		</div>
             	</form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
