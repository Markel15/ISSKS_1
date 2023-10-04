<?php
    include 'config.php';
    $konekzioa = konektatuDatuBasera();
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
    <div id="div_nagusia">
        <div id="div_edukia">
            <?php
                $sql = "SELECT * FROM LIBURUA";
                $result = $konekzioa->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<div class='div_taula'>";
                    echo "<div class='div_taula_sub'>";
                    echo "<h2>" . $row["Titulua"] . "</h2>";
                    echo "</div>";
                    echo "<div class='div_taula_sub'>";
                    echo "<p>Egilea: " . $row["Autorea"] . "</p>";
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
                    echo "<td>" . $row["Titulua"] . "</td>";
                    echo "<td>" . $row["Autorea"] . "</td>";
                    echo "<td>" . $row["Generoa"] . "</td>";
                    echo "<td>" . $row["Prezioa"] . "</td>";
                    echo "<td>" . $row["ISBN"] . "</td>";
                    echo "<td>Editatu</td>";
                    echo "<td>Ezabatu</td>";
                    echo "</tr>";
                    echo "</table>";
                }

                $konekzioa->close();
            ?>
        </div>
    </div>
    <div id="botoi_biribila"><p>+</p></div>
    <div id="div_modal">
        <div id="div_modal_sub">
            <div id="div_modal_itxi">
                <span id="modal_itxi">&times;</span>
            </div>
            <h2>Liburua gehitu</h2>
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

                <button type="submit" onclick="return validarFormulario()">Bidali</button>
            </form>
        </div>
        <div id="div_opaku"></div>
    </div>
    <script src="js/script_main.js"></script>
</body>
</html>