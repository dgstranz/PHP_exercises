<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
// Open connection
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t establish a connection: ' . mysql_error());

// Create DB and tables
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
			VALUES (1, 'Sci Fi'),
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

$result_database = mysql_query($database) or die('Error creating the database: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select the database.');

$result_movie = mysql_query($movie) or die('Error creating the table: ' . mysql_error());
$result_movietype = mysql_query($movietype) or die('Error creating the table: ' . mysql_error());
$result_people = mysql_query($people) or die('Error creating the table: ' . mysql_error());
mysql_query($insert_movie);
mysql_query($insert_movietype);
mysql_query($insert_people);

$select_movie = "SELECT movie_id, movie_name, movie_year FROM movie ORDER BY movie_id";
$result_movie = mysql_query($select_movie) or die('Couldn\'t execute query: ' . mysql_error());

$select_people = "SELECT * FROM people ORDER BY people_fullname";
$result_people = mysql_query($select_people) or die('Couldn\'t execute query: ' . mysql_error());

// Print results in HTML
echo '<table border="1px solid #888">';
echo '<tr style="background-color: #bdf"><td colspan="3" align="center"><font size=+2><b>Movies</b></font> [<a href="add_movie.php">ADD</a>]</td></tr>';
$lines_printed = 0;
while ($line = mysql_fetch_array($result_movie, MYSQL_ASSOC)) {
	echo '<tr';
	if ($lines_printed % 2 == 1) echo ' style="background-color: #eee"';
	echo '>';
	echo '<td><a href="display_movie.php?id='.$line['movie_id'].'">'.$line['movie_name'].'</a> ('.$line['movie_year'].')</td>';
	echo '<td>[<a href="edit_movie.php?id='.$line['movie_id'].'">EDIT</a>]</td>';
	echo '<td>[<a href="delete_movie.php?id='.$line['movie_id'].'">DELETE</a>]</td>';
	echo '</tr>';
	$lines_printed++;
}
echo '<tr style="background-color: #bdf"><td colspan="3" align="center"><font size=+2><b>People</b></font> [<a href="add_person.php">ADD</a>]</td></tr>';
$lines_printed = 0;
while ($line = mysql_fetch_array($result_people, MYSQL_ASSOC)) {
	echo '<tr';
	if ($lines_printed % 2 == 1) echo ' style="background-color: #eee"';
	echo '>';
	echo '<td>'.$line['people_fullname'].'</td>';
	echo '<td>[<a href="edit_person.php?id='.$line['people_id'].'">EDIT</a>]</td>';
	echo '<td>[<a href="delete_person.php?id='.$line['people_id'].'">DELETE</a>]</td>';
	echo '</tr>';
	$lines_printed++;
}
echo '</table>';

// Free results
mysql_free_result($result_movie);
mysql_free_result($result_people);

// Close connection
mysql_close($handle);
?>
</body>
</html>