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
$select = 'SELECT * FROM movie WHERE movie_id='.$_GET['id'];
$result = mysql_query($select) or die('Error al hacer la consulta: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

// Imprimir los resultados en HTML
echo '<h1>'.$line['movie_name'].'</h1>';
echo '<ul>';
echo '<li>Año: '.$line['movie_year'].'</li>';
echo '<li>Género: '.get_type($line['movie_type']).'</li>';
echo '<li>Director: '.get_person($line['movie_director']).'</li>';
echo '<li>Actor protagonista: '.get_person($line['movie_leadactor']).'</li>';
echo '</ul>';
echo '<a href="index.php">Atrás</a>';

// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($handle);
?>
</body>
</html>