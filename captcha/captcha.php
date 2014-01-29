<?php
// Establecer el tipo de contenido
header('Content-Type: image/jpeg');
session_start();

// Crear la imagen
$im = imagecreatefromjpeg('fondo.jpg');
$width = imagesx($im);
$height = imagesy($im);

// Número de caracteres y tipografía
$text = '';
$numchars = 7;
$font = 'arial.ttf';

// Generar y añadir el texto
for ($i=0; $i < $numchars; $i++) {
	$angle = rand(-30, 30);
	$x = ($width * ($i + 0.5)) / ($numchars + 1);
	$y = rand($height * 0.3, $height * 0.7);
	$bgcolor = imagecolorallocate($im, rand(100, 255), rand(100, 255), rand(100, 255));
	$color = imagecolorallocate($im, rand(100, 255), rand(100, 255), rand(100, 255));
	$char = chr(rand(97, 122));
	$text .= $char;
	imagettftext($im, 20, $angle, $x-2, $y-2, $bgcolor, $font, $char);
	imagettftext($im, 20, $angle, $x, $y, $color, $font, $char);
}
$_SESSION['captcha_ver'] = $text;

imagejpeg($im);
?>