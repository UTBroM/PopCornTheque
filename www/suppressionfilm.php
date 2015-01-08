<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<title>PopcornTeque</title>
	</head>

	<body>
		<?php

			include 'header.php'; 			
			ini_set('display_errors', 'On');

			$idfilm = $_GET['idfilm'];

			include 'connexionBDD.php';

			$req = $bdd->prepare('DELETE FROM AVOIR_JOUE_DANS WHERE FILM_ID = :idfilm');
			$req->execute(array(
				'idfilm' => $idfilm
			));

			$req = $bdd->prepare('DELETE FROM REALISER WHERE FILM_ID = :idfilm');
			$req->execute(array(
				'idfilm' => $idfilm
			));


			$req = $bdd->prepare('DELETE FROM FILM WHERE FILM_ID = :idfilm');
			$req->execute(array(
				'idfilm' => $idfilm
			));

		?>
	</body>
</html>

