<html>
<?php
include 'colors.php';

if(isset($_COOKIE['mycolor'])) {
	$mycolor=$_COOKIE['mycolor'];
	echo '<body bgcolor="'.$mycolor.'">';
}
else echo '<body>';
?>
<a href="index.php">Go back</a>
</body>
</body>
</html>