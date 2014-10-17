<html>
<head>
	<title>Aguja y pajar</title>
	<meta charset="utf-8">
</head>
<?php
	$aguja;
	$pajar;
	$pos = array();

	// Solamente se usan en caso de búsqueda por palabra
	$palabras_aguja = array();
	$palabras_pajar = array();

	if (!isset($_POST['aguja']) || !isset($_POST['pajar'])) {
		print_form();
	} elseif (empty($_POST['aguja']) || empty($_POST['pajar'])) {
		echo '<b>Error:</b> Alguno de los campos está vacío. Redireccionando en 5 segundos...';
		header('refresh: 5, url=' . $_SERVER['PHP_SELF']);
	} else {
		$aguja = $_POST['aguja'];
		$pajar = $_POST['pajar'];
		print_form();

		if (isset($_POST['cadena'])) {
			$pos = buscar_cadena($aguja, $pajar);
		} elseif (isset($_POST['palabra'])) {
			$palabras_aguja = obtener_palabras($aguja);
			$palabras_pajar = obtener_palabras($pajar);
			$pos = buscar_palabra($palabras_aguja, $palabras_pajar);
		}

		visualizar($pos);
	}

	function print_form() {
		global $aguja;
		global $pajar;
		echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
				<table>
					<tr>
						<td>Texto:</td>
						<td><textarea cols="40" rows="4" name="pajar">'.$pajar.'</textarea></td>
					</tr>
					<tr>
						<td>Buscar:</td>
						<td><input type="text" name="aguja" value="'.$aguja.'"></td>
					</tr>
					<tr>
						<td>Posiciones:</td>
						<td><input type="checkbox" name="pos" checked>Mostrar posiciones</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="cadena" value="Buscar cadena">
							<input type="submit" name="palabra" value="Buscar palabra">
							<input type="reset" value="Borrar">
						</td>
					</tr>
				</table>
			</form>';
	}

	function obtener_palabras($cadena) {
		$aux = trim($cadena);
		$palabras;

		$aux = preg_replace('/ +/', ' ', $aux);
		$palabras = explode(' ', $aux);

		return $palabras;
	}

	function buscar_cadena($aguja, $pajar) {
		$pos_actual = 0;
		$num_ocurrencias = 0;
		$pos = array();
		$valor;

		while (($valor = stripos($pajar, $aguja, $pos_actual)) !== false) {
			$pos[sizeof($pos)] = $valor;
			$pos_actual = $valor + 1;
		}

		return $pos;
	}

	function buscar_palabra($palabras_aguja, $palabras_pajar) {
		$pos_actual = 0;
		$num_ocurrencias = 0;
		$pos = array();
		$equal;

		for ($j = 0; $j < sizeof($palabras_pajar) - (sizeof($palabras_aguja) - 1); $j++) {
			$equal = true;

			for ($i = 0; $equal && $i < sizeof($palabras_aguja); $i++) {
				if ($palabras_aguja[$i] != $palabras_pajar[$j + $i]) {
					$equal = false;
				}
			}

			if ($equal) {
				$pos[sizeof($pos)] = $j;
			}
		}

		return $pos;
	}

	function visualizar($pos) {
		global $aguja;
		global $pajar;

		if (empty($pos)) {
			echo '<h2>No se ha encontrado "' . $aguja . '".</h2>';
		} elseif (isset($_POST['pos'])) {
			if (sizeof($pos) == 1) {
				echo '<h2>Se ha encontrado "' . $aguja . '" 1 vez.</h2>';
				echo '<b>Posición:</b> ' . $pos[0];
			} else {
				echo '<h2>Se ha encontrado "' . $aguja . '" ' . sizeof($pos) . ' ' . (sizeof($pos) > 1 ? 'veces' : 'vez') . '.</h2>';
				echo '<ol><b>Posiciones:</b>';
				foreach ($pos as $key => $value) {
					echo '<li>' . $value . '</li>';
				}
				echo '</ol>';
			}
		} else {
			echo '<h2>Se ha encontrado "' . $aguja .'".</h2>';
		}
	}
?>
</body>
</html>