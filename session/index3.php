<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
	session_start();

	$idiomas=['español', 'inglés', 'francés', 'checo', 'alemán', 'ruso'];
	
	$_SESSION['apellido'] = $_REQUEST['apellido'];
	echo 'Su nombre es '.$_SESSION['nombre'].' '.$_SESSION['apellido'].'.';

	echo '
		<form action="index4.php" method="post">
			Idiomas:<br>
			';

			foreach($idiomas as $key=>$idioma) {
				echo '<input type="checkbox" name="idioma[]" value='.$idioma.'>'.ucfirst($idioma).'<br>';
			}

	echo '
			<input type="reset" value="Borrar" />
			<input type="submit" value="Next" />
		</form>';
?>

</body>
</html>