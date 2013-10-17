<?php
	$usuarios=array(
		'Gómez, Pepe' => '123456',
		'Castillo, Ana' => '123456',
		'Soriano, Juan' => '123456',
		'Profesor' => '123456'
	);
	function autenticar($usuario,$contra) {
		global $usuarios;
		if(array_key_exists($usuario,$usuarios)) {
			if($usuarios[$usuario]==$contra) return true;
			else return false;
		}
		else return false;
	}
?>