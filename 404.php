<?php 
if(function_exists(sed_sendheaders)){
	sed_sendheaders();
}
else{
	define('SED_CODE', TRUE);
	require_once('./datas/config.php');
	require_once($cfg['system_dir'].'/functions.php');
	require_once($cfg['system_dir'].'/common.php');
	sed_sendheaders();
}

?>

<html>
<head>
<title>Ошибка 404 - Запрашиваемая страница не найдена.</title>
</head>
<body>
<br><br><br><br><br>
	<center>
		Запрашиваемая страница не найдена.<br><br>
		<a href="/" style="font-size:18px;">Перейти на главную страницу сайта</a>
	</center>
	<br><br>
</body>
</html>