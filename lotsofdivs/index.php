<html>
<head>
	<title>Lots of divs!</title>
</head>
<body>
<?php
$size=10;

if(!isset($_GET['r']))     
{     
echo "<script language=\"JavaScript\">     
<!--      
document.location=\"$PHP_SELF?r=1&width=\"+screen.width+\"&height=\"+screen.height;     
//-->     
</script>";     
}     
else {         
	if(isset($_GET['width']) && isset($_GET['height'])) {
		$rows=floor(0.88 * $_GET['height']/$size);
		$columns=floor(0.98 * $_GET['width']/$size);
	}     
	else {
		$rows=60;
		$columns=120;     
	}

	echo '<div style="height:'.($rows*$size).'; width:'.($columns*$size).'">';
	for($i=0; $i<$rows; $i++) {
		echo '<div style="height:'.$size.'; width:'.($columns*$size).'">';
		for($j=0; $j<$columns; $j++) {
			$red = (17 * ($i + $j)) % 255; // I chose 255 instead of 256 because 255 = 15 * 17
			$green = (85 + $red) % 255;
			$blue = (170 + $red) % 255;
			echo '<div style="height:'.$size.'; width:'.$size.'; background-color:rgb('.$red.','.$green.','.$blue.'); float:left"></div>';
		}
		echo '</div>';
	}
	echo '</div>';
}     

?>
</body>
</html>