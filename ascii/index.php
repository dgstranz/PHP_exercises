<html>
<body>
<?php
echo '<table align="center" border="4"><tr align="center"><td colspan=16><h1>Tabla de caracteres ASCII</h1></td></tr>';
for($cod=0;$cod<255;$cod++) {
	if($cod%16==0) echo '<tr align="center">';
	echo '<td><font face="Courier" size="-2">'
		.$cod
		.'</font> <font color="red">'
		.chr($cod)
		.'</font></td>';
	if($cod%16==15) echo '</tr>';
}
echo '</table>'
?>
</body>
</html>