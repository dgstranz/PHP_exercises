<html>
<body>
<?php
include 'colors.php';

if(isset($_COOKIE['mycolor'])) {
	$mycolor=$_COOKIE['mycolor'];
	echo 'You have a cookie with the color <font color='.$mycolor.'>'.$mycolor.'</font>.<br>';
}
else {
	echo 'You don\'t have cookies for this site.<br>';
}

if(isset($_GET['color'])) {
	$color=$_GET['color'];
	if($color==$colors[0]) {
		setcookie('mycolor', '', time()-3600);
		echo 'No color was chosen. Any cookie you have for this site will be deleted.';	
	}
	else {
		setcookie('mycolor', $color, time()+3600);
		echo 'You chose the color <font color='.$color.'>'.$color.'</font>. It will be saved in a cookie.';
	}
}

echo '<ol>';
foreach($colors as $key => $value) {
	echo '<li><a href="'.$_SERVER['PHP_SELF'].'?color='.$value.'">'.$value.'</a></li>';
}
echo '</ol>';
?>
<a href="index2.php">See result</a>
</body>
</html>