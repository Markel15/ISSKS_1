<?php
    ini_set('session.use_only_cookies',1);
    ini_set('session.use_strict_mode',1);
    ini_set('session.hash_function','sha256');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/styles.css">
   	<link rel="preconnect" href="https://fonts.googleapis.com">
    	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    	<title>Izena eman</title>
</head>
<body>
	<header>
		<div id="div_goiburua">
           	<h1 id="izenburua">Izena eman</h1>
        	</div>
	</header>
	<div id="div_sign">
		 <?php
    		    if($_POST){
    	    	    	session_start();//Saioa hasi csrf token-a gordetzeko
    	    		$token = bin2hex(random_bytes(16));//token-a sortu
    	    		$_SESSION['token']=$token;
    	    		$csrf= $_POST['csrf'];
    	    		if($_SESSION['csrf'] === $csrf){
    	    		    unset($_SESSION['csrf']);
    	    		}
    	    		else{
    	    		    echo 'CSRF erasoa';
    	    		}
    		    }
    		?>
		<form method="post" action="sign.php" id="formularioa" class="login_formularioa">
			<div class="div_formularioa">
                		<h2>Datuak bete</h2>
            		</div>
            		<div class="div_formularioa">
                		<input type="text" class="borde_ez" id="Izena" name="Izena" placeholder="Izena" pattern ="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" required title="Textua bakarrik onartzen da">
            		</div>
            		<div class="div_formularioa">
                		<input type="text" class="borde_ez" id="Abizenak" name="Abizenak" placeholder="Abizena" pattern ="[A-Za-záéíóúñÁÉÍÓÚÑ\s]+" required title="Textua bakarrik onartzen da">
            		</div>
            		<div class="div_formularioa">
                		<input type="text" class="borde_ez" id="NAN" name="NAN" placeholder="NAN" pattern="^[0-9]{8}-[A-Z]$" required title="formatua: 11111111-Z">
            		</div>
                <div class="div_formularioa">
                		<input type="text" class="borde_ez" id="Telefonoa" name="Telefonoa" placeholder="Telefonoa" pattern="[0-9]{9}" required title ="9 zenbaki izan behar dira">
            		</div>
            		<div class="div_formularioa">
                		<input type="text" class="borde_ez" id="JaioData" name="JaioData" placeholder="Jaiotze-Data(uuuu-hh-ee)" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required title="uuuu-mm-dd formatua">
            		</div>
            		<div class="div_formularioa">
                		<input type="email" class="borde_ez" id="Email" name="Email" placeholder="Email" required title="formatu egokia: adibidea@zerbitzaria.extensioa">
            		</div>
            		<div class="div_formularioa">
                		<input type="password" class="borde_ez" id="pasahitza" name="pasahitza" placeholder="Pasahitza" required>
            		</div>
            		<div class="div_formularioa">
                		<button type="submit" id="iz_em_bot">Eman izena</button>
             		</div>
             		<input type="hidden" name="csrf" value="<?php echo $token; ?>">
		</form>
	</div>
  <script src="js/script.js"></script>
</body>

</html>
