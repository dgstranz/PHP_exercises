<?php
function removeAccents($string) {
	$plain = array(
		'a' => '/[áàâäãå]/',
		'ae' => '/æ/',
		'c' => '/[çćč]/',
		'd' => '/ð/',
		'dj' => '/đ/',
		'e' => '/[éèêë]/',
		'i' => '/[íìîï]/',
		'n' => '/[ñ]/',
		'o' => '/[óòôöõø]/',
		's' => '/š/',
		'ss' => '/ß/',
		'th' => '/þ/',
		'u' => '/[úùûü]/',
		'y' => '/[ýÿ]/',
		'z' => '/ž/'
	);
	return preg_replace(array_values($plain), array_keys($plain), mb_convert_case($string, MB_CASE_LOWER, "UTF-8"));
}

function isValid($string) {
	if (preg_match('/^[a-zA-Z\'\-\s]+$/', removeAccents($string))) {
		return true;
	} else {
		return false;
	}
}
?>