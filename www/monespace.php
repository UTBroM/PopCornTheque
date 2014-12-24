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
			if ((!isset($_SESSION['login'])) || (empty($_SESSION['login'])))
			{
			// la variable 'login' de session est non déclaré ou vide
			echo '  <p><a href="index.php" title="Connexion">Connexion d\'abord !</a></p>';
			exit();
			}
		?>

		<h1>Bienvenue dans l'epace ultra sécurisé !</h1>
	</body>
</html>
