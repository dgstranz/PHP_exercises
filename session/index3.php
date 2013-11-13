<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
	session_start();
	include 'checkName.php';

	if(isValid($_REQUEST['apellido'])) {
		$_SESSION['apellido'] = $_REQUEST['apellido'];
		echo 'Su nombre es '.$_SESSION['nombre'].' '.$_SESSION['apellido'].'.';

		$idiomas=['español', 'inglés', 'francés', 'checo', 'alemán', 'ruso'];
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
	} else {
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
?>

</body>
</html>