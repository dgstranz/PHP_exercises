<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	$matriculas = ['1234ABC', '9876BCN', 'M-0829-TT', 'P3456Y', '456HTF', '1234FKC', '3377GHT'];
	$mat_validas = [];
	$mat_no_validas = [];

	function validar_matricula($matricula) {
		return preg_match('/^\d{4}[B-DF-HJ-NPR-TV-Z]{3}$/', $matricula);
		/* La matrícula europea tiene 4 dígitos seguidos de 3 mayúsculas (excluidas las vocales y la Q) */
	}

	/* Ahora separo el array original en dos: matrículas válidas y no válidas */
	foreach ($matriculas as $matricula) {
		if (validar_matricula($matricula)) {
			$mat_validas[count($mat_validas)] = $matricula;
		} else {
			$mat_no_validas[count($mat_no_validas)] = $matricula;
		}
		/* Se pasa al último lugar del array correspondiente */
	}

	/* Ahora pinto la tabla */
	echo '<table><th>Matrículas válidas</th><th>Matrículas no válidas</th>';
	for ($i = 0; $i <= max(count($mat_validas), count($mat_no_validas)); $i++) {
		echo '<tr><td>';
			if (isset($mat_validas[$i])) {
				echo $mat_validas[$i];
			}
		echo '</td><td>';
			if (isset($mat_no_validas[$i])) {
				echo $mat_no_validas[$i];
			}
		echo '</td></tr>';
	}
	echo '</table>';
?>
</body>
</html>