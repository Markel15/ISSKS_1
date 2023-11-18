<?php
    ini_set('session.use_only_cookies',1);
    ini_set('session.use_strict_mode',1);
    ini_set('session.cookie_httponly',1);
    ini_set('session.hash_function','sha256');
    session_start();//Saioa hasi csrf token-a gordetzeko
    $token = bin2hex(random_bytes(16));//token-a sortu
    $_SESSION['token']=$token;
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
    <title>San Mamés Liburutegia</title>
</head>
<body>
    <header>
        <div id="div_goiburua">
            <h1 id="izenburua">San Mamés Liburutegia</h1>
        </div>
    </header>
    <div id="div_nagusia">
	 <?php
	    if($_POST){
    	    	session_start();
    		$csrf= $_POST['csrf'];
    		if($_SESSION['token'] === $csrf){
    		    unset($_SESSION['token']);
    		}
    		else{
    		    echo 'CSRF erasoa';
    		}
	    }
	?>
        <form action="" class="login_formularioa">
            <div class="div_formularioa">
                <h2>Hasi saioa</h2>
            </div>
            <div class="div_formularioa">
                <input type="text" class="borde_ez" id="erabiltzailea" placeholder="Erabiltzailea">
            </div>
            <div class="div_formularioa">
                <input type="password" class="borde_ez" id="pasahitza" placeholder="Pasahitza" autocomplete="off">
            </div>
            <div class="div_formularioa">
                <button id="login_botoia">Sartu saioan</button>
            </div>
            <div class="div_formularioa">
                <button id="signup_botoia">Eman izena</button>
             </div>
             <input type="hidden" name="csrf" value="<?php echo $token; ?>">
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
