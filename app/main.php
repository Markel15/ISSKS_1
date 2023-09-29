<?php
	include "config.php";
	$sql="select izenburua, autorea from database";
	$result=mysqli_query($konekzioa, $sql);
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
	<table id="Taula" spellcheck="false">
		<tr>
			<th>Izenburua</th>
			<th>Egilea</th>
		</tr>
		if(mysqli_num_rows($result)>0){
			while($row= mysqli_fetch_assoc($result)){
				echo =$row[]
			}	
		}
		<!--<tr>
			<td contenteditable="true">proba</td>
			<td contenteditable="true">proba</td>
		</tr>
		<tr>
			<td contenteditable="true">proba</td>
			<td contenteditable="true">proba</td>
		</tr> -->
	</table>
	<script src="js/script.js"></script>
</body>
</html>
