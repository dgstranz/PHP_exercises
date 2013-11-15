
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
	session_start();

	if(isset($_SESSION['error_nombre'])) {
		echo 'Ha introducido un nombre incorrecto. Sólo se admiten letras, guiones, apóstrofos y espacios.';
	}

	session_destroy();

	echo '
	<form action="index2.php" method="post">
		Nombre: <input type="text" name="nombre" />
		<input type="reset" value="Borrar" />
		<input type="submit" value="Next" />
	</form>';
?>

</body>
</html>