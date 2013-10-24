<html>
<head>
	<title>P&aacute;gina principal</title>
</head>
<body>
	<p><a href="otra.php">Enlace</a> a otra p&aacute;gina de esta web.</p>
	<p><?php
		include 'cuentavisitas.php';
		cuentavisitas();
	?></p>
</body>
</html>