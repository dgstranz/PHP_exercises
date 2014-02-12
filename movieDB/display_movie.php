<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include 'functions.php';

// Open connection, select DB and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\' select database.');
$select = 'SELECT * FROM movie WHERE movie_id='.$_GET['id'];
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

// Display results as HTML
echo '<h1>'.$line['movie_name'].'</h1>';
echo '<ul>';
echo '<li>Year: '.$line['movie_year'].'</li>';
echo '<li>Genre: '.get_type($line['movie_type']).'</li>';
echo '<li>Director: '.get_person($line['movie_director']).'</li>';
echo '<li>Lead actor: '.get_person($line['movie_leadactor']).'</li>';
echo '</ul>';
echo '<a href="index.php">Go back</a>';

// Free results
mysql_free_result($result);

// Close connection
mysql_close($handle);
?>
</body>
</html>