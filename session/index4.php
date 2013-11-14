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
		for($i=0; $i < $num; $i++) {
			$_SESSION['idioma'][$i] = $_REQUEST['idioma'][$i];
		}
		if($num == 1) {
			echo 'Ha seleccionado el '.$_SESSION['idioma'][0].'.';
		} else {
			echo 'Sus idiomas son ';
			foreach($_SESSION['idioma'] as $key => $idioma) {
				if ($key > 0 && $key < $num-1) echo ', ';
				elseif ($key == $num-1) {
					if (preg_match('/^h?i/', $idioma)) {
						echo ' e ';
					} else {
						echo ' y ';
					}
				}
				echo $idioma;
			}
			echo '.';
		}
	}
	else echo 'No ha seleccionado ningún idioma.';
?>

</body>
</html>