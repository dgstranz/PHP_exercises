<?php

function person_name_field($default) {
	echo '<tr>
			<td>Name:</td>
			<td><input type="text" name="person_fullname" '.(!empty($default) ? 'value="'.$default.'"' : '').' /></td>
		</tr>';
}

function person_job_field() {
	echo '<tr>
			<td>Job(s):</td>
			<td><input type="checkbox" name="person_isactor" value="1">Actor</input><br>
				<input type="checkbox" name="person_isdirector" value="1">Director</input></td>
		</tr>';
}

function print_person_form($default_array, $destination_uri) {
	echo '
		<form action="'.$destination_uri.'" method="post">
			<table>';

	person_name_field(isset($default_array['people_fullname']) ? $default_array['people_fullname'] : '');
	person_job_field();
				
	echo '			<tr>
					<td></td>
					<td><input type="submit" value="Submit" /></td>
				</tr>
			</table>
		</form>';
}

?>
