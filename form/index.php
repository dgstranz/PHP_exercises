<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	$params = ['year', 'month', 'day', 'hour', 'minute', 'title', 'comment'];
	$params_missing = [];

	foreach ($params as $param) {
		if (isset($_REQUEST[$param])) {
			$param = $_REQUEST[$param];
		} else {
			$params_missing[count($params_missing)] = $param;
		}
	}

	if (count($params_missing) > 0) {
		echo '<form action="index.php" method="POST">';
		foreach ($params_missing as $param) {
			print_form($param);
		}
		echo '<input type="submit" />';
		echo '</form>';
	}

	function print_form($param) {
		switch ($param) {
			case 'year':
				echo 'Año: <select name="year">';
				for($i = 2000; $i <= 2037 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select> ';
				break;
			case 'month':
				$months = [null, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
				echo 'Mes: <select name="month">';
				for($i = 1; $i <= 12 ; $i++) {
					echo '<option value="'.$i.'">'.$months[$i].'</option>';
				}
				echo '</select> ';
				break;
			case 'day':
				echo 'Día: <select name="day">';
				for($i = 1; $i <= 31 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select><br>';
				break;
			case 'hour':
				echo 'Hora: <select name="hour">';
				for($i = 0; $i <= 23 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select>:';
				break;
			case 'minute':
				echo '<select name="minute">';
				for($i = 0; $i <= 11 ; $i++) {
					echo '<option value="'.(5*$i).'">'.(5*$i).'</option>';
				}
				echo '</select><br>';
				break;
			case 'title':
				echo 'Título: <input type="text" name="title"><br>';
				break;
			case 'comment':
				echo 'Comentario:<br><textarea name="comment" rows="4" cols="40"></textarea><br>';
				break;
			default:
				break;
		}
	}
?>
</body>