<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

include 'functions/id_to_string.php';
include 'functions/movie_form.php';
include 'variables/fields.php';

// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

$select = 'SELECT * FROM movie WHERE movie_id='.$_GET['id'];
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

$fields = $edit_movie_fields;
$movie = [];
foreach ($fields as $value) {
	$movie[$value] = $line[$value];
}


echo '<h1>Edit movie</h1>';
print_movie_form($movie, 'commit.php?action=edit&object=movie');

// Close connection
mysql_close($handle);
?>
</body>
</html>