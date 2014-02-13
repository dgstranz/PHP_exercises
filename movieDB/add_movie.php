<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

include 'functions/id_to_string.php';
include 'functions/movie_form.php';

var_dump($_SESSION);

// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

print_movie_form($_SESSION, 'commit.php');

// Close connection
mysql_close($handle);
?>
</body>
</html>