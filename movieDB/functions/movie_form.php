<?php

function movie_title_field($default) {
	echo '<tr>
			<td>Name:</td>
			<td><input type="text" name="movie" '.(!empty($default) ? 'value="'.$default.'"' : '').' /></td>
		</tr>';
}

function movie_genre_field($default) {
	echo '<tr>
			<td>Genre:</td>
			<td><select name="genre">
				<option value=""></option>';

	$select = 'SELECT movietype_id, movietype_label FROM movietype ORDER BY movietype_label';
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$i=0;
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$i++;
		echo '<option value="'.$line['movietype_id'].'" '.(!empty($default) && $line['movietype_id']==$default ? 'selected' : '').'>'.$line['movietype_label'].'</option>';
	}
	mysql_free_result($result);

	echo '</select></td>
		</tr>';
}

function movie_year_field($default) {
	echo '<tr>
			<td>Year:</td>
			<td><input type="number" name="year" value="'.(!empty($default) ? $default : date('Y')).'" min="1890" max="'.date('Y').'" /></td>
		</tr>';
}

function movie_director_field($default) {
	echo '<tr>
			<td>Director:</td>
			<td><select name="director">
				<option value=""></option>';

	$select = 'SELECT people_id, people_fullname, people_isdirector FROM people WHERE people_isdirector > 0 ORDER BY people_fullname';
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$i=0;
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$i++;
		echo '<option value="'.$line['people_id'].'" '.(!empty($default) && $line['people_id']==$default ? 'selected' : '').'>'.$line['people_fullname'].'</option>';
	}
	mysql_free_result($result);

	echo '</select> <a href="add_people.php">Not here?</a></td>
		</tr>';
}

function movie_actor_field($default) {
	echo '<tr>
			<td>Lead actor:</td>
			<td><select name="actor">
				<option value=""></option>';

	$select = 'SELECT people_id, people_fullname, people_isactor FROM people WHERE people_isactor > 0 ORDER BY people_fullname';
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$i=0;
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$i++;
		echo '<option value="'.$line['people_id'].'" '.(!empty($default) && $line['people_id']==$default ? 'selected' : '').'>'.$line['people_fullname'].'</option>';
	}
	mysql_free_result($result);

	echo '</select> <a href="add_people.php">Not here?</a></td>
		</tr>';
}

function print_movie_form($default_array, $destination_uri) {
	echo '
		<form action="'.$destination_uri.'" method="post">
			<table>';

	movie_title_field($default_array['movie_name']);
	movie_genre_field($default_array['movie_type']);
	movie_year_field($default_array['movie_year']);
	movie_director_field($default_array['movie_director']);
	movie_actor_field($default_array['movie_leadactor']);
				
	echo '			<tr>
					<td></td>
					<td><input type="submit" value="Submit" /></td>
				</tr>
			</table>
		</form>';
}

?>
