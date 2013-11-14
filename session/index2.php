<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
	session_start();
	include 'checkName.php';

	function print_data() {
		echo 'Su nombre es '.$_SESSION['nombre'].'.';
	}

	function print_form() {
		echo '
		<form action="index3.php" method="post">
			Apellido: <input type="text" name="apellido" />
			<input type="reset" value="Borrar" />
			<input type="submit" value="Next" />
		</form>';
	}

	validate('nombre');
?>

</body>
</html>