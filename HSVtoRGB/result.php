<html>
	<head>
		<title>HSV to RGB converter</title>
	</head>
	<body>
		<?php
			/* Getting values */
			$h=$_GET["hue"];
			$s=$_GET["sat"];
			$v=$_GET["value"];
			
			/* Putting in order out of range values */
			$h=$h%360; /* This is a color wheel, so it goes around and around and around :D */
			if($s<0) $s=0;
			if($s>100) $s=100;
			if($v<0) $v=0;
			if($v>100) $v=100;
			
			/* Calculating r, g, b */
			$c=($v/100)*($s/100);
			$x=abs($h%120-60)/60;
			$x=$c*(1-$x);
			$m=$v/100-$c;
			switch(true) {
				case $h>=0 && $h<60:
					$r=$c;
					$g=$x;
					$b=0;
					break;
				case $h>=60 && $h<120:
					$r=$x;
					$g=$c;
					$b=0;
					break;
				case $h>=120 && $h<180:
					$r=0;
					$g=$c;
					$b=$x;
					break;
				case $h>=180 && $h<240:
					$r=0;
					$g=$x;
					$b=$c;
					break;
				case $h>=240 && $h<300:
					$r=$x;
					$g=0;
					$b=$c;
					break;
				case $h>=300 && $h<360:
					$r=$c;
					$g=0;
					$b=$x;
					break;
			}
			$r=round(255*($r+$m));
			$g=round(255*($g+$m));
			$b=round(255*($b+$m));
						
			/* Converting to hex */
			$hex="#";
			$hex.=dechex(floor($r/16)).dechex($r%16);
			$hex.=dechex(floor($g/16)).dechex($g%16);
			$hex.=dechex(floor($b/16)).dechex($b%16);
			
			/* Displaying */
			echo '
				<table border="1">
					<tr>
						<td>
							Hue: '.$h.'&deg;<br>
							Saturation: '.$s.'%<br>
							Value: '.$v.'%<br>
							&nbsp;
						</td>
						<td>
							Red: '.$r.'<br>
							Green: '.$g.'<br>
							Blue: '.$b.'<br>
							'.$hex.'
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div style="background:'.$hex.'; height:70px; width:100%; float:right" />
						</td>
					</tr>
				</table>
			';
		?>
	</body>
</html>