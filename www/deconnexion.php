<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>

	<body>
	<?php

		$_SESSION = array();
		session_destroy();

		echo "<p>Deconnecté</p>";

	?>
</body>
