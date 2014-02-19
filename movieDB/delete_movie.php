<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

$select = 'DELETE FROM movie WHERE movie_id='.$_GET['id'];
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());

if ($result) {
	echo 'Movie successfully deleted.<br />';
} else {
	echo 'Cannot delete this movie.<br />';
}

echo '<a href="index.php">Go back</a>';

// Close connection
mysql_close($handle);
?>
</body>
</html>