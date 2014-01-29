<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include 'functions.php';

// Abrir la conexión
$handle = mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());

// Crear la BD y las tablas
$database = "CREATE DATABASE IF NOT EXISTS movies";

$movie = "CREATE TABLE IF NOT EXISTS movie (
	movie_id int(11) NOT NULL auto_increment,
	movie_name varchar(255) NOT NULL,
	movie_type tinyint(2) NOT NULL default 0,
	movie_year int(4) NOT NULL default 0,
	movie_leadactor int(11) NOT NULL default 0,
	movie_director int(11) NOT NULL default 0,
	PRIMARY KEY  (movie_id),
	KEY movie_type (movie_type,movie_year)
)";

$movietype = "CREATE TABLE IF NOT EXISTS movietype (
	movietype_id int(11) NOT NULL auto_increment,
	movietype_label varchar(100) NOT NULL,
	PRIMARY KEY  (movietype_id)
) ENGINE=MyISAM AUTO_INCREMENT=9";

$people = "CREATE TABLE IF NOT EXISTS people (
	people_id int(11) NOT NULL auto_increment,
	people_fullname varchar(255) NOT NULL,
	people_isactor tinyint(1) NOT NULL default 0,
	people_isdirector tinyint(1) NOT NULL default 0,
	PRIMARY KEY  (people_id)
) ENGINE=MyISAM AUTO_INCREMENT=7";

$insert_movie = "INSERT INTO movie (movie_id, movie_name, movie_type, movie_year,
		 movie_leadactor, movie_director)
			VALUES (1, 'Bruce Almighty', 5, 2003, 1, 2),
		 (2, 'Office Space', 5, 1999, 5, 6),
		 (3, 'Grand Canyon', 2, 1991, 4, 3)";

$insert_movietype = "INSERT INTO movietype (movietype_id, movietype_label)
			VALUES (1,'Sci Fi'),
		 (2, 'Drama'),
		 (3, 'Adventure'),
		 (4, 'War'),
		 (5, 'Comedy'),
		 (6, 'Horror'),
		 (7, 'Action'),
		 (8, 'Kids')" ;

$insert_people = "INSERT INTO people
				 (people_id, people_fullname, people_isactor, people_isdirector)
			VALUES (1, 'Jim Carrey', 1, 0),
		 (2, 'Tom Shadyac', 0, 1),
		 (3, 'Lawrence Kasdan', 0, 1),
		 (4, 'Kevin Kline', 1, 0),
		 (5, 'Ron Livingston', 1, 0),
		 (6, 'Mike Judge', 0, 1)";

$result_database = mysql_query($database) or die('Error al crear la BD: ' . mysql_error());
mysql_select_db('movies') or die('No se pudo seleccionar la base de datos.');

$result_movie = mysql_query($movie) or die('Error al crear la tabla: ' . mysql_error());
$result_movietype = mysql_query($movietype) or die('Error al crear la tabla: ' . mysql_error());
$result_people = mysql_query($people) or die('Error al crear la tabla: ' . mysql_error());
mysql_query($insert_movie);
mysql_query($insert_movietype);
mysql_query($insert_people);

$select = "SELECT movie_id, movie_name, movie_year FROM movie ORDER BY movie_id";
$result = mysql_query($select) or die('Error al hacer la consulta: ' . mysql_error());

// Imprimir los resultados en HTML
echo '<h1>Películas</h1>';
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo '<ul>';
	echo '<li><a href="pelis.php?id='.$line['movie_id'].'">'.$line['movie_name'].'</a> ('.$line['movie_year'].')</li>';
	echo '</ul>';
}

// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($handle);
?>
</body>
</html>