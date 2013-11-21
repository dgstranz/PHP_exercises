<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	$year = -1;
	$month = -1;
	$day = -1;
	$hour = -1;
	$minute = -1;
	$title = "";
	$comment = "";
	$params = [&$year, &$month, &$day, &$hour, &$minute, &$title, &$comment];

	function isValid() {
		global $year, $month, $day, $hour, $minute, $title, $comment;
		$complete = true;
		if (!checkdate($month, $day, $year)) $complete = false;
		/*foreach ($params as $param) {
			if (!isset($_REQUEST[$param])) {
				$complete = false;
			} else {
				$params[$param] = $_REQUEST[$param];
			}
			if (!isset($params[$month]) || !isset($params[$day]) || !isset($params[$year])) $complete = false;
		}*/
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
				echo '<option></option>';
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

	if (isset($_REQUEST['year'])) {
		$year = $_REQUEST['year'];
	}
	if (isset($_REQUEST['month'])) {
		$month = $_REQUEST['month'];
	}
	if (isset($_REQUEST['day'])) {
		$day = $_REQUEST['day'];
	}
	if (isset($_REQUEST['hour'])) {
		$hour = $_REQUEST['hour'];
	}
	if (isset($_REQUEST['minute'])) {
		$minute = $_REQUEST['minute'];
	}
	if (isset($_REQUEST['title'])) {
		$title = $_REQUEST['title'];
	}
	if (isset($_REQUEST['comment'])) {
		$comment = $_REQUEST['comment'];
	}
	if (!isValid()) {
		print_form();
	} else {
		echo 'Datos enviados correctamente.';
	}
?>
</body>