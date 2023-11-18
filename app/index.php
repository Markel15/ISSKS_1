<?php
    include 'config.php';
    ini_set('session.use_only_cookies',1);
    ini_set('session.use_strict_mode',1);
    ini_set('session.hash_function','sha256');
    //header("Content-Security-Policy: default-src 'self'; script-src 'self' https://fonts.gstatic.com https://fonts.googleapis.com; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com https://fonts.googleapis.com; img-src 'self';");
    $konekzioa = konektatuDatuBasera();
    function eskapatu($testua){
        return str_replace(";","",htmlspecialchars($testua, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8"));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS fitxategia konfiguratu -->
    <link rel="stylesheet" href="css/style_main.css">
    <!-- Roboto letra mota kargatu -->
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
    <button id="datuak_aldatu">Datuak aldatu / Izena eman</button>
    <div id="div_nagusia">
        <h3>Xehetasunak ikusteko, kutxa batean klikatu:</h3>
        <div id="div_edukia">
            <?php
                $sql = "SELECT * FROM LIBURUA";
                $result = $konekzioa->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<div class='div_taula'>";
                    echo "<div class='div_taula_sub'>";
                    echo "<h2>" . eskapatu($row["Titulua"]) . "</h2>";
                    echo "</div>";
                    echo "<div class='div_taula_sub'>";
                    echo "<p>Egilea: " . eskapatu($row["Autorea"]) . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<table style='display: none;'>";
                    echo "<tr>";
                    echo "<th>Izenburua</th>";
                    echo "<th>Egilea</th>";
                    echo "<th>Generoa</th>";
                    echo "<th>Prezioa</th>";
                    echo "<th>ISBN</th>";
                    echo "<th></th>";
                    echo "<th></th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>" . eskapatu($row["Titulua"]) . "</td>";
                    echo "<td>" . eskapatu($row["Autorea"]) . "</td>";
                    echo "<td>" . eskapatu($row["Generoa"]) . "</td>";
                    echo "<td>" . eskapatu($row["Prezioa"]) . "</td>";
                    echo "<td>" . eskapatu($row["ISBN"]) . "</td>";
                    echo "<td onclick='liburuaEditatuLeihoa(\"" . eskapatu($row["Titulua"]) . "\",\"" . eskapatu($row["Autorea"]) . "\",\"" . eskapatu($row["Generoa"]) . "\"," . eskapatu($row["Prezioa"]) . ",\"" . eskapatu($row["ISBN"]) . "\")'>Editatu</td>";
                    echo "<td onclick='liburuaEzabatu(\"" . eskapatu($row["ISBN"]) . "\")'>Ezabatu</td>";
                    // ISBNren balioa kate bat da (string), komatxo sinpleetan biltzen duzula ziurtatu behar da ^^
                    echo "</tr>";
                    echo "</table>";
                }

                $konekzioa->close();
            ?>
        </div>
    </div>
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
    <div id="botoi_biribila"><p>+</p></div>
    <div id="div_modal">
        <div id="div_modal_sub">
            <div id="div_modal_itxi">
                <span id="modal_itxi">&times;</span>
            </div>
            <h2 id="h2_izenburua">Liburua gehitu</h2>
            <form action="functions_main.php" method="post">
                <label for="izenburua">Izenburua:</label>
                <input type="text" id="input_izenburua" name="izenburua">

                <label for="egilea">Egilea:</label>
                <input type="text" id="input_egilea" name="egilea">

                <label for="generoa">Generoa:</label>
                <select id="input_generoa" name="generoa">
                    <option value="Ezezaguna">Ezezaguna</option>
                    <option value="Misterioa">Misterioa</option>
                    <option value="Abentura">Abentura</option>
                    <option value="Fantasia">Fantasia</option>
                    <option value="Zientzia-fikzioa">Zientzia-fikzioa</option>
                    <option value="Thriller">Thriller</option>
                    <option value="Amodio">Amodio</option>
                </select>

                <label for="prezioa">Prezioa:</label>
                <input type="number" id="input_prezioa" name="prezioa" min="0" value="0" step="0.01">

                <label for="isbn">ISBN:</label>
                <input type="text" id="input_isbn" name="isbn">

                <input type="hidden" id="input_isbnAurrekoa" name="isbnAurrekoa" value="">

                <input type="hidden" id="hidden_akzioa" name="akzioa" value="gehitu">
                <input type="hidden" name="csrf" value="<?php echo $token; ?>">
                <button type="submit" onclick="return formularioaBalioztatu()">Bidali</button>
            </form>
        </div>
        <div id="div_opaku"></div>
    </div>
    <script src="js/script_main.js"></script>
</body>
</html>
