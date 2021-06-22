<?php
if (!defined('SCRIPT_MASIA')) {
	echo ('Выявлена попытка взлома!');
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ru">

<head>
	<style type="text/css">
		body {
			height: 50vh;
			color: #222;
			font-size: 13px;
			font-family: sans-serif;
			background: #fff
		}

		h1 {
			font-size: 300%;
			font-family: 'Trebuchet MS', Verdana, sans-serif;
			color: #000
		}

		#page {
			font-size: 122%;
			width: 720px;
			margin: 144px auto 144px auto;
			text-align: left;
			line-height: 1.2;
		}
	</style>
	<meta http-equiv="Content-Type" content="application/xhtml; charset=utf-8" />
	<meta name="description" content="Произошла ошибка №404" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<title>Error 404 – Page not found</title>
</head>

<body>
	<div id="page">
		<div>
			<h1>ERROR 404</h1>
			<p>— Доступ к данной странице для Вас заблокирован, либо её просто не существует!</p>
			<p><a href="/">Начать с начала</a></p>
		</div>
	</div>
</body>

</html>