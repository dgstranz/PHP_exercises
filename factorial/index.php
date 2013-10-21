<html>
<head>
<title>Factorial</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<form action="index.php" method="get">
	Número: <input type="number" name="num"
		<?php
		if(isset($_REQUEST['num'])) {
			$num=$_REQUEST['num'];
			if($num=='') $num=0;
			echo ' value="'.$num.'"';
		}
		?>
	><br />
	<input type="submit">
</form>

<?php
if(isset($_REQUEST['num'])) {

function factorial($num) {
	if($num == 0) return 1;
	else if($num > 0 && $num - floor($num) == 0) return $num*factorial($num-1);
	else return "Error";
}

echo $num.'! = '.factorial($num);
}
?>
</body>
</html>