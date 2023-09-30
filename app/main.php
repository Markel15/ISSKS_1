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
    <link rel="stylesheet" href="css/styles.css">
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
    <script src="js/script_main.js"></script>
</body>
</html>