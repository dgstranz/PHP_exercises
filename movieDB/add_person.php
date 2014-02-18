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

$fields = $add_person_fields;
foreach ($fields as $value) {
	if (!isset($_SESSION[$value])) $_SESSION[$value] = '';
}


var_dump($_SESSION);

// Open connection, select database and execute query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

print_person_form($_SESSION, 'commit.php?action=add&object=person');

// Close connection
mysql_close($handle);
?>
</body>
</html>