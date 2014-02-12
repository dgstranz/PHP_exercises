<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include 'functions.php';

// Abrir la conexión, seleccionar la base de datos y realizar la consulta
$handle = mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('movies') or die('No se pudo seleccionar la base de datos.');
$select = 'SELECT * FROM movietype ORDER BY movietype_label';
$result = mysql_query($select) or die('Error al hacer la consulta: ' . mysql_error());

// Formulario
echo '
	<form action="commit.php" method="post">
		<table>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="movie" /></td>
			</tr>
			<tr>
				<td>Genre:</td>
				<td><select name="genre">';

$i=0;
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$i++;
	echo '<option value="'.$line['movietype_id'].'">'.$line['movietype_label'].'</option>';
}

echo '</select></td>
			</tr>
			<tr>
				<td>Year:</td>
				<td><input type="number" name="year" value="'.date('Y').'" min="1890" max="'.date('Y').'" /></td>
			</tr>
			<tr>
				<td>Director:</td>
				<td><input type="text" name="director" /></td>
			</tr>
			<tr>
				<td>Lead actor:</td>
				<td><input type="text" name="actor" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Submit" /></td>
			</tr>
		</table>
	</form>';

// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($handle);
?>
</body>
</html>