<?php
$file;

function print_form() {
	echo '<form action="index.php" method="post">
			Choose a file: <input type="text" name="file">
			<input type="submit" value="Enviar" />
		</form>';
}

function display($file) {
	$handle = fopen($file, "r");
	$content = trim(fread($handle, filesize($file)));
	fclose($handle);
	return $content;
}

if(isset($_REQUEST['file'])) {
	$file = $_REQUEST['file'];
}
if(empty($file)) {
	print_form();
} else {
	echo '<h1>Contents of '.$file.'</h1><hr>';
	echo display($file);
}
?>