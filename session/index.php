
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
	session_start();

	if(isset($_SERVER['HTTP_REFERER'])) {
		echo 'Ha introducido un nombre incorrecto';
	}
	echo '
	<form action="index2.php" method="post">
		Nombre: <input type="text" name="nombre" />
		<input type="reset" value="Borrar" />
		<input type="submit" value="Next" />
	</form>';
?>

</body>
</html>