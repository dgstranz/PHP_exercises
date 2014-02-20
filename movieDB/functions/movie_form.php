<?php

function movie_id_field($default) {
	echo '<input type="hidden" name="movie_id" '.(!empty($default) ? 'value="'.$default.'"' : '').'>';
}

function movie_title_field($default) {
	echo '<tr>
			<td>Name:</td>
			<td><input type="text" name="movie_name" '.(!empty($default) ? 'value="'.$default.'"' : '').' /></td>
		</tr>';
}

function movie_genre_field($default) {
	echo '<tr>
			<td>Genre:</td>
			<td><select name="movie_type">
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
			<td><input type="number" name="movie_year" value="'.(!empty($default) ? $default : date('Y')).'" min="1890" max="'.date('Y').'" /></td>
		</tr>';
}

function movie_director_field($default) {
	echo '<tr>
			<td>Director:</td>
			<td><select name="movie_director">
				<option value=""></option>';

	$select = 'SELECT people_id, people_fullname, people_isdirector FROM people WHERE people_isdirector > 0 ORDER BY people_fullname';
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$i=0;
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$i++;
		echo '<option value="'.$line['people_id'].'" '.(!empty($default) && $line['people_id']==$default ? 'selected' : '').'>'.$line['people_fullname'].'</option>';
	}
	mysql_free_result($result);

	echo '</select> <a href="add_person.php">Not here?</a></td>
		</tr>';
}

function movie_actor_field($default) {
	echo '<tr>
			<td>Lead actor:</td>
			<td><select name="movie_leadactor">
				<option value=""></option>';

	$select = 'SELECT people_id, people_fullname, people_isactor FROM people WHERE people_isactor > 0 ORDER BY people_fullname';
	$result = mysql_query($select) or die('Couldn\'t execute query: ' . mysql_error());
	$i=0;
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$i++;
		echo '<option value="'.$line['people_id'].'" '.(!empty($default) && $line['people_id']==$default ? 'selected' : '').'>'.$line['people_fullname'].'</option>';
	}
	mysql_free_result($result);

	echo '</select> <a href="add_person.php">Not here?</a></td>
		</tr>';
}

function print_movie_form($default_array, $destination_uri) {
	echo '
		<form action="'.$destination_uri.'" method="post">
			<table>';

	movie_id_field(isset($default_array['movie_id']) ? $default_array['movie_id'] : '');
	movie_title_field(isset($default_array['movie_name']) ? $default_array['movie_name'] : '');
	movie_genre_field(isset($default_array['movie_type']) ? $default_array['movie_type'] : '');
	movie_year_field(isset($default_array['movie_year']) ? $default_array['movie_year'] : '');
	movie_director_field(isset($default_array['movie_director']) ? $default_array['movie_director'] : '');
	movie_actor_field(isset($default_array['movie_leadactor']) ? $default_array['movie_leadactor'] : '');
				
	echo '			<tr>
					<td></td>
					<td><input type="submit" value="Submit" />
						<input type="button" value="Back" onClick="history.go(-1);return true;" /></td>
				</tr>
			</table>
		</form>';
}

?>
