<html>
<head>
	<title>Chessboard!</title>
</head>
<body>
<?php
$rows=8;
$columns=8;
$size=50;

echo '<div style="height:'.($rows*$size).'; width:'.($columns*$size).'; border:3px solid rgb(128,128,0)">';
for($i=0; $i<$rows; $i++) {
	echo '<div style="height:'.$size.'; width:'.($columns*$size).'">';
	for($j=0; $j<$columns; $j++) {
		$color = 255 * (($i + $j + 1) % 2); // It will be either 0 or 255
		echo '<div style="height:'.$size.'; width:'.$size.'; background-color:rgb('.$color.','.$color.','.$color.'); float:left"></div>';
	}
	echo '</div>';
}
echo '</div>';
?>
</body>
</html>