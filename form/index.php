<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	$params = ['year', 'month', 'day', 'hour', 'minute', 'title', 'comment'];

	function isValid() {
		global $params;
		$complete;
		foreach ($params as $param) {
			if (!isset($_REQUEST[$param])) {
				$complete = false;
				break;
			}
		}
		return $complete;
	}

	function print_form() {
		global $params;
		echo '<form action="index.php" method="POST">';
		foreach ($params as $param) {
			print_field($param);
		}
		echo '<input type="submit" />';
		echo '</form>';
	}

	function print_field($param) {
		switch ($param) {
			case 'year':
				echo 'Año: <select name="year">';
				if (isset($_REQUEST['year'])) echo '<option value="'.$_REQUEST['year'].'" selected>'.$_REQUEST['year'].'</option>';
				echo '<option value=""></option>';
				for($i = 2000; $i <= 2037 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select> ';
				break;
			case 'month':
				$months = [null, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
				echo 'Mes: <select name="month">';
				if (isset($_REQUEST['month'])) echo '<option value="'.$_REQUEST['month'].'" selected>'.$_REQUEST['month'].'</option>';
				echo '<option value=""></option>';
				for($i = 1; $i <= 12 ; $i++) {
					echo '<option value="'.$i.'">'.$months[$i].'</option>';
				}
				echo '</select> ';
				break;
			case 'day':
				echo 'Día: <select name="day">';
				if (isset($_REQUEST['day'])) echo '<option value="'.$_REQUEST['day'].'" selected>'.$_REQUEST['day'].'</option>';
				echo '<option value=""></option>';
				for($i = 1; $i <= 31 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select><br>';
				break;
			case 'hour':
				echo 'Hora: <select name="hour">';
				if (isset($_REQUEST['hour'])) echo '<option value="'.$_REQUEST['hour'].'" selected>'.$_REQUEST['hour'].'</option>';
				echo '<option value=""></option>';
				for($i = 0; $i <= 23 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select>:';
				break;
			case 'minute':
				echo '<select name="minute">';
				if (isset($_REQUEST['minute'])) echo '<option value="'.$_REQUEST['minute'].'" selected>'.$_REQUEST['minute'].'</option>';
				echo '<option value=""></option>';
				for($i = 0; $i <= 11 ; $i++) {
					echo '<option value="'.(5*$i).'">'.(5*$i).'</option>';
				}
				echo '</select><br>';
				break;
			case 'title':
				echo 'Título: <input type="text" name="title"><br>';
				break;
			case 'comment':
				echo 'Comentario:<br><textarea name="comment" rows="4" cols="40">';
				if (isset($_REQUEST['comment'])) echo $_REQUEST['comment'];
				echo '</textarea><br>';
				break;
			default:
				break;
		}
	}

	if (!isValid()) {
		print_form();
	}
?>
</body>