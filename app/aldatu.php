<?php

    include 'config.php';
    $konexioa = konektatuDatuBasera();
    $mysqli = sortuMysqli();
    //Datuak lortu
    session_start();
    $erab = $_SESSION['erabiltzailea'];//erabiltzailearen balioa lortu
    $sql="SELECT * FROM ERABILTZAILEA WHERE Izena=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $erab);
    $stmt->execute();
    $result=$stmt->get_result();
    if(!$result){
    	die('Kontsulta exekutatzean errorea');
    }
    $stmt->close();
    $row=mysqli_fetch_assoc($result);
    $abizenak=$row['Abizenak'];
    $NAN=$row['NAN'];
    $telefonoa=$row['Telefonoa'];
    $jaiodata=$row['Jaiotzedata'];
    $email=$row['email'];
    $pasahitza=$row['Pasahitza'];
    
    if(isset($_POST['submit'])){
    	$izena=$_POST['Izena'];
    	$abizenak=$_POST['Abizenak'];
    	$NAN=$_POST['NAN'];
    	$telefonoa=$_POST['Telefonoa'];
    	$jaiodata=$_POST['JaioData'];
    	$email=$_POST['Email'];
    	$pasahitza=$_POST['pasahitza'];
    	$sql2 = "UPDATE ERABILTZAILEA SET Izena=?,Pasahitza=?,Abizenak=?,NAN=?,Telefonoa=?,Jaiotzedata=?,email=? WHERE NAN=?";
    	$stmt = $mysqli->prepare($sql2);
    	$stmt->bind_param('ssssssss',$izena,$pasahitza,$abizenak,$NAN,$telefonoa,$jaiodata,$email,$NAN);
    	$stmt->execute();
    	if($stmt->affected_rows===1){
    		//header('Location: index.php');
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
                		<input type="text" class="borde_ez" id="NAN" name="NAN" placeholder="NAN" pattern="^[0-9]{8}-[A-Z]$" required title="formatua: 11111111-Z" value="<?php echo $NAN ?>" readonly> <!-- Ezin da aldatu gakoa (readonly) -->
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
                		<input type="password" class="borde_ez" id="pasahitza" name="pasahitza" placeholder="Pasahitza" required value="<?php echo $pasahitza ?>">
            		</div>
            		<div class="div_formularioa">
                		<button type="submit" id="iz_em_bot" name="submit">Datuak aldatu</button>
             		</div>
             	</form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
