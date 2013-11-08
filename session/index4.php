<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
	session_start();
	
	echo 'Su nombre es '.$_SESSION['nombre'].' '.$_SESSION['apellido'].'.<br>';
	if(isset($_REQUEST['idioma'])) {
		$num=count($_REQUEST['idioma']);
		echo $num;
		for($i=0; $i < $num; $i++) {
			$_SESSION['idioma'][$i] = $_REQUEST['idioma'][$i];
		}
		echo 'Sus idiomas son ';
		foreach($_SESSION['idioma'] as $key => $idioma) {
			echo $idioma;
			if($key < $num-1) echo ', ';
			elseif ($key == $num-1) echo ' y ';
			else echo '.';
		}
	}
	else echo 'No ha seleccionado ningún idioma.';
?>

</body>
</html>