<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link type="text/css" rel="stylesheet" href="../../public/assets/clients/css/style.css">
	<title><?= !empty($page_title) ? $page_title : 'Home' ?></title>
</head>
<body>
<?php

$this->render('layout/header');
$this->render($content);
$this->render('layout/footer');
?>
<link type="text/javascript" src="../../app/public/assets/clients/js/script.js">
</body>
</html>
