<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

// Form
echo '
	<form action="commit.php" method="post">
		<table>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="movie" /></td>
			</tr>
			<tr>
				<td>Genre:</td>
				<td><select name="genre">';

$select = 'SELECT movietype_id, movietype_label FROM movietype ORDER BY movietype_label';
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
$i=0;
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$i++;
	echo '<option value="'.$line['movietype_id'].'">'.$line['movietype_label'].'</option>';
}
mysql_free_result($result);

echo '</select></td>
			</tr>
			<tr>
				<td>Year:</td>
				<td><input type="number" name="year" value="'.date('Y').'" min="1890" max="'.date('Y').'" /></td>
			</tr>
			<tr>
				<td>Director:</td>
				<td><select name="director">';

$select = 'SELECT people_id, people_fullname, people_isdirector FROM people WHERE people_isdirector > 0 ORDER BY people_fullname';
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
$i=0;
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$i++;
	echo '<option value="'.$line['people_id'].'">'.$line['people_fullname'].'</option>';
}
mysql_free_result($result);

echo '</select> <a href="add_people.php">Not here?</a></td>
			</tr>
			<tr>
				<td>Lead actor:</td>
				<td><select name="actor">';

$select = 'SELECT people_id, people_fullname, people_isactor FROM people WHERE people_isactor > 0 ORDER BY people_fullname';
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
$i=0;
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$i++;
	echo '<option value="'.$line['people_id'].'">'.$line['people_fullname'].'</option>';
}
mysql_free_result($result);

echo '</select> <a href="add_people.php">Not here?</a></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Submit" /></td>
			</tr>
		</table>
	</form>';

// Close connection
mysql_close($handle);
?>
</body>
</html>