<html>
<body>
<?php
	$uno=$_GET['uno'];
	$dos=$_GET['dos'];
	$oper=$_GET['oper'];
	switch($oper) {
		case "suma":
			$res=$uno+$dos;
			break;
		case "resta":
			$res=$uno-$dos;
			break;
		case "multiplica":
			$res=$uno*$dos;
			break;
		case "divide":
			$res=$uno/$dos;
			break;
		case "modulo":
			$res=$uno%$dos;
			break;
	}
	echo $res;
?>
</body>
</html>