<?php
	$alumnos=array(
		'Gómez, Pepe' => array(
			'diseño' => 6,
			'servidor' => 5,
			'cliente' => 8
		),
		'Castillo, Ana' => array(
			'diseño' => 9,
			'servidor' => 5,
			'cliente' => 7
		),
		'Soriano, Juan' => array(
			'diseño' => 8,
			'servidor' => 10,
			'cliente' => 9
		),
	);
	function visualizar() {
		global $alumnos;
		ksort($alumnos);
		echo '<table border="4"><tr><td></td><td>Diseño</td><td>Servidor</td><td>Cliente</td></tr>';
		foreach($alumnos as $nombre => $registro) {
			echo '<tr><td>'.$nombre.'</td>';
			foreach($alumnos[$nombre] as $asig => $nota) {
				echo '<td>'.$alumnos[$nombre][$asig].'</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
	}
	function visualizarAlumno($alumno) {
		global $alumnos;
		echo '<h1>'.$alumno.'</h1><ul>';
		foreach($alumnos[$alumno] as $asig => $nota) {
			echo '<li><b>'.$asig.'</b>: '.$alumnos[$alumno][$asig];
		}
	}
?>