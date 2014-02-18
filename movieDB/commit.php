<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

include 'variables/fields.php';

function exists_movie($movie, $id) {
	$query = "SELECT * FROM movie WHERE movie_name = '$movie' AND movie_id != $id";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return !empty($line);
}

function exists_person($people, $id) {
	$query = "SELECT * FROM people WHERE people_fullname = '$people' AND people_id != $id";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	return !empty($line);
}

function add_movie($movie_name, $movie_type, $movie_year, $movie_leadactor, $movie_director) {
	$query = "INSERT INTO movie (movie_name, movie_type, movie_year, movie_leadactor, movie_director)
				VALUES ('$movie_name', $movie_type, $movie_year, $movie_leadactor, $movie_director)";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function add_person($people_fullname, $people_isactor, $people_isdirector) {
	$query = "INSERT INTO people (people_fullname, people_isactor, people_isdirector)
				VALUES ('$people_fullname', $people_isactor, $people_isdirector)";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function edit_movie($movie_id, $movie_name, $movie_type, $movie_year, $movie_leadactor, $movie_director) {
	$query = "UPDATE movie
				SET movie_name = '$movie_name',
					movie_type = $movie_type,
					movie_year = $movie_year,
					movie_leadactor = $movie_leadactor,
					movie_director = $movie_director
				WHERE movie_id = $movie_id";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function add_actor($people) {
	add_person($people, 1, 0);
}

function add_director($people) {
	add_person($people, 0, 1);
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

// Pass parameters to session and count empty fields
$field_var = $_REQUEST['action'].'_'.$_REQUEST['object'].'_fields';
$fields = $$field_var; // For example, $add_movie_fields, which is defined in variables/fields.php
var_dump($field_var);
var_dump($fields);

if ($_REQUEST['object'] == 'movie') {
	$req_fields = $fields;
	$empty_req_fields = 0;
	foreach ($fields as $value) {
		$_SESSION[$value] = $_REQUEST[$value];
	}
	foreach ($req_fields as $value) {
		if (empty($_SESSION[$value])) $empty_req_fields++;
	}

	if ($empty_req_fields) {
		echo 'The form is not filled.<br />';
		//sleep(5);
		//header('Location: '.$_SERVER['HTTP_REFERER']);
	} else if ($_REQUEST['action'] == 'add') {
		if (exists_movie($_SESSION['movie_name'], -1)) {
			echo 'A movie called '.$_SESSION['movie_name'].' already exists in our database.<br />';
		} else {
			add_movie($_SESSION['movie_name'], $_SESSION['movie_type'], $_SESSION['movie_year'], $_SESSION['movie_leadactor'], $_SESSION['movie_director']);
			echo 'Movie added.<br />';
		}
	} else if ($_REQUEST['action'] == 'edit') {
		if (exists_movie($_SESSION['movie_name'], $_SESSION['movie_id'])) {
			echo 'A movie called '.$_SESSION['movie_name'].' already exists in our database.<br />';
		} else {
			edit_movie($_SESSION['movie_id'], $_SESSION['movie_name'], $_SESSION['movie_type'], $_SESSION['movie_year'], $_SESSION['movie_leadactor'], $_SESSION['movie_director']);
			echo 'Movie updated.<br />';
		}
	}

} else if ($_REQUEST['object'] == 'person') {
	if ($_REQUEST['action'] == 'add') {
		$req_fields = ['people_fullname'];
		$empty_req_fields = 0;
		$job_checkboxes = ['people_isactor', 'people_isdirector'];
		$job_counter = 0;
		foreach ($req_fields as $value) {
			$_SESSION[$value] = $_REQUEST[$value];
			if (empty($_SESSION[$value])) $empty_req_fields++;
		}
		foreach ($job_checkboxes as $value) {
			if (!empty($_REQUEST[$value])) {
				$_SESSION[$value] = 1;
				$job_counter++;
			} else {
				$_SESSION[$value] = 0;
			}
		}

		if ($empty_req_fields) {
			echo 'The form is not filled.<br />';
			//sleep(5);
			//header('Location: '.$_SERVER['HTTP_REFERER']);
		} else if (exists_person($_SESSION['people_fullname'], -1)) {
			echo 'A person called '.$_SESSION['people_fullname'].' already exists in our database.<br />';
		} else if ($job_counter == 0) {
			echo 'Cannot add people with no job.<br />';
		} else {
			add_person($_SESSION['people_fullname'], isset($_SESSION['people_isactor']) ? '1' : '0', isset($_SESSION['people_isdirector']) ? '1' : '0');
			echo 'Person added.<br />';
		}
	}
}

// Close connection
mysql_close($handle);


echo '<a href="index.php">Go back</a>';
?>
</body>
</html>