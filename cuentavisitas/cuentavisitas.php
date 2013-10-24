<?php
function cuentavisitas() {
	$filename = "visitas.txt";
	$handle = fopen($filename, "c+");
	$value = trim(fread($handle, filesize($filename)));
	if(is_numeric($value)) $value++;
	else $value=1;
	rewind($handle);
	ftruncate($handle,0);
	fwrite($handle, $value);
	fclose($handle);
	echo 'Esta web tiene '.$value.' visitas.';
	return true;
}
?>