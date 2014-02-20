<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

include 'functions/id_to_string.php';
include 'functions/person_form.php';
include 'variables/fields.php';

// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

$select = 'SELECT * FROM people WHERE people_id='.$_GET['id'];
$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);

var_dump($line);

$fields = $edit_person_fields;
$person = [];
foreach ($fields as $value) {
	$person[$value] = $line[$value];
}

// Non-mandatory fields
$person['people_isactor'] = $line['people_isactor'];
$person['people_isdirector'] = $line['people_isdirector'];

echo '<h1>Edit person</h1>';
print_person_form($person, 'commit.php?action=edit&object=person');

// Close connection
mysql_close($handle);
?>
</body>
</html>