<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
	session_start();
	
	$_SESSION['nombre'] = $_REQUEST['nombre'];
	echo 'Su nombre es '.$_SESSION['nombre'].'.';

	echo '
	<form action="index3.php" method="post">
		Apellido: <input type="text" name="apellido" />
		<input type="reset" value="Borrar" />
		<input type="submit" value="Next" />
	</form>';
?>

</body>
</html>