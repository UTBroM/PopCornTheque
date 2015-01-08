<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>
	<?php

		include 'header.php';

		ini_set('display_errors', 'On');

		$film = $_POST['film'];

		echo "Recherche du film ", htmlspecialchars($film);

		include 'connexionBDD.php';

		$req = $bdd->prepare("SELECT *  FROM FILM WHERE FILM_TITRE LIKE CONCAT('%', ?, '%')");
		$req->execute(array($film));

		while($donnees = $req->fetch()){

			echo '<br /><a href="detailsFilm.php?idfilm=', htmlspecialchars($donnees['FILM_ID']), '">',htmlspecialchars($donnees['FILM_TITRE']), '</a><br />';
			echo '<img src="', $donnees['FILM_AFFICHE'], '"></br>';

		}

	?>
	
	</body>
</html>

