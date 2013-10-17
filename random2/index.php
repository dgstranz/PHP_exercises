<html>
<head>
</head>
<body>
<?php
$iterations=100;
$c=0;

function randomLCG($x,$pos) {
	global $c;
	return (219*$x[$pos]+$c)%32749;
	return (2*$x[$pos]+$c)%100;
}
function noRepeat($x,$pos) {
	global $c;
	$i=1;
	while($i<$pos) {
		if($x[$pos]!=$x[$i]) {
			$i++;
		}
		else {
			$c++;
			return false;
		}
	}
	return true;
}

function buildTable($iterations) {
	$pos=0;
	$x[0]=1;
	$columns=10;
	$rows=ceil($iterations/$columns);
	echo '<table border="4"><tr>';
	for($i=1;$i<=$iterations;$i++) {
		do {
			$x[$pos+1]=randomLCG($x,$pos);
		}
		while(!noRepeat($x,$pos+1));
		echo '<td>'.$x[$pos+1].'</td>';
		$pos++;
		if($i%$columns==0) {
			echo '</tr>';
			if($i<$iterations) echo '<tr>';
		}
	}
	echo '</table>';
}

buildTable($iterations);
?>
</body>
</html>