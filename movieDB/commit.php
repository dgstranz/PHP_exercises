<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();

include 'variables/fields.php';
include 'functions/commit_functions.php';

// Open connection, select DB and execute the query
$handle = mysql_connect('localhost', 'root', '') or die('Couldn\'t connect: ' . mysql_error());
mysql_select_db('movies') or die('Couldn\'t select database.');

// Pass parameters to session and count empty fields
$field_var = $_REQUEST['action'].'_'.$_REQUEST['object'].'_fields';
$req_fields = $$field_var; // For example, $add_movie_fields, which is defined in variables/fields.php
$empty_req_fields = 0;

foreach ($req_fields as $value) {
	if (!empty($_REQUEST[$value])) {
		$_SESSION[$value] = $_REQUEST[$value];
	} else {
		$empty_req_fields++;
	}
}

if ($empty_req_fields) {
	echo 'The form is not filled.<br />';
	sleep(5);
	header('Location: '.$_SERVER['HTTP_REFERER']);
} else if ($_REQUEST['object'] == 'movie') {
	if ($_REQUEST['action'] == 'add') {
		if (exists_movie($_SESSION['movie_name'], -1)) {
			echo 'A movie called '.$_SESSION['movie_name'].' already exists in our database.<br />';
		} else if (add_movie($_SESSION['movie_name'], $_SESSION['movie_type'], $_SESSION['movie_year'], $_SESSION['movie_leadactor'], $_SESSION['movie_director'])) {
			echo 'Movie added.<br />';
		} else {
			echo 'Error while trying to add movie.<br />';
		}
	} else if ($_REQUEST['action'] == 'edit') {
		if (exists_movie($_SESSION['movie_name'], $_SESSION['movie_id'])) {
			echo 'A movie called '.$_SESSION['movie_name'].' already exists in our database.<br />';
		} else if (edit_movie($_SESSION['movie_id'], $_SESSION['movie_name'], $_SESSION['movie_type'], $_SESSION['movie_year'], $_SESSION['movie_leadactor'], $_SESSION['movie_director'])) {
			echo 'Movie updated.<br />';
		} else {
			echo 'Error while trying to update movie.<br />';
		}
	} else if ($_REQUEST['action'] == 'delete') {
		if (delete_movie($_SESSION['movie_id'])) {
			echo 'Movie successfully deleted.<br />';
		} else {
			echo 'Error while trying to delete movie.<br />';
		}
	}

} else if ($_REQUEST['object'] == 'person') {
	if ($_REQUEST['action'] == 'add') {
		$_SESSION['people_isactor'] = $_REQUEST['people_isactor'];
		$_SESSION['people_isdirector'] = $_REQUEST['people_isdirector'];
		if (exists_person($_SESSION['people_fullname'], -1)) {
			echo 'A person called '.$_SESSION['people_fullname'].' already exists in our database.<br />';
		} else if (!$_SESSION['people_isactor'] && !$_SESSION['people_isdirector']) {
			echo 'Cannot add people with no job.<br />';
		} else if (add_person($_SESSION['people_fullname'], $_SESSION['people_isactor'], $_SESSION['people_isdirector'])) {
			echo 'Person added.<br />';
		} else {
			echo 'Error while trying to add person.<br />';
		}
	} else if ($_REQUEST['action'] == 'edit') {
		$_SESSION['people_isactor'] = $_REQUEST['people_isactor'];
		$_SESSION['people_isdirector'] = $_REQUEST['people_isdirector'];
		if (exists_person($_SESSION['people_fullname'], $_SESSION['people_id'])) {
			echo 'A person called '.$_SESSION['people_fullname'].' already exists in our database.<br />';
		} else if (!$_SESSION['people_isactor'] && !$_SESSION['people_isdirector']) {
			echo 'Cannot store people with no jobs.<br />';
		} else if (edit_person($_SESSION['people_id'], $_SESSION['people_fullname'], $_SESSION['people_isactor'], $_SESSION['people_isdirector'])) {
			echo 'Person updated.<br />';
		} else {
			echo 'Error while trying to update person.<br />';
		}
	} else if ($_REQUEST['action'] == 'delete') {
		var_dump($_SESSION);
		delete_person_instances($_SESSION['people_id']);
		if (delete_person($_SESSION['people_id'])) {
			echo 'Person successfully deleted.<br />';
		} else {
			echo 'Error while trying to delete person.<br />';
		}
	}
}

// Close connection
mysql_close($handle);


echo '<a href="index.php">Go back</a>';
?>
</body>
</html>