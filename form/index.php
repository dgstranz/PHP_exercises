<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	$params = ['year', 'month', 'day', 'hour', 'minute', 'title', 'comment'];
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$$param = $_POST[$param];
		}
	}

	function print_form($params) {
		echo '<form action="index.php?operacion=confirmar" method="POST">';
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
				echo '<option value="-1"></option>';
				for($i = 2000; $i <= 2037 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select> ';
				break;
			case 'month':
				$months = [null, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
				echo 'Mes: <select name="month">';
				echo '<option value="-1"></option>';
				for($i = 1; $i <= 12 ; $i++) {
					echo '<option value="'.$i.'">'.$months[$i].'</option>';
				}
				echo '</select> ';
				break;
			case 'day':
				echo 'Día: <select name="day">';
				echo '<option value="-1"></option>';
				for($i = 1; $i <= 31 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select><br>';
				break;
			case 'hour':
				echo 'Hora: <select name="hour">';
				echo '<option value="-1"></option>';
				for($i = 0; $i <= 23 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select>:';
				break;
			case 'minute':
				echo '<select name="minute">';
				echo '<option value="-1"></option>';
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
				echo '</textarea><br>';
				break;
			default:
				echo $param;
				break;
		}
	}

	function validate() {
		global $year, $month, $day, $hour, $minute, $title, $comment;
		$printing_form = false;
		if (!checkdate($month, $day, $year)) {
			echo '<form action="index.php?operacion=confirmar" method="POST">';
			$printing_form = true;
			echo '<font color="red">Debe introducirse una fecha válida.</font><br>';
			print_field('year');
			print_field('month');
			print_field('day');
		}
		if ($hour < 0 || $hour > 23 || $minute < 0 || $minute > 59 || $minute % 5 != 0) {
			echo '<form action="index.php?operacion=confirmar" method="POST">';
			$printing_form = true;
			echo '<font color="red">Debe introducirse una hora válida.</font><br>';
			print_field('hour');
			print_field('minute');
		}
		if ($printing_form) {
			echo '<input type="submit" />';
			echo '</form>';
		} else {
			echo 'Datos enviados correctamente.<br>';
			echo 'Fecha: '.$day.'/'.$month.'/'.$year.'<br>';
			echo 'Hora: '.$hour.':'.$minute.'<br>';
			echo 'Título: '.$title.'<br>';
			echo 'Comentario: '.$comment;
		}
	}

	if (!isset($_GET['operacion']) || $_GET['operacion'] != 'confirmar') {
		print_form($params);
	} else {
		validate();
	}
?>
</body>
</html>