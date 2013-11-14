
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
	session_start();
	session_destroy();

	if(isset($_SERVER['REQUEST_URI']) && ($_SERVER['REQUEST_URI'] === $_SERVER['PHP_SELF'])) {
		echo 'Ha introducido un nombre incorrecto. Sólo se admiten letras, guiones, apóstrofos y espacios.';
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