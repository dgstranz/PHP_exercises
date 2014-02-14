<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

$fields = ['movie_name', 'movie_type', 'movie_year', 'movie_director', 'movie_leadactor'];
foreach ($fields as $value) {
	if (!isset($_SESSION[$value])) $_SESSION[$value] = '';
}

include 'functions/id_to_string.php';
include 'functions/movie_form.php';

// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

print_movie_form($_SESSION, 'commit.php?action=add&object=movie');

// Close connection
mysql_close($handle);
?>
</body>
</html>