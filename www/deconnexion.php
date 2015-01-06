<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>

	<body>
	<?php

		session_start();
		$_SESSION = array();
		session_destroy();

		header('Location: index.php');

	?>
</body>
