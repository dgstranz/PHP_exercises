<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

include 'functions/id_to_string.php';

// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

$select = 'SELECT * FROM movie WHERE movie_id='.$_REQUEST['id'];
$result = mysql_query($select) or die('Cannot execute query: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

// Display data from movie
echo '<h1>Are you sure you want to delete this movie?</h1>';
echo '<h2>'.$line['movie_name'].'</h2>';
echo '<ul>';
echo '<li>Year: '.$line['movie_year'].'</li>';
echo '<li>Genre: '.get_type($line['movie_type']).'</li>';
echo '<li>Director: '.get_person($line['movie_director']).'</li>';
echo '<li>Lead actor: '.get_person($line['movie_leadactor']).'</li>';
echo '</ul>';

echo '<form action="commit.php?action=delete&object=movie" method="post">
		<input type="hidden" name="movie_id" value="'.$_REQUEST['id'].'" />
		<input type="submit" value="Submit" />
		<input type="button" value="Back" onClick="history.go(-1);return true;" />
	</form>';

// Close connection
mysql_close($handle);
?>
</body>
</html>