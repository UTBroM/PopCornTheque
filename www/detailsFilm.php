<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>

	<body>

	<?php

		$idfilm = $_GET['idfilm'];

		try{
			$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
		}
		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}

		$req = $bdd->prepare('SELECT * FROM FILM WHERE FILM_ID = ?');
		$req->execute(array($idfilm));

		$donnees = $req->fetch();
		echo '<h1>', $donnees['FILM_TITRE'], '</h1>';
		echo '<img src="', $donnees['FILM_AFFICHE'], '">';
		echo '<h2>Synopsis :</h2><p>', $donnees['FILM_SYNOPSIS'], '</p>';
		

		$req2 = $bdd->prepare('SELECT * FROM SUPPORT WHERE FILM_ID = ?');
		$req2->execute(array($idfilm));

		echo '<h2>Utilisateurs qui disposent de se film :</h2><ul>';
		while($donnees = $req2->fetch()){

			echo '<li>', $donnees['UTI_ID'], '</li>';

		}
		echo '</ul>';


		$req3 = $bdd->prepare('SELECT * FROM COMMENTAIRES_FILM WHERE FILM_ID = ?');
		$req3->execute(array($idfilm));

		echo '<h2>Commentaires :</h2><ul>';
		while($donnees = $req3->fetch()){

			echo '<li>', $donnees['UTI_ID'], '</li>';
			echo '<li>', $donnees['COMF_CONTENU'], '</li>';

		}
		echo '</ul>';

	?>

	</body>
</html>
