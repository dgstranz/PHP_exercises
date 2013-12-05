<?php
	$aguja;
	$pajar;

	function print_form() {
		global $aguja;
		global $pajar;
		echo '<form action="index.php" method="post">
				<table>
					<tr>
						<td>Texto:</td>
						<td><textarea cols="40" rows="4" name="pajar">'.$pajar.'</textarea></td>
					</tr>
					<tr>
						<td>Buscar:</td>
						<td><input type="text" name="aguja" value="'.$aguja.'" /></td>
					</tr>
					<tr><td colspan="2"><input type="submit" value="Enviar" /><input type="reset" value="Borrar" /></td></tr>
				</table>
			</form>';
	}

	function buscar_pos($aguja, $pajar) {
		$pos_actual = 0;
		$pos_max = strlen($pajar);
		$num_ocurrencias = 0;
		$pos = [];
		$i = 0;

		while (strpos($pajar, $aguja, $pos_actual)) {
			$valor = strpos($pajar, $aguja, $pos_actual);
			$pos[$num_ocurrencias] = $valor;
			$pos_actual = $valor + 1;
			$num_ocurrencias++;
		}

		if (empty($pos)) return 'FALSE';
		else return var_dump($pos);
	}

	if(!empty($_POST['aguja']) && !empty($_POST['pajar'])) {
		$aguja = $_POST['aguja'];
		$pajar = $_POST['pajar'];
		print_form();
		echo buscar_pos($aguja, $pajar);
	} else {
		$aguja = '';
		$pajar = '';
		print_form();
	}
?>