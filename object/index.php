<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

class Header {
	private $title;
	private $text_color;
	private $bg_color;

	public function __construct($title, $text_color, $bg_color) {
		$this->title = $title;
		$this->text_color = $text_color;
		$this->bg_color = $bg_color;
	}

	public function paint() {
		echo '<div style="color:' . $this->text_color . '; background-color:' . $this->bg_color . '; text-align: center"><h1>' . $this->title . '</h1></div>';
	}
}

$my_header = new Header('Hello world!', '#336699', '#ffffcc');

$my_header->paint();

?>
</body>
</html>