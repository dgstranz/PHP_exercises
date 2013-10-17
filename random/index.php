<html>
<head>
</head>
<body>
<?php
$pos=0;
$x[0]=1;
Function randomLCG($x,$pos) {
	$res=(219*$x[$pos]+0)%32749;
	return $res;
}
$rows=50;
$columns=10;
$iterations=$rows*$columns;

echo '<table border="4">';

for($i=0;$i<$rows;$i++) {
	echo '<tr>';
	for($j=0;$j<$columns;$j++) {
		$x[$pos+1]=randomLCG($x,$pos);
		echo '<td>'.$x[$pos+1].'</td>';
		$pos++;
	}
	echo '</tr>';
}
echo '</table>';
?>
</body>
</html>