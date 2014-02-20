<?php

function person_id_field($default) {
	echo '<input type="hidden" name="people_id" '.(!empty($default) ? 'value="'.$default.'"' : '').' />';
}

function person_name_field($default) {
	echo '<tr>
			<td>Name:</td>
			<td><input type="text" name="people_fullname" '.(!empty($default) ? 'value="'.$default.'"' : '').' /></td>
		</tr>';
}

function person_job_field($default_isactor, $default_isdirector) {
	echo '<tr>
			<input type="hidden" name="people_isactor" value="0" />
			<input type="hidden" name="people_isdirector" value="0" />
			
			<td>Job(s):</td>
			<td><input type="checkbox" name="people_isactor" value="1" '.(!empty($default_isactor) ? 'checked' : '').'>Actor</input><br>
				<input type="checkbox" name="people_isdirector" value="1" '.(!empty($default_isdirector) ? 'checked' : '').'>Director</input><br>
		</tr>';
}

function print_person_form($default_array, $destination_uri) {
	echo '
		<form action="'.$destination_uri.'" method="post">
			<table>';

	person_id_field(isset($default_array['people_id']) ? $default_array['people_id'] : '');
	person_name_field(isset($default_array['people_fullname']) ? $default_array['people_fullname'] : '');
	person_job_field(isset($default_array['people_isactor']) ? $default_array['people_isactor'] : '',
					isset($default_array['people_isdirector']) ? $default_array['people_isdirector'] : '');
				
	echo '			<tr>
					<td></td>
					<td><input type="submit" value="Submit" />
						<input type="button" value="Back" onClick="history.go(-1);return true;" /></td>
				</tr>
			</table>
		</form>';
}

?>
