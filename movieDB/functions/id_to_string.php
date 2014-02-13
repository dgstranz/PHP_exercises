<?php
// We'll use these functions to give the user more relevant data (strings) than raw IDs

function get_type($movie_type) {
	$select = 'SELECT movietype_label FROM movietype WHERE movietype_id = '.$movie_type;
	$result = mysql_query($select);
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	return $line['movietype_label'];
}

function get_person($person) {
	$select = 'SELECT people_fullname FROM people WHERE people_id = '.$person;
	$result = mysql_query($select);
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	return $line['people_fullname'];
}
?>