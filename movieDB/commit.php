<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

function exists_movie($movie) {
	$query = "SELECT * FROM movie WHERE movie_name = '$movie'";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return !empty($line);
}

function exists_people($people) {
	$query = "SELECT * FROM people WHERE people_fullname = '$people'";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return !empty($line);
}

function add_movie($movie, $genre, $year, $actor, $director) {
	$query = "INSERT INTO movie (movie_name, movie_type, movie_year, movie_leadactor, movie_director)
				VALUES ('$movie', $genre, $year, $actor, $director)";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function add_people($people, $isactor, $isdirector) {
	$query = "INSERT INTO people (people_fullname, people_isactor, people_isdirector)
				VALUES ('$people', $isactor, $isdirector)";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function add_actor($people) {
	add_people($people, 1, 0);
}

function add_director($people) {
	add_people($people, 0, 1);
}

function make_actor($people) {
	$query = "UPDATE people
				SET people_isactor=1
				WHERE people_fullname=$people";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	mysql_free_result($result);
	return $result;
}

function make_director($people) {
	$query = "UPDATE people
				SET people_isdirector=1
				WHERE people_fullname=$people";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	mysql_free_result($result);
	return $result;
}

// Open connection, select DB and execute the query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

$_SESSION['movie'] = $_REQUEST['movie'];
$_SESSION['genre'] = $_REQUEST['genre'];
$_SESSION['year'] = $_REQUEST['year'];
$_SESSION['actor'] = $_REQUEST['actor'];
$_SESSION['director'] = $_REQUEST['director'];

if (empty($_REQUEST['movie'])) {
	echo 'The form is not filled.<br />';
	//sleep(5);
	//header('Location: '.$_SERVER['HTTP_REFERER']);
} else if (!exists_movie($_SESSION['movie'])) {
	add_movie($_SESSION['movie'], $_SESSION['genre'], $_SESSION['year'], $_SESSION['actor'], $_SESSION['director']);
	echo 'Movie added.<br />';
} else {
	echo 'Movie already exists.<br />';
}

// Close connection
mysql_close($handle);


echo '<a href="index.php">Go back</a>';
?>
</body>
</html>