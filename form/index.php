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
	$params = ['year', 'month', 'day', 'hour', 'minute', 'title', 'comment'];

	function print_form($params) {
		echo '<form action="index.php?operacion=confirmar" method="POST">';
		foreach ($params as $param) {
			print_field($param);
		}
		/*print_field('year');
		print_field('month');
		print_field('day');
		print_field('hour');
		print_field('minute');
		print_field('title');
		print_field('comment');*/
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
				echo '<option value="0"></option>';
				for($i = 0; $i <= 23 ; $i++) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select>:';
				break;
			case 'minute':
				echo '<select name="minute">';
				echo '<option value="0"></option>';
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
		if (!checkdate($month, $day, $year)) {
			echo '<font color="red">Fecha incorrecta.</font><br>';
			print_field('year');
			print_field('month');
			print_field('day');
		} else {
			echo 'Datos enviados correctamente.';
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