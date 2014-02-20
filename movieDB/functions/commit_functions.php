<?php

/* Queries that will be executed to
 * * see if a movie or person is stored or not in the database
 * * add, edit or delete a movie or a person in the database
 */

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

function edit_person($people_id, $people_fullname, $people_isactor, $people_isdirector) {
	if (!$people_isactor) delete_actor_instances($people_id);
	if (!$people_isdirector) delete_director_instances($people_id);
	$query = "UPDATE people
				SET people_fullname = '$people_fullname',
					people_isactor = $people_isactor,
					people_isdirector = $people_isdirector
				WHERE people_id = $people_id";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function delete_movie($movie_id) {
	$query = "DELETE FROM movie WHERE movie_id = $movie_id";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function delete_actor_instances($people_id) {
	$query = "UPDATE movie
				SET movie_leadactor = NULL
				WHERE movie_leadactor = $people_id";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function delete_director_instances($people_id) {
	$query = "UPDATE movie
				SET movie_director = NULL
				WHERE movie_director = $people_id";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

function delete_person_instances($people_id) {
	return delete_actor_instances($people_id)
		&& delete_director_instances($people_id);
}

function delete_person($people_id) {
	$query = "DELETE FROM people WHERE people_id = $people_id";
	$result = mysql_query($query) or die('Couldn\'t execute query: ' . mysql_error());
	return $result;
}

?>
