<html>
<body>
<?php
	include 'alumnos.php';
	include 'usuarios.php';
	if(!isset($_REQUEST['usuario'])) {
		include 'header.php';
		echo '<form action="index.php" method="POST">
				Usuario: <input type="text" name="usuario" />
				Contraseña: <input type="text" name="contra" />
				<input type="submit" />
			</form>';
	}
	else {
		$usuario=$_REQUEST['usuario'];
		$contra=$_REQUEST['contra'];
		if(autenticar($usuario,$contra)) {
			if($usuario=='Profesor') visualizar();
			else visualizarAlumno($usuario);
		}
		else echo 'Usuario y/o contraseña incorrectos';
	}
?>
</body>
</html>