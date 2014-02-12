<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
function exists_movie($movie) {
	$select = "SELECT * FROM movie WHERE movie_name = '$movie'";
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return $line;
}

function exists_people($people) {
	$select = "SELECT * FROM people WHERE people_fullname = '$people'";
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return $line;
}

function add_movie($movie, $genre, $year, $actor, $director) {
	$select = "INSERT INTO movie (movie_name, movie_type, movie_year, movie_leadactor, movie_director)
				VALUES ($movie, $genre, $year, $actor, $director)";
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return true;
}

function add_people($people, $isactor, $isdirector) {
	$select = "INSERT INTO people (people_fullname, people_isactor, people_isdirector)
				VALUES ($people, $isactor, $isdirector)";
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return true;
}

function add_actor($people) {
	add_people($people, 1, 0);
}

function add_director($people) {
	add_people($people, 0, 1);
}

function make_actor($people) {
	$select = "UPDATE people
				SET people_isactor=1
				WHERE people_fullname=$people";
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return true;
}

function make_director($people) {
	$select = "UPDATE people
				SET people_isdirector=1
				WHERE people_fullname=$people";
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return true;
}

if (!empty($_REQUEST['movie']) &&
	!empty($_REQUEST['year']) &&
	!empty($_REQUEST['director']) &&
	!empty($_REQUEST['actor'])) {
	$movie = $_REQUEST['movie'];
	$genre = $_REQUEST['genre'];
	$year = $_REQUEST['year'];
	$director = $_REQUEST['director'];
	$actor = $_REQUEST['actor'];
} else {
	header('Location: '.$_SERVER['HTTP_REFERER']);
}

// Open connection, select DB and execute the query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

$var_movie = exists_movie($movie);
$var_actor = exists_people($actor);
$var_director = exists_people($director);

var_dump($var_movie);
if (!$var_movie) {
	if (!$var_actor) {
		add_actor($actor);
	} else {
		if (!$var_actor['people_isactor']) {
			make_actor($actor);
		}
	}
	if (!$var_director) {
		add_director($director);
	} else {
		if (!$var_director['people_isactor']) {
			make_director($director);
		}
	}
	add_movie($movie);
}

// Close connection
mysql_close($handle);
?>
</body>
</html>