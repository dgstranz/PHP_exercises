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

$select = 'SELECT * FROM people WHERE people_id='.$_GET['id'];
$result = mysql_query($select) or die('Cannot execute query: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

// Display data from movie
echo '<h1>Are you sure you want to delete this person?</h1>';
echo '<h2>'.$line['people_fullname'].'</h2>';
echo 'Jobs:<br>';
echo '<ul>';
if ($line['people_isactor'] > 0) echo '<li>Actor</li>';
if ($line['people_isdirector'] > 0) echo '<li>Director</li>';
echo '</ul>';

/*$select = 'DELETE FROM people WHERE people_id='.$_GET['id'];
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());

if ($result) {
	echo 'Person successfully deleted.<br />';
} else {
	echo 'Cannot delete this person.<br />';
}*/

echo '<a href="index.php">Go back</a>';

// Close connection
mysql_close($handle);
?>
</body>
</html>