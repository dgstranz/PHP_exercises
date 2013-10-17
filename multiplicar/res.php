<html>
<head>
<title>Tablas de multiplicar</title>
</head>
<body>

<?php
$filas=$_GET['filas'];
$columnas=$_GET['columnas'];
if(!isset($filas)) $filas=10;
if(!isset($columnas)) $columnas=10;
if($filas<1) $filas=1;
if($columnas<1) $columnas=1;

echo '<table border="5"><tr><td></td>';

for($i=1;$i<=$columnas;$i++) {
	echo '<td><b>'.$i.'</b></td>';
}

echo '</tr>';

for($j=1;$j<=$filas;$j++) {
	echo '<tr><td><b>'.$j.'</b></td>';
	for($i=1;$i<=$columnas;$i++) {
		echo '<td>'.$i*$j.'</td>';
	}
	echo '</tr>';
}

echo '</table>';
?>
</body>
</html>