<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

include 'functions/id_to_string.php';
include 'functions/movie_form.php';

// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

$select = 'SELECT * FROM movie WHERE movie_id='.$_GET['id'];
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

$fields = ['movie_name', 'movie_type', 'movie_year', 'movie_director', 'movie_leadactor'];
$movie = [];
$empty_fields = 0;
foreach ($fields as $value) {
	$movie[$value] = $line[$value];
}

print_movie_form($movie, 'commit.php');

// Close connection
mysql_close($handle);
?>
</body>
</html>